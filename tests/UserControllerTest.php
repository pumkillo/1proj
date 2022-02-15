<?php

use PHPUnit\Framework\TestCase;
use Model\User;
use Model\Role;

class UserControllerTest extends TestCase
{
    public function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = 'D:/Xampp/xampp/htdocs';

        //Создаем экземпляр приложения
        $GLOBALS['app'] = new \Src\Application(new \Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/1proj/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/1proj/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/1proj/config/path.php',
        ]));

        //Глобальная функция для доступа к объекту приложения
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }

    /**
     * @dataProvider signupProvider
     * @runInSeparateProcess
     */
    public function testSignup(string $httpMethod, array $userData, string $message): void
    {
        //Выбираем занятый логин из базы данных
        if ($userData['login'] === 'login is busy') {
            $userData['login'] = User::get()->first()->login;
        }

        //Выбираем первый айдишник существующей роли
        if ($userData['role_id'] === '') {
            $userData['role_id'] = Role::get()->first()->id;
        }
        
        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\UserController())->signup($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем добавился ли пользователь в базу данных
        $this->assertTrue((bool)User::where('login', $userData['login'])->count());
        //Удаляем созданного пользователя из базы данных
        User::where('login', $userData['login'])->delete();

        //Проверяем редирект при успешной регистрации
        $this->assertContains($message, xdebug_get_headers());
    }


    /**
     * @dataProvider loginProvider
     * @runInSeparateProcess
     */
    public function testLogin(string $httpMethod, array $userData, string $message)
    {

        $userData['csrf_token'] = (new \Src\Auth\Auth())->generateCSRF();
        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\UserController())->login($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем редирект при успешной авторизации
        $this->assertContains($message, xdebug_get_headers());
    }

    public function loginProvider(): array
    {
        return [
            // проверка на загрузку страницы
            [
                'GET', ['login' => '', 'csrf_token' => '', 'password' => ''],
                ''
            ],
            // проверка на соотнесение введенных данных с данными в БД (логин и пароль юзера)
            [
                'POST', ['login' => 'dogkeopksaoiejf', 'csrf_token' => '', 'password' => 'rdgkporioej'],
                '<h3 class="errors">Вы ввели неверные данные</h3>',
            ],
            // проверка на отработку аутентификации пользователя
            [
                'POST', ['login' => 'pumkillo', 'csrf_token' => '', 'password' => '123456'],
                'Location: /1proj/',
            ],
        ];
    }

    //Метод, возвращающий набор тестовых данных
    public function signupProvider(): array
    {
        return [
            // проверка на загрузку страницы
            [
                'GET', ['login' => '', 'password' => '', 'name' => '', 'surname' => '', 'patronymic' => '', 'birthdate' => '', 'role_id' => ''],
                ''
            ],
            // проверка на отработку валидатора на пустые значения
            [
                'POST', ['login' => '', 'password' => '', 'name' => '', 'surname' => '', 'patronymic' => '', 'birthdate' => '', 'role_id' => ''],
                '<p class="errors">Поле login обязательно.</p>',
            ],
            // проверка на отработку валидатора уникальных значений
            [
                'POST', ['login' => 'login is busy', 'password' => '', 'name' => '', 'surname' => '', 'patronymic' => '', 'birthdate' => '', 'role_id' => ''],
                '<p class="errors">Поле login должно быть уникально.</p>',
            ],
            // проверка на отработку регистрации пользователя
            [
                'POST', ['login' => 'usertest', 'password' => '289KJosf0esf', 'name' => 'sdplkfpske', 'surname' => 'segesgegs', 'patronymic' => 'dxhrgksopgko', 'birthdate' => '2000-04-04', 'role_id' => '1'],
                'Location: /1proj/login',
            ],
        ];
    }
}
