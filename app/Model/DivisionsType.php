<?php

namespace Model;

use Model\BaseModel;

class DivisionsType extends BaseModel
{

    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    protected static function booted()
    {
        static::created(function ($type_of_division) {
            $type_of_division->save();
        });
    }

    //Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where(['name' => $credentials['name']])->first();
    }
}
