@extends('master')
@section('titulo', 'Listado de facturas')
    @section('contenido')
        <div class="container text-center">

            <h2 style="color: #fff;">Listado de Facturas</h2>
            <!-- Button Crear factura modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFacturaModal" style="
            background-color: transparent;
            width: 30%;
            color: #FCEE00; 
            font-weight: bold;
            border-radius: 0px;
            border: 4px solid #FCEE00;"
            onmouseover="this.style.color='#fff'; this.style.borderColor='#fff';"
            onmouseout="this.style.color='#FCEE00'; this.style.borderColor='#FCEE00';">
                Crear Nueva Factura
            </button>

            <div class="container text-center">
                <!--Formulario de Búsqueda-->
                {!! Form::open(['route'=>'facturas.index', 'method'=>'GET', 'class'=>'navbar-form']) !!}
                <div class="input-group mb-3">
                    {!! Form::text('numero', null, ['class'=>'input-stand2', 'id'=>'numero', 'placeholder'=>'Buscar Factura']) !!}
                    <button type="submit" class="btn btn-primary" style="
                        background-color: transparent;
                        width: 100%;
                        margin-top: -50px;
                        margin-left: 80%;
                        color: #FCEE00; 
                        font-weight: bold;
                        border-radius: 0px;
                        border: 4px solid #FCEE00;"
                        onmouseover="this.style.color='#fff'; this.style.borderColor='#fff';"
                        onmouseout="this.style.color='#FCEE00'; this.style.borderColor='#FCEE00';">Buscar</button>
                </div>
                {!! Form::close() !!}
            </div>

            <table class="table table-striped" style="border-radius: 0px;
                            border: 4px solid #FCEE00;">
                <thead>
                    <tr>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Actualizar</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Eliminar</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Numero</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Detalles</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Valor</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Archivo</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Cliente</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Forma Pago</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Estado Factura</th>
                    </tr>
                </thead>
                @foreach($facturas as $factura)
                    <tr>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">
                            <!--Boton Actualizar factura -->
                            <button type="button" class="btn-mdf" data-toggle="modal" data-target="#updateFacturaModal{{$factura->id}}">
                                <i class="bi bi-pencil-square edit-btn"></i>
                            </button>
                        </td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">
                            {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'DELETE']) !!}
                                <!-- Boton eliminar factura -->
                                <button type="button" class="btn-elm" data-toggle="modal" data-target="#deleteFacturaModal{{$factura->id}}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $factura->numero }}</td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{!! html_entity_decode($factura->detalles) !!}</td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">${{number_format($factura->valor)}}</td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;"><img src="{{asset('archivos/'.$factura->archivo.'')}}" width="150"></td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $factura->cliente->nombre }}</td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $factura->formapago->nombre }}</td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $factura->estado->nombre }}</td>
                    </tr>
                    <!-- Modal Update -->
                    <div class="modal fade" id="updateFacturaModal{{$factura->id}}" tabindex="-1" role="dialog" aria-labelledby="updateFacturaModalLabel{{$factura->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateFacturaModalLabel{{$factura->id}}">Actualizar Factura</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::model($factura, ['route' => ['facturas.update', $factura->id], 'method' => 'PUT', 'files' => true]) !!}
                                        <div class="form-group">
                                            {!! Form::number('numero', null, array(
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Numero de factura...'
                                                )) 
                                            !!}
                                        </div>
                                        <div class="form-group">
                                            <label>Detalles</label>
                                            {!! Form::textarea('detalles', null, array(
                                                    'class'=>'form-control ckeditor',
                                                    'placeholder'=>'Detalles de la factura...'
                                                )) 
                                            !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::number('valor', null, array(
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Valor de la factura...'
                                                )) 
                                            !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::file('archivo') !!}
                                        </div>
                                        <div class="form-group">
                                            <label>Clientes</label>
                                            {!! Form::select('idcliente', $clientes, null, array('class' => 'form-control')) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>Formas de Pago</label>
                                            {!! Form::select('idforma', $formaspago, null, array('class' => 'form-control')) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>Estados Factura</label>
                                            {!! Form::select('idestado', $estadosfacturas, null, array('class' => 'form-control')) !!}
                                        </div>
                                    {!! Form::submit('Actualizar Factura', array('class'=>'btn btn-success')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </table>
            {{ $facturas->links()}}
            <hr>
        </div>
        
        <!-- Modal Insert-->
        <!-- Modal Create Factura -->
        <div class="modal fade" id="createFacturaModal" tabindex="-1" role="dialog" aria-labelledby="createFacturaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createFacturaModalLabel">Crear Factura</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route' => 'facturas.store','method' => 'POST', 'files' => true]) !!}
                            <div class="form-group">
                                {!! Form::number('numero', null, [
                                        'class'=>'form-control',
                                        'required'=>'required',
                                        'placeholder'=>'Numero de la factura...'
                                    ])
                                !!}
                            </div>
                            <div class="form-group">
                                {!! Form::textarea('detalles', null, [
                                        'class'=>'form-control ckeditor',
                                        'placeholder'=>'Detalles de la factura...'
                                    ])
                                !!}
                            </div>
                            <div class="form-group">
                                {!! Form::number('valor', null, [
                                        'class'=>'form-control',
                                        'required'=>'required',
                                        'placeholder'=>'Valor de la factura...'
                                    ])
                                !!}
                            </div>
                            <div class="form-group">
                                {!! Form::file('archivo') !!}
                            </div>
                            <div class="form-group">
                                <label>Clientes</label>
                                {!! Form::select('idcliente', $clientes, null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Forma de Pago</label>
                                {!! Form::select('idforma', $formaspago, null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Estados</label>
                                {!! Form::select('idestado', $estadosfacturas, null, ['class' => 'form-control']) !!}
                            </div>
                        {!! Form::submit('Guardar Perfil', array('class'=>'btn btn-success'))!!}
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal delete -->
        @foreach($facturas as $factura)
            <div class="modal fade" id="deleteFacturaModal{{$factura->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteFacturaModalLabel{{$factura->id}}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteFacturaModalLabel{{$factura->id}}">Eliminar Factura</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Deseas eliminar la factura "{{ $factura->numero }}"?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
         @endforeach   
@endsection

