<h2>Добавление вида подразделения</h2>
<div class="container">
    <form method="post" class="form">
        <input type="text" name="name" placeholder="Название вида подразделения">
        <h3 class="errors"><?= $message ?? ''; ?></h3>
        <button>Добавить</button>
    </form>
</div>