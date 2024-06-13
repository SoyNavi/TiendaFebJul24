<?php

namespace App\Http\Controllers;

use App\Mail\FacturaCreada;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Facturas;
use App\Models\Clientes;
use App\Models\FormasPago;
use App\Models\EstadosFacturas;

class FacturasController extends Controller
{
    public function __construct(){
        /*bloquea por completo la ruta*/
        $this->middleware('auth');

        /*middleware, se ingresa en la ruta de facturas sin loguearse y al intentar crear una nueva factura manda al login*/
        //$this->middleware('auth', ['except'=>'index']);
    }

    public function index(Request $request)
    {
        //Para enviar el email
        //$noFactura = 101010;
        //a quien se le enviara el correo
        //Mail::to('sarahazuara22@gmail.com')->send(new FacturaCreada);

        // Verifica si la dirección de ordenamiento es válida
        $orderBy = in_array($request->id, ['asc', 'desc']) ? $request->id : 'asc';

        // Realiza la consulta de acuerdo a los parámetros recibidos
        $facturas = Facturas::BuscadorNumero($request->numero)->orderBy('numero', $orderBy)->simplePaginate(5);

        $facturas->load('cliente', 'formapago', 'estado');
        
        // Obtener valores para los select
        $clientes = Clientes::pluck('nombre', 'id');
        $formaspago = FormasPago::pluck('nombre', 'id');
        $estadosfacturas = EstadosFacturas::pluck('nombre', 'id');

        return view('facturas.index', compact('facturas', 'clientes', 'formaspago', 'estadosfacturas'));
        
    }

    public function create()
    {
        $clientes = Clientes::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formaspago = FormasPago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estadosfacturas = EstadosFacturas::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('facturas.crear', compact('clientes', 'formaspago', 'estadosfacturas'));
    }


    public function store(Request $request)
    {
        //Validar la información
        $this->validate($request, [
            'numero' => 'required|unique:facturas',
            'detalles' => 'required',
            'valor' => 'required|numeric',
            'archivo' => 'required|file|mimes:pdf,jpeg,png,jweb',
            'idcliente' => 'required|exists:clientes,id',
            'idforma' => 'required|exists:formaspago,id',
            'idestado' => 'required|exists:estadosfacturas,id',
        ]);

        $now = new \DateTime();
        $fecha = $now->format('Ymd-His');
        $numero = $request->get('numero');
        $archivo = $request->file('archivo');
        $nombre = "";

        if ($archivo) {
            $extension = $archivo->getClientOriginalExtension();
            $nombre = "factura-" . $numero . "-" . $fecha . "." . $extension;
            \Storage::disk('local')->put($nombre, \File::get($archivo));
        }

        //Guardar esa información en la tabla
        $facturas = Facturas::create([
            'numero' => $request->get('numero'),
            'detalles' => $request->get('detalles'),
            'valor' => $request->get('valor'),
            'archivo' => $nombre,
            'idcliente' => $request->get('idcliente'),
            'idforma' => $request->get('idforma'),
            'idestado' => $request->get('idestado')
        ]);

        //Generar Mail de notificación
        $numerofactura = $request->get('numero');
        $valorfactura = $request->get('valor');

        //Obtener el email del usuario que se encuentra logueado
        $emailto = Auth::user()->email;
        Mail::to($emailto)->send(new FacturaCreada($numerofactura, $valorfactura));
       // Mail::to($facturas->user())->send(new FacturaCreada($numerofactura, $valorfactura));

        $mensaje = $facturas?'Factura creada con exito':'La factura no pudo crearse';

        return redirect()->route('facturas.index')->with('mensaje', $mensaje);
    }

    public function edit($id)
    {
        $facturas = Facturas::find($id);
        $clientes = Clientes::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formaspago = FormasPago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estadosfacturas = EstadosFacturas::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('facturas.editar', compact('facturas', 'clientes', 'formaspago', 'estadosfacturas'));
    }

    public function update(Request $request, $id)
{
    $this->validate($request, [
        'numero' => 'required',
        'detalles' => 'required',
        'valor' => 'required|numeric',
        'archivo' => 'file|mimes:pdf,jpeg,png,jweb',
        'idcliente' => 'required|exists:clientes,id',
        'idforma' => 'required|exists:formaspago,id',
        'idestado' => 'required|exists:estadosfacturas,id',
    ]);

    $factura = Facturas::findOrFail($id);
    $factura->numero = $request->numero;
    $factura->detalles = $request->detalles;
    $factura->valor = $request->valor;
    
    if ($request->hasFile('archivo')) {
        $archivo = $request->file('archivo');
        $nombreArchivo = $archivo->getClientOriginalName(); // Opcional: Cambiar a un nombre único si es necesario
        $archivo->storeAs('archivos', $nombreArchivo, 'public'); // Almacenar el archivo en 'storage/app/public/archivos'
        $factura->archivo = $nombreArchivo;
    }

    $factura->idcliente = $request->idcliente;
    $factura->idforma = $request->idforma;
    $factura->idestado = $request->idestado;

    $factura->save();

    return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente');
}



    public function destroy($id)
    {
        $facturas = Facturas::find($id);
        $archivo = $facturas->archivo;
        \Storage::delete($archivo);
        $facturas->delete();
        if ($facturas) {
            $facturas->delete();
            return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente');
        } else {
            return redirect()->route('facturas.index')->with('error', 'No se encontró la factura');
        }
    }

}
