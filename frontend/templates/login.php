<h1>Вход в систему</h1>

<?php if (isset($error)): ?>
    <article class="error">
        ⚠️ <?= htmlspecialchars($error) ?>
    </article>
<?php endif; ?>

<?php if (isset($_GET['success'])): ?>
    <article style="background: #43a047; color: white;">
        ✅ Вы успешно зарегистрированы! Теперь войдите.
    </article>
<?php endif; ?>

<form action="/?action=login" method="POST">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Пароль</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Войти</button>
</form>