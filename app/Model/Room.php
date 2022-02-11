<?php

namespace Model;

use Model\BaseModel;

class Room extends BaseModel
{

    public $timestamps = false;
    protected $fillable = [
        'name',
        'square',
        'amount_of_seats',
        'type_of_room_id',
        'division_id',
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
