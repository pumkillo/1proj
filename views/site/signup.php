<h2>Регистрация</h2>
<form method="post" class="form">
   <input type="text" name="login" placeholder="Логин">
   <?php 
   if (isset($message['login'])){
      foreach ($message['login'] as $key => $val){
         echo '<p class="errors">'.$val.'</p>';
      }
   }
   ?>
   <input type="password" name="password" placeholder="Пароль">
   <?php 
   if (isset($message['password'])){
      foreach ($message['password'] as $key => $val){
         echo '<p class="errors">'.$val.'</p>';
      }
   }
   ?>
   <input type="text" name="name" placeholder="Имя">
   <?php 
   if (isset($message['name'])){
      foreach ($message['name'] as $key => $val){
         echo '<p class="errors">'.$val.'</p>';
      }
   }
   ?>
   <input type="text" name="surname" placeholder="Фамилиия">
   <?php 
   if (isset($message['surname'])){
      foreach ($message['surname'] as $key => $val){
         echo '<p class="errors">'.$val.'</p>';
      }
   }
   ?>
   <input type="text" name="patronymic" placeholder="Отчество">
   <?php 
   if (isset($message['patronymic'])){
      foreach ($message['patronymic'] as $key => $val){
         echo '<p class="errors">'.$val.'</p>';
      }
   }
   ?>
   <input type="date" name="birthdate" placeholder="Дата рождения">
   <?php 
   if (isset($message['birthdate'])){
      foreach ($message['birthdate'] as $key => $val){
         echo '<p class="errors">'.$val.'</p>';
      }
   }
   ?>
   <select name="role_id">
      <?php foreach($roles as $role): ?>
         <option value="<?= $role->id ?>"><?= $role->name ?></option>
      <?php endforeach; ?>
   </select> 
   <button>Зарегистрироваться</button>
</form>
