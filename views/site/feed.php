<h2>Главная страница</h2>
<div class="container">
    <div class="query-result">
        <h3>Все помещения:</h3>
        <?php
        foreach($rooms as $room) {
            echo '<div class="room">';
            echo '<h4>'.$room->name.'</h4>';
            echo '<h5>Вид помещения: '.$room->type_of_room_id.'</h5>';
            echo '<h5>Поразделение: '.$room->division_id.'</h5>';
            echo "</div>";
        }
        echo '<pre>';
        print_r($rooms);
        echo '</pre>';
        // echo array_search(1, array_column($divisions, 'id')); 
        ?>
    </div>
    <div class="static-links">
        <h3>Показать:</h3>
        <a href="rooms-filter"><h4>Названия помещений по подразделениям</h4></a>
        <a href="square-filter"><h4>Общую площадь помещений по видам помещений и в целом по учебному заведению</h4></a>
        <a href="seats-filter"><h4>Общее количество посадочных мест по подразделениям</h4></a>
    </div>
</div>
