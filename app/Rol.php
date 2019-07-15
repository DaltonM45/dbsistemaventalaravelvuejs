<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles'; //esto es porque laravel asumen que la tabla sera rol

    protected $fillable = [
        'nombre','descripcion', 'condicion'
    ];

    public $timestamps = false; // esto es porque la tabla provvedores no tiene el atributo o campo timestamps

    public function user(){
        return $this->hasMany('App\User');
    }

}
