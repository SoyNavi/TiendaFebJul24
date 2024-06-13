<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Factura;
use App\Models\Clientes;
use App\Models\FormasPago;
use App\Models\EstadosFacturas;

class Facturas extends Model
{
    protected $table = 'facturas';
    protected $fillable = ['numero', 'detalles', 'valor', 'archivo', 'idcliente', 'idforma', 'idestado'];
    //use HasFactory;

    public function cliente()
{
    return $this->belongsTo(Clientes::class, 'idcliente');
}

public function formapago()
{
    return $this->belongsTo(FormasPago::class, 'idforma');
}

public function estado()
{
    return $this->belongsTo(EstadosFacturas::class, 'idestado');
}
    

    // Funcion para buscar clientes por el número
    public function scopeBuscadorNumero($query, $numero)
    {
        return $query->where('numero', 'LIKE', '%' . $numero . '%');
    }
}

