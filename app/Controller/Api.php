<?php

namespace Controller;

use Model\Room;
use Model\User;
use Src\Request;
use Src\View;
use Src\Auth\Auth;

class Api
{
    public function index(): void
    {
        $rooms = Room::all()->toArray();

        (new View())->toJSON($rooms);
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }

    public function login(Request $request): void
    {
        $header = getallheaders();
        if (isset($header['bearer_token']) && !empty($header['bearer_token']) && User::where('token', $header['bearer_token'])->count() === 1) {
            (new View())->toJSON(['status_code' => '400', 'data' => ['message' => 'You\'re already logged in.']]);
        }
        if (Auth::attempt($_POST)) {
            $user = User::where('login', '=', $_POST['login']);
            $token = Auth::generateBearer();
            $user->update(['token' => md5(time())]);
            (new View())->toJSON(['status_code' => '200', 'data' => ['token' => $token]]);
        }
        (new View())->toJSON(['status_code' => '401', 'data' => ['error' => 'Incorrect data.']]);
    }

    public function seats_filter(Request $request): void
    {
        $header = getallheaders();
        if (!isset($header['bearer_token']) || empty($header['bearer_token']) || User::where('token', $header['bearer_token'])->count() === 0) {
            (new View())->toJSON(['status_code' => '403', 'data' => ['error' => 'You should be logged in to visit this page.']]);
            return;
        }
        $room_seats = Room::where('division_id', '=', $request->get('division_id'))->sum('amount_of_seats');
        (new View())->toJSON(['status_code' => '200', 'data' => ['count if seats' => $room_seats]]);
    }

    public function logout(Request $request): void
    {
        $header = getallheaders();
        if (!isset($header['bearer_token']) || empty($header['bearer_token']) || User::where('token', $header['bearer_token'])->count() === 0) {
            (new View())->toJSON(['status_code' => '400', 'data' => ['error' => 'You should be logged in to log out.']]);
            return;
        }
        $user = User::where('token', $header['bearer_token']);
        $user->update(['token' => NULL]);
        (new View())->toJSON(['status_code' => '200', 'data' => ['message' => 'You have been logged out']]);
    }
}
