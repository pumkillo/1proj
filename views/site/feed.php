<?php
function getName($tableName, $id)
{
    foreach ($tableName as $row) {
        if ($row->id == $id) {
            return $row->name;
        }
    }
    return 'не найдено';
}
?>
<h2>Главная страница</h2>
<div class="container">
    <div class="query-result">
        <h3>Все помещения:</h3>
        <?php
        foreach ($rooms as $room) : ?>
            <div class="room">
                <h4><?= $room->name ?></h4>
                <h5>Вид помещения: <?php echo getName($room_type, $room->type_of_room_id) ?></h5>
                <h5>Подразделение: <?php echo getName($divisions, $room->division_id) ?></h5>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="static-links">
        <h3>Показать:</h3>
        <a href="rooms-filter">
            <h4>Названия помещений по подразделениям</h4>
        </a>
        <a href="square-filter">
            <h4>Общую площадь помещений по видам помещений и в целом по учебному заведению</h4>
        </a>
        <a href="seats-filter">
            <h4>Общее количество посадочных мест по подразделениям</h4>
        </a>
    </div>
</div>