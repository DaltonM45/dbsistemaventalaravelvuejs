<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = [
        'idcategoria','codigo','nombre','precio_venta','stock' ,'descripcion','condicion'
    ];
    //metodo necesario para relacionar la tabla de categoria con articulo
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
