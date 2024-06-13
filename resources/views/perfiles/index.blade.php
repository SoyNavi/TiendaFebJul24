@extends('master')

@section('titulo', 'Listado de perfiles')
@section('contenido')
<div class="container text-center">

    <h2 style="color: #fff;">Listado de Perfiles</h2>
    <!-- Button Crear perfil modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createPerfilModal" style="
            background-color: transparent;
            width: 30%;
            color: #FCEE00; 
            font-weight: bold;
            border-radius: 0px;
            border: 4px solid #FCEE00;"
            onmouseover="this.style.color='#fff'; this.style.borderColor='#fff';"
            onmouseout="this.style.color='#FCEE00'; this.style.borderColor='#FCEE00';">
        Crear Nuevo Perfil
    </button>

    <div class="container text-center">
        <!--Formulario de Búsqueda-->
        {!! Form::open(['route'=>'perfiles.index', 'method'=>'GET', 'class'=>'navbar-form']) !!}
        <div class="input-group mb-3">
            {!! Form::text('nombre', null, ['class'=>'input-stand2', 'id'=>'nombre', 'placeholder'=>'Buscar Cliente']) !!}
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
                <th scope="col" style="color: #FCEE00; background-color: transparent;">Id</th>
                <th scope="col" style="color: #FCEE00; background-color: transparent;">Nombre</th>
            </tr>
        </thead>
        @foreach($perfiles as $perfil)
        <tr>
            <td style="background-color: #07080D;">
                <!--Boton Actualizar perfil -->
                <button type="button" class="btn-mdf" data-bs-toggle="modal" data-bs-target="#updatePerfilModal{{$perfil->id}}">
                    <i class="bi bi-pencil-square edit-btn"></i>
                </button>
            </td>
            <td style="background-color: #07080D;">
                {!! Form::open(['route' => ['perfiles.destroy', $perfil->id], 'method' => 'DELETE']) !!}
                <!-- Boton eliminar perfil -->
                <button type="button" class="btn-elm" data-bs-toggle="modal" data-bs-target="#deletePerfilModal{{$perfil->id}}">
                    <i class="bi bi-trash"></i>
                </button>
                {!! Form::close() !!}
            </td>
            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $perfil->id }}</td>
            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $perfil->nombre }}</td>
        </tr>
        <!-- Modal Update -->
        <div class="modal fade" id="updatePerfilModal{{$perfil->id}}" tabindex="-1" role="dialog" aria-labelledby="updatePerfilModalLabel{{$perfil->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatePerfilModalLabel{{$perfil->id}}">Actualizar Perfil</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::model($perfil, ['route' => ['perfiles.update', $perfil->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {!! Form::text('nombre', $perfil->nombre, array(
                                    'class'=>'form-control',
                                    'required'=>'required',
                                    'placeholder'=>'Nombre del perfil...'
                                )) 
                            !!}
                        </div>
                        {!! Form::submit('Actualizar Perfil', array('class'=>'btn btn-success')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </table>
    {{ $perfiles->links()}}
</div>
<!-- Modal Insert-->

<!-- Modal Create Perfil -->
<div class="modal fade" id="createPerfilModal" tabindex="-1" role="dialog" aria-labelledby="createPerfilModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPerfilModalLabel">Crear Perfil</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'perfiles.store']) !!}
                <div class="form-group">
                    {!! Form::text('nombre', null, array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Nombre del perfil...'
                        ))
                    !!}
                </div>
                {!! Form::submit('Guardar Perfil', array('class'=>'btn btn-success'))!!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- Modal delete -->
@foreach($perfiles as $perfil)
<div class="modal fade" id="deletePerfilModal{{$perfil->id}}" tabindex="-1" role="dialog" aria-labelledby="deletePerfilModalLabel{{$perfil->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePerfilModalLabel{{$perfil->id}}">Eliminar Perfil</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Deseas eliminar el perfil "{{ $perfil->nombre }}"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                {!! Form::open(['route' => ['perfiles.destroy', $perfil->id], 'method' => 'DELETE']) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
