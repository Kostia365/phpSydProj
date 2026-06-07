<h2>Редактировать услугу</h2>
<form action="/?route=service_update" method="POST">
    <input type="hidden" name="id" value="1">

    <label>Название
        <input type="text" name="name" value="Backend Development">
    </label>

    <button type="submit">Сохранить изменения</button>
    <a href="/?route=services" class="secondary">Отмена</a>
</form>