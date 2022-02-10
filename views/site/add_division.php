<h2>Добавление подразделения</h2>
<div class="container">
    <form method="post" class="form">
       <input type="text" name="name" placeholder="Название подразделения">
       <select name="type_of_divisions_id">
        <?php foreach($division_types as $type): ?>
            <option value="<?= $type->id ?>"><?= $type->name ?></option>
        <?php endforeach; ?>
       </select>
       <h3 class="errors"><?= $message ?? ''; ?></h3>
       <button>Добавить</button>
   </form>
</div>