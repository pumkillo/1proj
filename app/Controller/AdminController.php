<?php

namespace Controller;

use Model\Division;
use Model\DivisionsType;
use Model\Room;
use Src\View;
use Model\RoomsType;
use Src\Request;
use Src\Validator\Validator;

class AdminController
{
    public function add_room(Request $request): string
    {
        $type_of_rooms = RoomsType::all();
        $divisions = Division::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['unique:rooms,name', 'required'],
                'square' => ['required'],
                'amount_of_seats' => ['required'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $values = $request->all();
                return new View('site.add_room', [
                    'message' => $errors,
                    'values' => $values,
                    'title' => 'Добавление помещения',
                    'type_of_rooms' => $type_of_rooms,
                    'divisions' => $divisions,
                ]);
            }

            if (Room::create($request->all())) {
                app()->route->redirect('/add-room');
                return false;
            }
        }
        return new View('site.add_room', [
            'title' => 'Добавление помещения',
            'type_of_rooms' => $type_of_rooms,
            'divisions' => $divisions,
        ]);
    }

    public function add_division(Request $request): string
    {
        $division_types = DivisionsType::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'min-max-length:,4,50'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $values = $request->all();
                return new View('site.add_division', [
                    'message' => $errors,
                    'values' => $values,
                    'division_types' => $division_types,
                    'title' => 'Добавление подразделения',
                ]);
            }
            if (Division::create($request->all())) {
                app()->route->redirect('/add-division');
                return false;
            }
        }
        return new View('site.add_division', [
            'title' => 'Добавление подразделения',
            'division_types' => $division_types,
        ]);
    }

    public function add_type_of_room(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'min-max-length:,4,50'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $values = $request->all();
                return new View('site.add_type_of_room', [
                    'message' => $errors,
                    'values' => $values,
                    'title' => 'Добавление подразделения',
                ]);
            }
            if (RoomsType::create($request->all())) {
                app()->route->redirect('/add-type-of-room');
                return false;
            }
        }
        return new View('site.add_type_of_room', ['title' => 'Добавление вида помещения']);
    }

    public function add_type_of_division(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'min-max-length:,4,50'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $values = $request->all();
                return new View('site.add_type_of_division', [
                    'message' => $errors,
                    'values' => $values,
                    'title' => 'Добавление подразделения',
                ]);
            }
            if (DivisionsType::create($request->all())) {
                app()->route->redirect('/add-type-of-division');
                return false;
            }
        }
        return new View('site.add_type_of_division', ['title' => 'Добавление вида подразделения']);
    }
}
