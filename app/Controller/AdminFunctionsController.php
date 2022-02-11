<?php

namespace Controller;

use Model\Division;
use Model\DivisionsType;
use Model\Room;
use Src\View;
use Model\RoomsType;
use Src\Request;
use Src\Validator\Validator;

class AdminFunctionsController
{
    public function add_room(Request $request): string
    {
        $type_of_rooms = RoomsType::get();
        $divisions = Division::get();
        if ($request->method === 'POST') {
            if (Room::create($request->all())) {
                app()->route->redirect('/add-room');
            }
        }
        return new View('site.add_room', [
            'title' => 'Помещения',
            'type_of_rooms' => $type_of_rooms,
            'divisions' => $divisions,
        ]);
    }

    public function add_division(Request $request): string
    {
        $division_types = DivisionsType::get();
        if ($request->method === 'POST') {
            if (Division::create($request->all())) {
                app()->route->redirect('/add-division');
            }
        }
        return new View('site.add_division', [
            'title' => 'Помещения',
            'division_types' => $division_types,
        ]);
    }

    public function add_type_of_room(Request $request): string
    {
        if ($request->method === 'POST') {
            if (RoomsType::create($request->all())) {
                app()->route->redirect('/add-type-of-room');
            }
        }
        return new View('site.add_type_of_room', ['title' => 'Помещения']);
    }

    public function add_type_of_division(Request $request): string
    {
        if ($request->method === 'POST') {
            if (DivisionsType::create($request->all())) {
                app()->route->redirect('/add-type-of-division');
            }
        }
        return new View('site.add_type_of_division', ['title' => 'Помещения']);
    }
}
