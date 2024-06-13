@extends('master')
@section('titulo', 'Listado de Productos')
@section('contenido')
<div class="container text-center">
    <h2 style="color: #fff;">Listado de Productos</h2>
    <table class="table" style="margin-top: -300px;">
        <div class="container">
            <table class="table table-striped" style="border-radius: 0px;
                            border: 4px solid #FCEE00;">
                <thead>
                    <tr>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Nombre</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Precio</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Cantidad</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí deberías agregar tus filas de datos si tienes alguna -->
                    @foreach($productos as $producto)
                        <tr>
                            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{$producto->nombre}}</td>
                            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{$producto->precio}}</td>
                            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{$producto->cantidad}}</td>
                            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">
                                <a href="{{ route('carrito-agregar',$producto->id) }}" style="color: #FFF; border-radius: 0px; border: 4px solid #FFF; padding-inline-end: 10px; padding-left: 10px;">
                                    <i class="bi bi-cart-plus-fill"></i>           
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>
        @endsection
    </table>
</div>