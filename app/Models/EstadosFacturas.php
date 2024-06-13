<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosFacturas extends Model
{
    protected $table = 'estadosfacturas';
    protected $fillable = ['id','nombre'];
    public $timestamps = false;
    //use HasFactory;
}
