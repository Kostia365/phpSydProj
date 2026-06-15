<div class="container">
    <div class="form-wrapper">
        <h2>Create <span style="color: var(--accent)">Account</span></h2>
        <p style="color: var(--text-dim); text-align: center; margin-bottom: 2rem;">
            Join our platform.
        </p>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'match'): ?>
            <div class="error-message">Passwords do not match!</div>
        <?php endif; ?>

        <form action="/?route=register" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="John Doe" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="name@core.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmPassword" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn">Initialize Access</button>
        </form>
    </div>
</div>