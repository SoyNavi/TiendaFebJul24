<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Productos;
use App\Models\Pedidos;

class CarritoController extends Controller
{
    public function __construct()
    {
        if (!Session::has('carrito'))
            Session::put('carrito', array());
    }

    public function show()
    {
        $carrito = Session::get('carrito');
        $total = $this->total();

        return view('carrito', compact('carrito', 'total'));
    }

    public function add($id)
    {
        $carrito = Session::get('carrito', []);
        $productos = Productos::find($id);

        if ($productos) {
            $carrito[$productos->id] = $productos;
            Session::put('carrito', $carrito);
        } else {
            return redirect()->route('carrito.index')->with('error', 'Producto no encontrado');
        }

        return redirect()->route('carrito.index');
    }

    public function delete($id){
        $carrito = Session::get('carrito', []);
        unset($carrito[$id]);
        Session::put('carrito', $carrito);

        return redirect()->route('carrito.index');
    }

    public function trash(){
        Session::forget('carrito');
        return redirect()->route('carrito.index');
    }

    public function update($id, $cantidad){
        $carrito = Session::get('carrito');
        $productos = Productos::find($id);
        $carrito[$productos->id]->cantidad = $cantidad;

        Session::put('carrito', $carrito);
        return redirect()->route('carrito.index');
    }

    public function total(){
        $carrito = Session::get('carrito');

        $total = 0;

        foreach($carrito as $item){
            $total += $item->precio * $item->cantidad;
        }

        return $total;
    }

    public function guardarPedido()
    {
        $carrito = Session::get('carrito');
        if (count($carrito)) {
            $now = new \DateTime();
            $numero = $now->format('Ymd-His');
            foreach ($carrito as $producto) {
                $this->guardarItem($producto, $numero);
            }
            // Vaciar el carrito después de guardar el pedido
            Session::forget('carrito');
            $mensaje = 'Pedido realizado con éxito';
        }

        return redirect()->route('carrito.index')->with('mensaje', $mensaje);
    }

    protected function guardarItem($producto, $numero){
        // Guardar el pedido
        Pedidos::create([
            'numero' => $numero,
            'idproducto' => $producto->id,
            'cantidad' => $producto->cantidad,
            'precio' => $producto->precio
        ]);

        // Restar la cantidad del producto en el inventario
        $productoDB = Productos::find($producto->id);
        if ($productoDB) {
            $productoDB->cantidad -= $producto->cantidad;
            $productoDB->save();
        }
    }
}
