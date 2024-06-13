<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $fillable = ['nombre','rfc','direccion','telefono','email'];
    //use HasFactory;

    //Funcion para buscar clientes por el nombre

    public function scopeBuscador($query,$nombre){
        return$query->where('nombre','LIKE','%'.$nombre.'%');
    }
}
