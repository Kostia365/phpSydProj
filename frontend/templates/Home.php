<?php
// Set timezone
date_default_timezone_set('Europe/Moscow');

$hour = (int)date('G');
if ($hour >= 7 && $hour < 10) {
    $greeting = "Good Morning";
} elseif ($hour >= 10 && $hour < 17) {
    $greeting = "Good Day";
} elseif ($hour >= 17 && $hour < 22) {
    $greeting = "Good Evening";
} else {
    $greeting = "Good Night";
}
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="greeting-text"><?= $greeting ?></h1>
        <p>Welcome to <strong>PHP Project</strong>. We provide high-end digital solutions with a focus on speed,
            security, and futuristic design.</p>
        <div style="display:flex; gap:15px; justify-content:center; margin-top: 30px;">
            <a href="/?route=register" class="btn">Join Now</a>
            <a href="/?route=login" class="btn btn-secondary"
               style="background: var(--input-bg); color: var(--text-white); width: auto;">Sign In</a>
        </div>
    </div>
</section>

<section class="features" style="padding: 40px 0;">
    <div class="container">
        <h2 style="text-align: center; margin-bottom: 40px; color: var(--accent);">Why Choose Us</h2>
        <div class="grid">
            <article>
                <div style="font-size: 2rem; margin-bottom: 15px;">⚡</div>
                <h3>Ultra Fast</h3>
                <p>Built on a custom PHP routing engine for maximum performance and near-zero latency.</p>
            </article>

            <article>
                <div style="font-size: 2rem; margin-bottom: 15px;">🔒</div>
                <h3>Secure by Design</h3>
                <p>Enterprise-grade encryption and secure PDO database connections to keep your data safe.</p>
            </article>

            <article>
                <div style="font-size: 2rem; margin-bottom: 15px;">🎨</div>
                <h3>Neon UI</h3>
                <p>A sleek, dark-themed interface powered by custom CSS and the #00efe7 accent color.</p>
            </article>
        </div>
    </div>
</section>

<section class="about"
         style="padding: 60px 0; background: rgba(255,255,255,0.02); border-radius: 30px; margin-bottom: 50px;">
    <div class="container">
        <div style="display: flex; flex-wrap: wrap; gap: 40px; align-items: center;">
            <div style="flex: 1; min-width: 300px;">
                <h2 style="color: var(--accent); margin-bottom: 20px;">Pushing Boundaries</h2>
                <p style="color: var(--text-dim); margin-bottom: 15px;">Our project is more than just a template. It's a
                    demonstration of how a clean MVC structure can be lightweight yet incredibly powerful.</p>
                <p style="color: var(--text-dim);">We don't use heavy frameworks. Every line of code is written for a
                    specific purpose, ensuring you get the most efficient experience possible.</p>
            </div>
            <div style="flex: 1; min-width: 300px; border: 2px border: 1px solid var(--accent); border-radius: 20px; padding: 20px; text-align: center; box-shadow: 0 0 15px var(--accent-glow);">
                <code style="color: var(--accent); font-size: 0.9rem;">
                    // Optimized Backend Logic <br>
                    $router->dispatch($_SERVER['REQUEST_URI']);
                </code>
            </div>
        </div>
    </div>
</section>