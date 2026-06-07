<h2>Забронировать услугу</h2>
<form action="/?route=booking_submit" method="POST">
    <label for="service_id">Выберите услугу</label>
    <select name="service_id" id="service_id">
        <option value="1">Разработка PHP</option>
        <option value="2">Дизайн интерфейсов</option>
    </select>

    <label for="date">Желаемая дата</label>
    <input type="date" name="date" id="date" required>

    <label for="notes">Комментарий</label>
    <textarea name="notes" id="notes" placeholder="Опишите ваши пожелания"></textarea>

    <button type="submit">Подтвердить бронь</button>
</form>