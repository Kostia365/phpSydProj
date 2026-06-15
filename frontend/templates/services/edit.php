<?php
/** @var array $service */
?>

<div class="container">
    <div class="form-wrapper">
        <h2>Edit <span style="color: var(--accent)">Service</span></h2>

        <form action="/?route=service-edit&id=<?= (int)$service['id'] ?>" method="POST">
            <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($service['name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="number"
                       name="price"
                       step="0.01"
                       min="0"
                       value="<?= htmlspecialchars((string)$service['price']) ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Duration Minutes</label>
                <input type="number"
                       name="duration_minutes"
                       min="1"
                       value="<?= (int)$service['duration_minutes'] ?>"
                       required>
            </div>

            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>
</div>