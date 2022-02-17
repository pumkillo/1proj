<?php
return [
   //Класс аутентификации
   'auth' => \Src\Auth\Auth::class,
   //Клас пользователя
   'identity' => \Model\User::class,
   'routeMiddleware' => [
      'auth' => \Middlewares\AuthMiddleware::class,
      'admin' => \Middlewares\AdminMiddleware::class,
   ],
   'routeAppMiddleware' => [
      'trim' => \Middlewares\TrimMiddleware::class,
      'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
      'csrf' => \Middlewares\CSRFMiddleware::class,
      'json' => \Middlewares\JSONMiddleware::class,
   ],
   'validators' => [
      'required' => \Validators\RequireValidator::class,
      'unique' => \Validators\UniqueValidator::class,
      'password' => \Validators\PasswordValidator::class,
      'min-max-length' => \Validators\MinMaxLengthValidator::class,
      'date' => \Validators\DateValidator::class,
      'english-only' => \Validators\EnglishOnlyValidator::class,
   ],
   'providers' => [
      'kernel' => \Providers\KernelProvider::class,
      'route' => \Providers\RouteProvider::class,
      'db' => \Providers\DBProvider::class,
      'auth' => \Providers\AuthProvider::class,
   ],
];
