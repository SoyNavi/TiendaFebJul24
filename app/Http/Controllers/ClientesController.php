<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clientes;

class ClientesController extends Controller
{
    public function __construct(){
        /*bloquea por completo la ruta*/
        $this->middleware('auth');

        /*middleware, se ingresa en la ruta de clientes sin loguearse y al intentar crear un nuevo cliente manda al login*/
        //$this->middleware('auth', ['except'=>'index']);
    }

    public function index(Request $request)
    {

        $orderBy = in_array($request->id, ['asc', 'desc']) ? $request->id : 'asc';

        $clientes = Clientes::Buscador($request->nombre)->orderBy('id', $orderBy)->simplePaginate(5);

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.crear');
    }

    public function store(Request $request)
    {
        //Validar la información
        $this->validate($request, [
            'nombre' => 'sometimes|required|unique:clientes',
            'rfc' => 'sometimes|required|unique:clientes',
            'direccion' => 'sometimes|required:clientes',
            'telefono' => 'sometimes|required|numeric|unique:clientes',
            'email' => 'sometimes|required|email|unique:clientes'
        ]);

        //Guardar esa información en la tabla
        $cliente = Clientes::create([
            'nombre' => $request->get('nombre'),
            'rfc' => $request->get('rfc'),
            'direccion' => $request->get('direccion'),
            'telefono' => $request->get('telefono'),
            'email' => $request->get('email')
        ]);

        $mensaje = $cliente?'Factura creada con exito':'La factura no pudo crearse';

        return redirect()->route('clientes.index')->with('mensaje', $mensaje);
    }

    public function edit($id)
    {
        $cliente = Clientes::find($id);
        return view('clientes.editar', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|unique:clientes,nombre,' . $id,
            'rfc' => 'required|unique:clientes,rfc,' . $id,
            'direccion' => 'required|unique:clientes,direccion,' . $id,
            'telefono' => 'required|unique:clientes,telefono,' . $id,
            'email' => 'required|unique:clientes,email,' . $id
        ]);

        $cliente = Clientes::find($id);
        $cliente->nombre = $request->get('nombre');
        $cliente->rfc = $request->get('rfc');
        $cliente->direccion = $request->get('direccion');
        $cliente->telefono = $request->get('telefono');
        $cliente->email = $request->get('email');
        $cliente->save();

        return redirect()->route('clientes.index');
    }



    public function destroy($id)
    {
        $cliente = Clientes::find($id);
        if ($cliente) {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
        } else {
            return redirect()->route('clientes.index')->with('error', 'No se encontró el cliente');
        }
    }

}
