<?php
    function sumSeats($rooms) {
        $sum = 0;
        foreach($rooms as $room) {
            $sum += $room->amount_of_seats;
        }
        return $sum;
    }
?>
<h2>Общее количество посадочных мест по подразделениям</h2>
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
        <h4>Общее количество посадочных мест:</h4>
        <h5><?php echo sumSeats($rooms); ?></h5>
    </div>
    <div class="static-links">
        <h3>Показать:</h3>
        <a href="rooms-filter"><h4>Названия помещений по подразделениям</h4></a>
        <a href="square-filter"><h4>Общую площадь помещений по видам помещений и в целом по учебному заведению</h4></a>
        <a href="seats-filter"><h4>Общее количество посадочных мест по подразделениям</h4></a>
    </div>
</div>