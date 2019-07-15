<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'nombre','tipo_documento', 'num_documento', 'direccion', 'telefono', 'email'
    ];

        //estableciendo relacion, una persona esta relacionada de manera directa con un solo proveedor. de uno a uno
    public function proveedor(){
        return $this->hasOne('App\Proveedor');
    }


    public function user(){
        return $this->hasOne('App\User');
    }
}
