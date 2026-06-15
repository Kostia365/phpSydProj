<?php
/** @var array $services */

$isAdmin = ($_SESSION['user_role'] ?? null) === 'admin';
?>

    <div class="headings">
        <h2>Our Services</h2>

        <?php if ($isAdmin): ?>
            <a href="/?route=service-create" class="button outline">+ Add Service</a>
        <?php endif; ?>
    </div>

<?php if (empty($services)): ?>
    <article>
        <p>No services available yet.</p>
    </article>
<?php else: ?>
    <div class="grid">
        <?php foreach ($services as $service): ?>
            <article>
                <header>
                    <strong><?= htmlspecialchars($service['name']) ?></strong>
                </header>

                <p>
                    Duration:
                    <?= (int)$service['duration_minutes'] ?>
                    minutes
                </p>

                <footer>
                    <strong>$<?= number_format((float)$service['price'], 2) ?></strong>

                    <div style="margin-top: 1rem; display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        <a href="/?route=booking&service_id=<?= (int)$service['id'] ?>" class="btn">
                            Book Now
                        </a>

                        <?php if ($isAdmin): ?>
                            <a href="/?route=service-edit&id=<?= (int)$service['id'] ?>" class="btn btn-secondary">
                                Edit
                            </a>

                            <a href="/?route=service-delete&id=<?= (int)$service['id'] ?>"
                               class="btn btn-secondary"
                               onclick="return confirm('Delete this service?')">
                                Delete
                            </a>
                        <?php endif; ?>
                    </div>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>