<?php

namespace Model;

use Model\BaseModel;

class Division extends BaseModel
{

   public $timestamps = false;
   protected $fillable = [
       'name',
       'id_type_of_divisions',
   ];

   protected static function booted()
   {
       static::created(function ($division) {
           $division->save();
       });
   }

   //Возврат аутентифицированного пользователя
   public function attemptIdentity(array $credentials)
   {
       return self::where(['name' => $credentials['name']])->first();
   }
}
