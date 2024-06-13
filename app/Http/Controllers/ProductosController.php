<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;

class ProductosController extends Controller
{
    public function __construct(){
        /*bloquea por completo la ruta*/
        $this->middleware('auth');

        /*middleware, se ingresa en la ruta de productos sin loguearse y al intentar crear un nuevo producto manda al login*/
        //$this->middleware('auth', ['except'=>'index']);
    }

    public function index(Request $request)
    {
        $productos = Productos::all();
        return view('productos.index', compact('productos'));
    }
}
