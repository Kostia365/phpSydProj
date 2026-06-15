<?php
/** @var string $content */
/** @var string $title */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = ($_SESSION['user_role'] ?? null) === 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Barber Booking') ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<main class="container">
    <nav>
        <ul>
            <li>
                <a href="/?route=home">
                    <strong>💈 Barber Booking</strong>
                </a>
            </li>
        </ul>

        <ul>
            <li><a href="/?route=services">Services</a></li>

            <?php if ($isLoggedIn): ?>
                <li><a href="/?route=booking">Book</a></li>
                <li><a href="/?route=my-bookings">My Bookings</a></li>
                <li><a href="/?route=dashboard">Dashboard</a></li>

                <?php if ($isAdmin): ?>
                    <li><a href="/?route=service-create">Add Service</a></li>
                    <li><a href="/?route=booking-all">All Bookings</a></li>
                <?php endif; ?>

                <li><a href="/?route=logout" class="outline" role="button">Logout</a></li>
            <?php else: ?>
                <li><a href="/?route=register">Register</a></li>
                <li><a href="/?route=login" class="outline" role="button">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <?php include $content; ?>
</main>

<footer>
    <div class="container">
        <p>&copy; <?= date('Y') ?> <span style="color: var(--accent)">Barber Booking</span>.</p>
    </div>
</footer>
</body>
</html>