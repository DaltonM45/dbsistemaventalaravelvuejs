<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores'; //esto es porque laravel asumen que la tabla sera provedors

    protected $fillable = [
        'id','contacto', 'telefono_contacto'
    ];

    public $timestamps = false; // esto es porque la tabla provvedores no tiene el atributo o campo timestamps


    //haciendo la relacion, un proveedor pertenece a una persona
    public function persona (){
        return $this->belongsTo('App\Persona');//retornando el model persona
    }


}
