<!-- frontend/templates/dashboard.php -->
<div class="container">
    <div class="hero" style="text-align: left; padding: 40px 0;">
        <h1>Welcome, <span style="color: var(--accent);"><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></span>!</h1>
        <p style="color: var(--text-dim);">You have successfully bypassed the security matrix. Your role is: <strong><?= htmlspecialchars($_SESSION['user_role'] ?? 'customer') ?></strong></p>
    </div>

    <div class="grid">
        <article style="border: 1px solid var(--accent); box-shadow: 0 0 15px var(--accent-glow);">
            <div style="font-size: 2rem; margin-bottom: 1rem;">🚀</div>
            <h3>Quick Start</h3>
            <p>You can now access exclusive member features and book appointments.</p>
            <a href="/?route=services" class="btn" style="margin-top: 15px;">View Services</a>
        </article>

        <article>
            <div style="font-size: 2rem; margin-bottom: 1rem;">⚙️</div>
            <h3>Settings</h3>
            <p>Email: <?= htmlspecialchars($_SESSION['user_email'] ?? 'Not found') ?></p>
            <p>ID: #<?= htmlspecialchars($_SESSION['user_id'] ?? '0') ?></p>
        </article>

        <article>
            <div style="font-size: 2rem; margin-bottom: 1rem;">🛡️</div>
            <h3>Security</h3>
            <p>Your session is encrypted and secure.</p>
            <a href="/?route=logout" style="color: var(--accent); text-decoration: none; display: block; margin-top: 10px;">Logout session →</a>
        </article>
    </div>
</div>