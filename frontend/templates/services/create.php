<h2>Добавить новую услугу</h2>
<form action="/?route=service_save" method="POST">
    <label for="name">Название услуги</label>
    <input type="text" name="name" id="name" placeholder="Например: Аудит кода" required>

    <label for="price">Цена ($)</label>
    <input type="number" name="price" id="price" step="0.01" required>

    <label for="description">Описание</label>
    <textarea name="description" id="description" rows="5"></textarea>

    <button type="submit" class="contrast">Опубликовать услугу</button>
</form>