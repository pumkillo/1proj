<?php

namespace Controller;

// use Illuminate\Database\Capsule\Manager as DB;
use Src\View;
use Src\Request;
use Model\User;
use Src\Validator\Validator;
use Src\Auth\Auth;

class UserController
{
   public function signup(Request $request): string
   {
       if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'login' => ['required', 'unique:users,login'],
                'password' => ['required'],
                'name' => ['required'],
                'surname' => ['required'],
                'patronymic' => ['required'],
                'birthdate' => ['required'],
                'role_id' => ['required'],
            ], [
                'required' => 'Это поле не должно быть пустым',
                'unique' => 'Это поле должно быть уникально'
            ]);
    
            if($validator->fails()){
                return new View('site.signup',
                    ['message' => $validator->errors()]);
            }
    
            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup', ['title' => 'Регистрация']);
   }

   public function login(Request $request): string
   {
      //Если просто обращение к странице, то отобразить форму
      if ($request->method === 'GET') {
          return new View('site.login', ['title' => 'Логин']);
      }
      //Если удалось аутентифицировать пользователя, то редирект
      if (Auth::attempt($request->all())) {
          app()->route->redirect('/');
      }
      //Если аутентификация не удалась, то сообщение об ошибке
      return new View('site.login', ['message' => 'Вы ввели неверные данные', 'title' => 'Логин']);
   }
   
   public function logout(): void
   {
      Auth::logout();
      app()->route->redirect('/');
   }
}