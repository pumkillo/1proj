<h2>Общую площадь помещений по видам помещений</h2>
<div class="container">
    <div class="query-result">
        <h3>Фильтр</h3>
        <form method='get' class='filter'>
            <select name='type_of_room'>
                <option value="all">Все</option>
                <?php foreach ($types_of_rooms as $type_of_rooms) : ?>
                    <option value="<?= $type_of_rooms->id ?>"><?= $type_of_rooms->name ?></option>
                <?php endforeach; ?>
            </select>
            <button type='submit'>Применить</button>
        </form>
        <h3>Результат запроса</h3>
        <h4>Общая площадь:</h4>
        <h5><?php echo $rooms_square; ?>кв. м</h5>
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
<script defer>
    let url_string = window.location.href;
    let url = new URL(url_string);
    let paramValue = url.searchParams.get('type_of_room');
    document.querySelector(`option[value="${paramValue}"]`).selected = true;
</script>