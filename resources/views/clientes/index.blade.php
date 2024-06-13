@extends('master')

@section('titulo', 'Listado de perfiles')
    @section('contenido')
        <div class="container text-center">
            <h2 style="color: #fff;">Listado de Clientes</h2>

            <!-- Button insert cliente modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createClienteModal" style="
                background-color: transparent;
                width: 30%;
                color: #FCEE00; 
                font-weight: bold;
                border-radius: 0px;
                border: 4px solid #FCEE00;"
                onmouseover="this.style.color='#fff'; this.style.borderColor='#fff';"
                onmouseout="this.style.color='#FCEE00'; this.style.borderColor='#FCEE00';">
                Crear Nuevo Cliente
            </button>

            <div class="container text-center">
                <!-- Formulario de Búsqueda -->
                {!! Form::open(['route'=>'clientes.index', 'method'=>'GET', 'class'=>'navbar-form']) !!}
                <div class="input-group mb-3">
                    {!! Form::text('nombre', null, ['class'=>'input-stand2', 'type'=>'search', 'id'=>'nombre', 'placeholder'=>'Buscar Cliente']) !!}
                    <button type="submit" class="btn btn-secondarys" style="
                        background-color: transparent;
                        width: 100%;
                        margin-top: -50px;
                        margin-left: 80%;
                        color: #FCEE00; 
                        font-weight: bold;
                        border-radius: 0px;
                        border: 4px solid #FCEE00;"
                        onmouseover="this.style.color='#fff'; this.style.borderColor='#fff';"
                        onmouseout="this.style.color='#FCEE00'; this.style.borderColor='#FCEE00';">Buscar Cliente</button>
                </div>
                {!! Form::close() !!}
            </div>

            <table class="table table-striped" style="border-radius: 0px;
                            border: 4px solid #FCEE00;">
                <thead>
                    <tr>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Actualizar</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Eliminar</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Nombre</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">RFC</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Direccion</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Telefono</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Email</th>
                    </tr>
                </thead>
                @foreach($clientes as $cliente)
                    <tr>
                        <td style="background-color: #07080D;">
                            <!--Boton update cliente Modal-->
                            <button type="button" class="btn-mdf" data-toggle="modal" data-target="#updateClienteModal{{$cliente->id}}">
                                <i class="bi bi-pencil-square edit-btn"></i>
                            </button>
                        </td>
                        <td style="background-color: #07080D;">
                            {!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' => 'DELETE' ])!!}
                            <!--Boton delete cliente Modal-->
                            <button type="button" class="btn-elm" data-toggle="modal" data-target="#deleteClienteModal{{$cliente->id}}">
                                <i class="bi bi-trash"></i>
                            </button>
                            {!! Form::close() !!}
                        </td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $cliente->nombre }}</td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $cliente->rfc }}</td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $cliente->direccion }}</td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $cliente->telefono }}</td>
                        <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $cliente->email }}</td>
                    </tr>
                    <!-- Modal update clientes -->
                    <div class="modal fade" id="updateClienteModal{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="updateClienteModalLabel{{$cliente->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateClienteModalLabel{{$cliente->id}}">Actualizar Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::model($cliente, ['route' => ['clientes.update', $cliente->id], 'method' => 'PUT']) !!}
                                        <div class="form-group">
                                            {!! Form::text('nombre', null, array(
                                            'class'=>'form-control',
                                            'required'=>'required',
                                            'placeholder'=>'Nombre del cliente...'
                                            )) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::text('rfc', null, array(
                                            'class'=>'form-control',
                                            'required'=>'required',
                                            'placeholder'=>'RFC...'
                                            )) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::text('direccion', null, array(
                                            'class'=>'form-control',
                                            'required'=>'required',
                                            'placeholder'=>'Direcccion...'
                                            )) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::number('telefono', null, array(
                                            'class'=>'form-control',
                                            'required'=>'required',
                                            'placeholder'=>'Telefono...'
                                            )) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::email('email', null, array(
                                            'class'=>'form-control',
                                            'required'=>'required',
                                            'placeholder'=>'Email...'
                                            )) !!}
                                        </div>
                                    {!! Form::submit('Actualizar Cliente', array('class'=>'btn btn-success')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </table>
            {{ $clientes->links()}}
            <hr>
        </div>

        <!-- Modal Create Cliente -->
        <div class="modal fade" id="createClienteModal" tabindex="-1" role="dialog" aria-labelledby="createClienteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createClienteModalLabel">Crear Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route' => 'clientes.store']) !!}
                        <div class="form-group">
                            {!! Form::text('nombre', null, [
                                    'class'=>'form-control',
                                    'required'=>'required',
                                    'placeholder'=>'Nombre del cliente...'
                                ]) 
                            !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('rfc', null, [
                                    'class'=>'form-control',
                                    'required'=>'required',
                                    'placeholder'=>'RFC...'
                                ]) 
                            !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('direccion', null, [
                                    'class'=>'form-control',
                                    'required'=>'required',
                                    'placeholder'=>'Direcccion...'
                                ])
                            !!}
                        </div>
                        <div class="form-group">
                            {!! Form::number('telefono', null, [
                                    'class'=>'form-control',
                                    'required'=>'required',
                                    'placeholder'=>'Telefono...'
                                ]) 
                            !!}
                        </div>
                        <div class="form-group">
                            {!! Form::email('email', null, [
                                    'class'=>'form-control',
                                    'required'=>'required',
                                    'placeholder'=>'Email...'
                                ]) 
                            !!}
                        </div>
                        {!! Form::submit('Guardar Cliente', array('class'=>'btn btn-success'))!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para eliminar un cliente -->
        @foreach($clientes as $cliente)
            <div class="modal fade" id="deleteClienteModal{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteClienteModalLabel{{$cliente->id}}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteClienteModalLabel{{$cliente->id}}">Eliminar cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar el cliente "{{ $cliente->nombre }}"?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            {!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach      
@endsection
