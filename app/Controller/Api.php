<?php

namespace Controller;

use Model\Room;
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
        if (isset($header['bearer_token']) && !empty($header['bearer_token'])) {
            (new View())->toJSON(['status_code' => '400', 'data' => ['message' => 'You\'re already logged in.']]);
        }
        if (!isset($_POST['login']) or !isset($_POST['password'])) {
            (new View())->toJSON(['status_code' => '401', 'data' => ['error' => 'Incorrect data.']]);
        }

        if (Auth::attempt($_POST)) {
            $token = Auth::generateBearer();
            (new View())->toJSON(['token' => $token]);
        }
        (new View())->toJSON(['status_code' => '401', 'data' => ['error' => 'Incorrect data.']]);
    }

    public function seats_filter(Request $request): void
    {
        $header = getallheaders();
        if (!isset($header['bearer_token']) || empty($header['bearer_token'])) {
            (new View())->toJSON(['status_code' => '403', 'data' => ['error' => 'You should be logged in to visit this page.']]);
            return;
        }
        $room_seats = Room::where('division_id', '=', $request->get('division_id'))->sum('amount_of_seats');
        (new View())->toJSON(['status_code' => '200', 'data' => ['data' => $room_seats]]);
    }
}
