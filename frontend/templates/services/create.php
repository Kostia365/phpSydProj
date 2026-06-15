<div class="container">
    <div class="form-wrapper">
        <h2>Add <span style="color: var(--accent)">Service</span></h2>

        <form action="/?route=service-create" method="POST">
            <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" step="0.01" min="0" required>
            </div>

            <div class="form-group">
                <label>Duration Minutes</label>
                <input type="number" name="duration_minutes" min="1" value="30" required>
            </div>

            <button type="submit" class="btn">Create Service</button>
        </form>
    </div>
</div>