<h2>Добавление помещения</h2>
<div class="container">
    <form method="post" class="form">
        <input type="text" name="name" placeholder="Название помещения" value="<?= $values['name'] ?? '' ?>">
        <?php if (isset($message['name'])) : ?>
            <?php foreach ($message['name'] as $key => $val) : ?>
                <p class="errors"><?= $val ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <input type="number" name="square" placeholder="Общая площадь" value="<?= $values['square'] ?? '' ?>">
        <?php if (isset($message['square'])) : ?>
            <?php foreach ($message['square'] as $key => $val) : ?>
                <p class="errors"><?= $val ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <input type="number" name="amount_of_seats" placeholder="Количество посадочных мест" value="<?= $values['amount_of_seats'] ?? '' ?>">
        <?php if (isset($message['amount_of_seats'])) : ?>
            <?php foreach ($message['amount_of_seats'] as $key => $val) : ?>
                <p class="errors"><?= $val ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <select name="type_of_room_id">
            <?php foreach ($type_of_rooms as $type) : ?>
                <option value="<?= $type->id ?>" <?php echo (isset($values) && $values['type_of_room_id'] == $type->id) ? 'selected' : ''; ?>><?= $type->name ?></option>
            <?php endforeach; ?>
        </select>
        <select name="division_id">
            <?php foreach ($divisions as $division) : ?>
                <option value="<?= $division->id ?>" <?php echo (isset($values) && $values['division_id'] == $division->id) ? 'selected' : ''; ?>><?= $division->name?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Добавить</button>
    </form>
</div>