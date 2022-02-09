<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Model\TypesOfRoom;
use Model\Division;
use Model\Room;
use Src\View;
use Src\Request;
use Src\Validator\Validator;

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
       $room_type = TypesOfRoom::get();
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
       $rooms = Room::get();
       return new View('site.seats', [
           'title' => 'Количество посадочных мест',
           'rooms' => $rooms,
           'divisions' => $divisions,
        ]);
   }

   public function square_filter(Request $request) :string
   {
       $rooms = Room::get();
       $types_of_rooms = TypesOfRoom::get();
    //    $types_of_rooms = TypesOfRoom::where('id', $request.GET['type_of_room']);
       return new View('site.sqaure', [
           'rooms' => $rooms,
           'title' => 'Площадь помещений',
           'types_of_rooms' => $types_of_rooms,
        ]);
   }

   public function rooms_filter(Request $request) :string
   {
       $rooms = Room::get();
       $divisions = Division::get();
       return new View('site.rooms', [
           'title' => 'Помещения',
           'rooms' => $rooms,
           'divisions' => $divisions,
        ]);
   }

   public function add_room(Request $request) :string
   {
       return new View('site.add_room', ['title' => 'Помещения']);
   }

   public function add_division(Request $request) :string
   {
       return new View('site.add_division', ['title' => 'Помещения']);
   }

   public function add_type_of_room(Request $request) :string
   {
       return new View('site.add_type_of_room', ['title' => 'Помещения']);
   }

   public function add_type_of_division(Request $request) :string
   {
       return new View('site.add_type_of_division', ['title' => 'Помещения']);
   }

}