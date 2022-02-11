<h2>Добавление помещения</h2>
<div class="container">
    <form method="post" class="form">
        <input type="text" name="name" placeholder="Название помещения">
        <input type="number" name="square" placeholder="Общая площадь">
        <input type="number" name="amount_of_seats" placeholder="Количество посадочных мест">
        <select name="type_of_room_id">
            <?php foreach ($type_of_rooms as $type) : ?>
                <option value="<?= $type->id ?>"><?= $type->name ?></option>
            <?php endforeach; ?>
        </select>
        <select name="division_id">
            <?php foreach ($divisions as $division) : ?>
                <option value="<?= $division->id ?>"><?= $division->name ?></option>
            <?php endforeach; ?>
        </select>
        <h3 class="errors"><?= $message ?? ''; ?></h3>
        <button>Добавить</button>
    </form>
</div>