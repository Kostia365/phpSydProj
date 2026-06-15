<?php
/** @var array $bookings */
?>

    <div class="headings">
        <h2>My Bookings</h2>
        <a href="/?route=booking" class="button outline">+ New Booking</a>
    </div>

<?php if (empty($bookings)): ?>
    <article>
        <p>You have no bookings yet.</p>
        <a href="/?route=booking" class="btn">Book Appointment</a>
    </article>
<?php else: ?>
    <div class="grid">
        <?php foreach ($bookings as $booking): ?>
            <article>
                <header>
                    <strong><?= htmlspecialchars($booking['service_name']) ?></strong>
                </header>

                <p>
                    Date:
                    <?= htmlspecialchars(date('d M Y H:i', strtotime($booking['appointment_time']))) ?>
                </p>

                <p>
                    Duration:
                    <?= (int)$booking['duration_minutes'] ?>
                    minutes
                </p>

                <p>
                    Price:
                    $<?= number_format((float)$booking['price'], 2) ?>
                </p>

                <footer>
                    Status:
                    <strong><?= htmlspecialchars(ucfirst($booking['status'])) ?></strong>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>