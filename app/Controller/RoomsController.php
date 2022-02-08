<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
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
       $rooms = DB::table('rooms')->get();
       $room_type = DB::table('types of rooms')->get();
       $divisions = DB::table('divisions')->get();
       return new View('site.feed', [
           'title' => 'Главная', 
           'rooms' => $rooms, 
           'room_type' => $room_type, 
           'divisions' => $divisions,
        ]);
   }

   public function seats_filter(Request $request) :string
   {
       return new View('site.seats', ['title' => 'Количество посадочных мест']);
   }

   public function square_filter(Request $request) :string
   {
       return new View('site.sqaure', ['title' => 'Площадь помещений']);
   }

   public function rooms_filter(Request $request) :string
   {
       return new View('site.rooms', ['title' => 'Помещения']);
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