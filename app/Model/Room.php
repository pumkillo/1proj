<?php

namespace Model;

use Model\BaseModel;

class Room extends BaseModel
{

   public $timestamps = false;
   protected $fillable = [
       'name',
       'amount_of_seats',
       'id_type_of_room',
       'id_division',
   ];

   protected static function booted()
   {
       static::created(function ($room) {
           $room->save();
       });
   }

   //Возврат аутентифицированного пользователя
   public function attemptIdentity(array $credentials)
   {
       return self::where(['name' => $credentials['name']])->first();
   }
}
