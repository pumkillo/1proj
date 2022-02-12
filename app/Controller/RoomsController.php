<?php

namespace Controller;

use Model\RoomsType;
use Model\Division;
use Model\Room;
use Src\View;
use Src\Request;

class RoomsController
{
    public function index(): string
    {
        app()->route->redirect('/feed');
        return 'index';
    }

    public function feed(): string
    {
        $rooms = Room::all();
        $room_type = RoomsType::all();
        $divisions = Division::all();
        return new View('site.feed', [
            'title' => 'Главная',
            'rooms' => $rooms,
            'room_type' => $room_type,
            'divisions' => $divisions,
        ]);
    }

    public function seats_filter(Request $request): string
    {
        $first_id = Division::orderBy('id')->first()->value('id');
        if (!$request->get('division_id')) {
            return app()->route->redirect('/seats-filter?division_id=' . $first_id);
        }
        $divisions = Division::orderBy('id')->get();
        $room_seats = Room::where('division_id', '=', $request->get('division_id'))->sum('amount_of_seats');
        return new View('site.seats', [
            'title' => 'Количество посадочных мест',
            'room_seats' => $room_seats,
            'divisions' => $divisions,
        ]);
    }

    public function square_filter(Request $request): string
    {
        if (!$request->get('type_of_room')) {
            return app()->route->redirect('/square-filter?type_of_room=all');
        }
        if ($request->get('type_of_room') === 'all') {
            $room_square = Room::all()->sum('square');
        } else {
            $room_square = Room::where('type_of_room_id', '=', $request->get('type_of_room'))->sum('square');
        }
        $types_of_rooms = RoomsType::orderBy('id')->get();
        return new View('site.sqaure', [
            'rooms_square' => $room_square,
            'title' => 'Площадь помещений',
            'types_of_rooms' => $types_of_rooms,
        ]);
    }

    public function rooms_filter(Request $request): string
    {
        $first_id = Division::orderBy('id')->first()->value('id');
        if (!$request->get('division_id')) {
            return app()->route->redirect('/rooms-filter?division_id=' . $first_id);
        }
        $rooms = Room::where('division_id', '=', $request->get('division_id'))->get();
        $divisions = Division::orderBy('id')->get();
        return new View('site.rooms', [
            'title' => 'Помещения по подразделениям',
            'rooms' => $rooms,
            'divisions' => $divisions,
            'first_id' => $first_id,
        ]);
    }
}
