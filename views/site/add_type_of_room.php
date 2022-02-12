<h2>Добавление типа помещения</h2>
<div class="container">
    <form method="post" class="form">
        <input type="text" name="name" placeholder="Название типа помещения" value="<?= $values['name'] ?? '' ?>">
        <?php if (isset($message['name'])) : ?>
            <?php foreach ($message['name'] as $key => $val) : ?>
                <p class="errors"><?= $val ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <button type="submit">Добавить</button>
    </form>
</div>