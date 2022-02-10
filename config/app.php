<?php
return [
   //Класс аутентификации
   'auth' => \Src\Auth\Auth::class,
   //Клас пользователя
   'identity'=>\Model\User::class,
   'routeMiddleware' => [
      'auth' => \Middlewares\AuthMiddleware::class,
      'admin' => \Middlewares\AdminMiddleware::class,
   ],
   'validators' => [
      'required' => \Validators\RequireValidator::class,
      'unique' => \Validators\UniqueValidator::class,
      'max-length' => \Validators\MaxLengthValidator::class,
      'min-length' => \Validators\MinLengthValidator::class,
   ],
];
