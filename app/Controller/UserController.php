<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\User;
use Model\Role;
use Src\Validator\Validator;
use Src\Auth\Auth;

class UserController
{
    public function signup(Request $request): string
    {
        $roles = Role::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'login' => ['required', 'unique:users,login', 'min-max-length:,8,20'],
                'password' => ['required', 'password'],
                'name' => ['required', 'min-max-length:,2,30'],
                'surname' => ['required', 'min-max-length:,5,32'],
                'patronymic' => ['required', 'min-max-length:,6,40'],
                'birthdate' => ['required', 'date'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $values = $request->all();
                unset($values['password']);
                return new View('site.signup', [
                    'title' => 'Регистрация',
                    'message' => $errors,
                    'values' => $values,
                    'roles' => $roles,
                ]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup', [
            'title' => 'Регистрация',
            'roles' => $roles,
        ]);
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
