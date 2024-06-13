<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil; // Importa el modelo Perfil desde el namespace correcto
use Illuminate\View\View;

class PerfilesController extends Controller
{
    public function __construct(){
        /*bloquea por completo la ruta*/
        $this->middleware('auth');

        /*middleware, se ingresa en la ruta de perfiles sin loguearse y al intentar crear un nuevo perfil manda al login*/
        //$this->middleware('auth', ['except'=>'index']); 
    }
    public function index(Request $request)
    {
        // Verifica si la dirección de ordenamiento es válida
        $orderBy = in_array($request->id, ['asc', 'desc']) ? $request->id : 'asc';

        // Realiza la consulta de acuerdo a los parámetros recibidos
        $perfiles = Perfil::Buscador($request->nombre)->orderBy('id', $orderBy)->simplePaginate(3);

        return view('perfiles.index', compact('perfiles'));
    }

    public function create()
    {
        return view('perfiles.crear');
    }

    //Recibir los datos y guardarlos en la tabla perfiles
    public function store(Request $request)
    {
        //Validar la información
        $this->validate($request, [
            'nombre' => 'sometimes|required|unique:perfiles'
        ]);

        //Guardar esa informaciónen la tabla
        $perfil = Perfil::create([
            'nombre' => $request->get('nombre')
        ]);

        $mensaje = $perfil?'Perfil creada con exito':'La factura no pudo crearse';

        return redirect()->route('perfiles.index')->with('mensaje', $mensaje);
    }

    public function edit($id)
    {
        $perfil = Perfil::find($id);
        return view('perfiles.editar', compact('perfil'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'sometimes|required|unique:perfiles,nombre,' . $id
        ]);

        $perfil = Perfil::find($id);
        $perfil->nombre = $request->get("nombre");
        $perfil->save();

        return redirect()->route('perfiles.index');
    }



    public function destroy($id)
    {
        $perfil = Perfil::find($id);
        if ($perfil) {
            $perfil->delete();
            return redirect()->route('perfiles.index')->with('success', 'Perfil eliminado correctamente');
        } else {
            return redirect()->route('perfiles.index')->with('error', 'No se encontró el perfil');
        }
    }

}
