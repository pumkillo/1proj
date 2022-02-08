<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <link rel="stylesheet" href="<?php ?>">
   <title><?= $title ?? '' ?></title>
   <style>
      <?php include 'style.css'?>
   </style>
</head>
<body>
   <header>
      <a href="feed"><h1>Учет площади помещений</h1></a>
      <?php if(app()->auth->user() === null) {
         echo '<a href="login">Войти</a>';
         echo '<a href="signup">Зарегистрироваться</a>';
      } else{
         echo '<a href="logout">Выйти из аккаунта</a>';
      }
      ?>
   </header>
      <?= $content ?? ''; ?>
   <footer>
      <p>&copy 2022 Учет площади помещений</p>
   </footer>
</body>
</html>
