<h2>Добавление типа помещения</h2>
<div class="container">
    <form method="post" class="form">
       <input type="text" name="name" placeholder="Название типа помещения">
       <h3 class="errors"><?= $message ?? ''; ?></h3>
       <button>Добавить</button>
   </form>
</div>