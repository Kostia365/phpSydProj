<?php
/** @var array $services */

$selectedServiceId = isset($_GET['service_id']) ? (int)$_GET['service_id'] : null;
?>

<div class="container">
    <div class="form-wrapper">
        <h2>Book <span style="color: var(--accent)">Appointment</span></h2>

        <?php if (isset($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (empty($services)): ?>
            <p>No services are currently available.</p>
        <?php else: ?>
            <form action="/?route=booking-checkout" method="POST">
                <div class="form-group">
                    <label>Service</label>
                    <select name="service_id" required>
                        <?php foreach ($services as $service): ?>
                            <option value="<?= (int)$service['id'] ?>"
                                    <?= $selectedServiceId === (int)$service['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($service['name']) ?>
                                —
                                $<?= number_format((float)$service['price'], 2) ?>
                                /
                                <?= (int)$service['duration_minutes'] ?> min
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Appointment Time</label>
                    <input type="datetime-local" name="appointment_time"
                           min="<?= date('Y-m-d\TH:i') ?>" required>
                </div>

                <button type="submit" class="btn">Confirm Booking</button>
            </form>
        <?php endif; ?>
    </div>
</div>