<?php

namespace Model;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Model\BaseModel;

class User extends BaseModel
{

   public $timestamps = false;
   protected $fillable = [
       'name',
       'login',
       'password',
       'name',
       'surname',
       'patronymic',
       'birthdate',
       'role_id',
   ];

   protected static function booted()
   {
       static::created(function ($user) {
           $user->password = md5($user->password);
           $user->save();
       });
   }

   //Возврат аутентифицированного пользователя
   public function attemptIdentity(array $credentials)
   {
       return self::where(['login' => $credentials['login'],
           'password' => md5($credentials['password'])])->first();
   }
}
