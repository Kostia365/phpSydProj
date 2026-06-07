<?php
/** @var string $styles */
/** @var string $content */
/** @var string $title */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'PHP Project' ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main class="container">
    <nav>
        <ul>
            <li><a href="/?route=home"><strong>🏠 PHP Project</strong></a></li>
        </ul>
        <ul>
            <li><a href="/?route=services">Services</a></li>
            <li><a href="/?route=register">Register</a></li>
            <li><a href="/?route=login" class="outline" role="button">Login</a></li>
        </ul>
    </nav>

    <?php include $content; ?>

</main>
<footer>
    <div class="container">
        <p>&copy; <?= date('Y') ?> <span style="color: var(--accent)">PHP Project</span>. Built with passion and PHP.
        </p>
        <div style="margin-top: 10px; display: flex; gap: 20px; justify-content: center;">
            <a href="#" style="color: var(--text-dim); text-decoration: none;">Terms</a>
            <a href="#" style="color: var(--text-dim); text-decoration: none;">Privacy</a>
            <a href="#" style="color: var(--text-dim); text-decoration: none;">Support</a>
        </div>
    </div>
</footer>
</body>
</html>