<div class="container">
    <div class="form-wrapper">
        <h2>Sign <span style="color: var(--accent)">In</span></h2>

        <?php if (isset($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">Registration successful! Please sign in.</div>
        <?php endif; ?>

        <form action="/?route=login" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="name@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn">Sign In</button>
        </form>
    </div>
</div>