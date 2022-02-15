<h2>Добавление подразделения</h2>
<div class="container">
    <form method="post" class="form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
        <input type="text" name="name" placeholder="Название подразделения" value="<?= $values['name'] ?? '' ?>">
        <?php if (isset($message['name'])) : ?>
            <?php foreach ($message['name'] as $key => $val) : ?>
                <p class="errors"><?= $val ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <select name="type_of_division_id">
            <?php foreach ($division_types as $type) : ?>
                <option value="<?= $type->id ?>" <?php echo (isset($values) && $values['type_of_division_id'] == $type->id) ? 'selected' : ''; ?>><?= $type->name ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Добавить</button>
    </form>
</div>