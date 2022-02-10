<?php

namespace Controller;

// use Illuminate\Database\Capsule\Manager as DB;
use Model\RoomsType;
use Model\Division;
use Model\Room;
use Src\View;
use Src\Request;
// use Src\Validator\Validator;

class RoomsController
{
   public function index() :string
   {
       app()->route->redirect('/feed');
       return 'index';
   }

   public function feed() :string
   {
       $rooms = Room::get();
       $room_type = RoomsType::get();
       $divisions = Division::get();
       return new View('site.feed', [
           'title' => 'Главная', 
           'rooms' => $rooms, 
           'room_type' => $room_type, 
           'divisions' => $divisions,
        ]);
   }

   public function seats_filter(Request $request) :string
   {
       $divisions = Division::get();
       $rooms = Room::where('division_id', '=', $request->get('division_id'))->get();
       return new View('site.seats', [
           'title' => 'Количество посадочных мест',
           'rooms' => $rooms,
           'divisions' => $divisions,
        ]);
   }

   public function square_filter(Request $request) :string
   {
       $room_square = Room::where('type_of_room_id', '=', $request->get('type_of_room'))->sum('square');
       if($request->get('type_of_room') == 0) {
            $room_square = Room::get()->sum('square');
       }
       if($request->get('type_of_room') === null) {
            app()->route->redirect('/square-filter?types_of_room=11');
       }
       $types_of_rooms = RoomsType::get();
       return new View('site.sqaure', [
           'rooms_square' => $room_square,
           'title' => 'Площадь помещений',
           'types_of_rooms' => $types_of_rooms,
        ]);
   }

   public function rooms_filter(Request $request) :string
   {
       $rooms = Room::where('division_id', '=', $request->get('division_id'))->get();
    //    $rooms = Room::get();
       $divisions = Division::get();
       return new View('site.rooms', [
           'title' => 'Помещения',
           'rooms' => $rooms,
           'divisions' => $divisions,
        ]);
   }
}