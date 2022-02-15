<?php

use PHPUnit\Framework\TestCase;
use Model\User;
use Model\RoomsType;
use Model\Division;
use Model\Room;

class AdminControllerTest extends TestCase
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
     * @dataProvider addRoomProvider
     * @runInSeparateProcess
     */
    public function testAddRoom(string $httpMethod, array $userData, string $message)
    {
        // Генерируем токен
        $userData['csrf_token'] = (new \Src\Auth\Auth())->generateCSRF();

        //Выбираем айди типа помещения
        if ($userData['type_of_room_id'] === '') {
            $userData['type_of_room_id'] = RoomsType::get()->first()->id;
        }

        //Выбираем айди подразделения
        if ($userData['division_id'] === '') {
            $userData['division_id'] = Division::get()->first()->id;
        }

        // Выбираем занятое название помещения
        if ($userData['name'] === 'name is busy') {
            $userData['name'] = Room::get()->first()->name;
        }

        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\AdminFunctionsController())->add_room($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }


        //Проверяем добавилось ли помещение в базу данных
        $this->assertTrue((bool)Room::where('name', $userData['name'])->count());
        //Удаляем созданное помещение из базы данных
        Room::where('name', $userData['name'])->delete();
        
        //Проверяем редирект при успешной авторизации
        $this->assertContains($message, xdebug_get_headers());
    }

    public function addRoomProvider(): array
    {
        return [
            // проверка на загрузку страницы
            [
                'GET', ['csrf_token' => '', 'name' => '', 'square' => '', 'amount_of_seats' => '', 'type_of_room_id' => '', 'division_id' => ''],
                ''
            ],
            // проверка на соотнесение введенных данных с данными в БД (логин и пароль юзера)
            [
                'POST', ['csrf_token' => '', 'name' => '', 'square' => '', 'amount_of_seats' => '', 'type_of_room_id' => '', 'division_id' => ''],
                '<p class="errors">Поле name обязательно.</p>'
            ],
            // проверка на отработку аутентификации пользователя
            [
                'POST', ['csrf_token' => '', 'name' => 'name is busy', 'square' => '', 'amount_of_seats' => '', 'type_of_room_id' => '', 'division_id' => ''],
                '<p class="errors">Поле name должно быть уникально.</p>'
            ],
            // проверка на добавление помещения в БД
            [
                'POST', ['csrf_token' => '', 'name' => 'kjskdjfso', 'square' => '20', 'amount_of_seats' => '30', 'type_of_room_id' => '', 'division_id' => ''],
                'Location: /1proj/add-room'
            ],
        ];
    }
}