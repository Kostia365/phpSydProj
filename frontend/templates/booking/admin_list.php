<?php
/** @var array $bookings */
?>

<div class="headings">
    <h2>All Bookings</h2>
</div>

<?php if (empty($bookings)): ?>
    <article>
        <p>No bookings yet.</p>
    </article>
<?php else: ?>
    <div class="grid">
        <?php foreach ($bookings as $booking): ?>
            <article>
                <header>
                    <strong><?= htmlspecialchars($booking['service_name']) ?></strong>
                </header>

                <p>
                    Customer: <?= htmlspecialchars($booking['user_name']) ?>
                    (<?= htmlspecialchars($booking['user_email']) ?>)
                </p>

                <p>
                    Date: <?= htmlspecialchars(date('d M Y H:i', strtotime($booking['appointment_time']))) ?>
                </p>

                <footer>
                    <p style="margin-bottom: 12px;">
                        Status: <strong><?= htmlspecialchars(ucfirst($booking['status'])) ?></strong>
                    </p>

                    <form action="/?route=booking-status" method="POST" style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
                        <input type="hidden" name="id" value="<?= (int)$booking['id'] ?>">
                        <select name="status" style="flex: 1; min-width: 120px;">
                            <option value="pending"    <?= $booking['status'] === 'pending'   ? 'selected' : '' ?>>Pending</option>
                            <option value="confirmed"  <?= $booking['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                            <option value="cancelled"  <?= $booking['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            <option value="completed"  <?= $booking['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                        </select>
                        <button type="submit" class="btn" style="min-height: 40px; padding: 8px 16px;">Update</button>
                    </form>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
