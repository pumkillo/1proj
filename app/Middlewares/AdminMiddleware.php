<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь не админ, то генерируется ошибка
        if (!Auth::isAdmin()) {
            app()->route->redirect('/login');
        }
    }
}
