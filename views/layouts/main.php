<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <link rel="stylesheet" href="<?php ?>">
   <title><?= $title ?? '' ?></title>
   <style>
      <?php include 'assets/css/style.css'?>
   </style>
</head>
<body>
   <header>
      <a href="feed"><h1>Учет площади помещений</h1></a>
      <?php if(app()->auth->user() === null): ?>
         <a href="login">Войти</a>
         <a href="signup">Зарегистрироваться</a>
      <?php else: ?>
         <a href="logout">Выйти</a>
      <?php endif; ?>
   </header>
   <?php if (app()->auth->isAdmin()): ?>
      <div class="admin-panel">
         <a href="add-room">Добавить помещение</a>
         <a href="add-division">Добавить подразделение</a>
         <a href="add-type-of-room">Добавить тип помещения</a>
         <a href="add-type-of-division">Добавить вид подразделения</a>
      </div>
   <?php endif; ?>
      <?= $content ?? ''; ?>
   <footer>
      <p>&copy 2022 Учет площади помещений</p>
   </footer>
</body>
</html>
