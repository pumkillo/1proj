<?php

namespace Src\Auth;

use Src\Session;

class Auth
{
    //Свойство для хранения любого класса, реализующего интерфейс IdentityInterface
    private static IdentityInterface $user;

    //Инициализация класса пользователя
    public static function init(IdentityInterface $user): void
    {
        self::$user = $user;
        if (self::user()) {
            self::login(self::user());
        }
    }

    public static function generateBearer(): string
    {
        $token = md5(time());
        return $token;
    }

    public static function generateCSRF(): string
    {
        $token = md5(time());
        Session::set('csrf_token', $token);
        return $token;
    }


    //Вход пользователя по модели
    public static function login(IdentityInterface $user): void
    {
        self::$user = $user;
        Session::set('id', self::$user->getId());
    }

    //Аутентификация пользователя и вход по учетным данным
    public static function attempt(array $credentials): bool
    {
        if ($user = self::$user->attemptIdentity($credentials)) {
            self::login($user);
            return true;
        }
        return false;
    }

    //Возврат текущего аутентифицированного пользователя
    public static function user()
    {
        $id = Session::get('id') ?? 0;
        return self::$user->findIdentity($id);
    }

    //Проверка является ли текущий пользователь аутентифицированным
    public static function check(): bool
    {
        return self::user() ? true : false;
    }

    // Проверка является ли пользователь админом
    // Айдишник номер 1 закреплен за админом
    public static function isAdmin(): bool
    {
        return (self::check() && self::user()->role_id === 1) ? true : false;
    }

    //Выход текущего пользователя
    public static function logout(): bool
    {
        Session::clear('id');
        return true;
    }
}
