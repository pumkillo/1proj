<h2>Общее количество посадочных мест по подразделениям</h2>
<div class="container">
    <div class="query-result">
        <h3>Фильтр</h3>
        <form method='get' class='filter'>
            <select name='division_id'>
                <?php foreach ($divisions as $division) : ?>
                    <option value="<?= $division->id ?>"><?= $division->name ?></option>
                <?php endforeach; ?>
            </select>
            <button type='submit'>Применить</button>
        </form>
        <h3>Результат запроса</h3>
        <h4>Общее количество посадочных мест:</h4>
        <h5><?= $room_seats ?? 0 ?></h5>
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
    let paramValue = url.searchParams.get('division_id');
    document.querySelector(`option[value="${paramValue}"]`).selected = true;
</script>