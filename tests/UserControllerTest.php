<?php

use PHPUnit\Framework\TestCase;
use Model\User;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = 'насрать свое #######D:/Xampp/xampp/htdocs/1proj';

        //Создаем экземпляр приложения
        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
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
     * @dataProvider additionProvider
     * @runInSeparateProcess
     */
    public function testSignup(string $httpMethod, array $userData, string $message): void
    {
        //Выбираем занятый логин из базы данных
        if ($userData['login'] === 'pumkillo') {
            $userData['login'] = User::get()->first()->login;
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


    //Метод, возвращающий набор тестовых данных
    public function additionProvider(): array
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
                '',
            ],
            // проверка на отработку валидатора уникальных значений
            [
                'POST', ['login' => 'pumkillo', 'password' => '', 'name' => '', 'surname' => '', 'patronymic' => '', 'birthdate' => '', 'role_id' => ''],
                '<p class="errors">Поле login должно быть уникально.</p>',
            ],
            // проверка на отработку регистрации пользователя
            [
                'POST', ['login' => '', 'password' => '', 'name' => '', 'surname' => '', 'patronymic' => '', 'birthdate' => '', 'role_id' => ''],
                'Location: /1proj/login',
            ],
        ];
    }
}
