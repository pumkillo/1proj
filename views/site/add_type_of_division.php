<h2>Добавление вида подразделения</h2>
<div class="container">
    <form method="post" class="form">
        <input type="text" name="name" placeholder="Название вида подразделения" value="<?= $values['name'] ?? '' ?>">
        <?php if (isset($message['name'])) : ?>
            <?php foreach ($message['name'] as $key => $val) : ?>
                <p class="errors"><?= $val ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <button type="submit">Добавить</button>
    </form>
</div>