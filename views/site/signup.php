<h2>Регистрация</h2>
<form method="post" class="form">
   <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
   <input type="text" name="login" placeholder="Логин" value="<?= $values['login'] ?? '' ?>">
   <?php
   if (isset($message['login'])) {
      foreach ($message['login'] as $key => $val) {
         echo '<p class="errors">' . $val . '</p>';
      }
   }
   ?>
   <input type="password" name="password" placeholder="Пароль">
   <?php
   if (isset($message['password'])) {
      foreach ($message['password'] as $key => $val) {
         echo '<p class="errors">' . $val . '</p>';
      }
   }
   ?>
   <input type="text" name="name" placeholder="Имя" value="<?= $values['name'] ?? '' ?>">
   <?php
   if (isset($message['name'])) {
      foreach ($message['name'] as $key => $val) {
         echo '<p class="errors">' . $val . '</p>';
      }
   }
   ?>
   <input type="text" name="surname" placeholder="Фамилиия" value="<?= $values['surname'] ?? '' ?>">
   <?php
   if (isset($message['surname'])) {
      foreach ($message['surname'] as $key => $val) {
         echo '<p class="errors">' . $val . '</p>';
      }
   }
   ?>
   <input type="text" name="patronymic" placeholder="Отчество" value="<?= $values['patronymic'] ?? '' ?>">
   <?php
   if (isset($message['patronymic'])) {
      foreach ($message['patronymic'] as $key => $val) {
         echo '<p class="errors">' . $val . '</p>';
      }
   }
   ?>
   <input type="date" name="birthdate" placeholder="Дата рождения" value="<?= $values['birthdate'] ?? '' ?>">
   <?php
   if (isset($message['birthdate'])) {
      foreach ($message['birthdate'] as $key => $val) {
         echo '<p class="errors">' . $val . '</p>';
      }
   }
   ?>
   <select name="role_id">
      <?php foreach ($roles as $role) : ?>
         <option value="<?= $role->id ?>" <?php echo (isset($values) && $values['role_id'] == $role->id) ? 'selected' : ''; ?>><?= $role->name ?></option>
      <?php endforeach; ?>
   </select>
   <button>Зарегистрироваться</button>
</form>