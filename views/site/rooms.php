<h2>Названия помещений по подразделениям</h2>
<div class="container">
    <div class="query-result">
        <h3>Фильтр</h3>
        <form method='get' class='filter'>
            <select name='type_of_room'>
            <?php foreach($divisions as $division): ?>
                <option value="<?= $division->id ?>"><?= $division->name ?></option>
            <?php endforeach; ?>
            </select>
            <button type='submit'>Применить</button>
        </form>
        <h3>Результат запроса</h3>
        <?php foreach($rooms as $room): ?>
            <div class="room">
                <h4><?= $room->name ?></h4>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="static-links">
        <h3>Показать:</h3>
        <a href="rooms-filter"><h4>Названия помещений по подразделениям</h4></a>
        <a href="square-filter"><h4>Общую площадь помещений по видам помещений и в целом по учебному заведению</h4></a>
        <a href="seats-filter"><h4>Общее количество посадочных мест по подразделениям</h4></a>
    </div>
</div>