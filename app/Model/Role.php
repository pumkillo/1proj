<?php

namespace Model;

use Model\BaseModel;

class Role extends BaseModel
{

   public $timestamps = false;
   protected $fillable = [
       'name',
   ];

   protected static function booted()
   {
       static::created(function ($role) {
           $role->save();
       });
   }

   //Возврат аутентифицированного пользователя
   public function attemptIdentity(array $credentials)
   {
       return self::where(['name' => $credentials['name']])->first();
   }
}
