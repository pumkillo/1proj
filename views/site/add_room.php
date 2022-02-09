<h2>Добавление помещения</h2>
<div class="container">
    <form method="post" class="form">
       <input type="text" name="name" placeholder="Название помещения">
       <input type="number" name="" placeholder="Общая площадь">
       <input type="number" name="" placeholder="Количество посадочных мест">
       <select name="type_of_room_id">

       </select>
       <select name="division_id ">

       </select>
       <h3 class="errors"><?= $message ?? ''; ?></h3>
       <button>Добавить</button>
   </form>
</div>