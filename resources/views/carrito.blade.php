@extends('master')

@section('titulo', 'Carrito')
@section('contenido')
<div class="container text-center">
    <h2 style="color: #fff;">Carrito de Articulos</h2>
        <a href="{{ route('carrito-vaciar') }}" class="btn btn-danger" style="
                        background-color: transparent;
                        color: #FCEE00; 
                        font-weight: bold;
                        border-radius: 0px;
                        border: 4px solid #FCEE00;"
                        onmouseover="this.style.color='#fff'; this.style.borderColor='#fff';"
                        onmouseout="this.style.color='#FCEE00'; this.style.borderColor='#FCEE00';">Vaciar Carrito<i class="bi bi-trash"></i></a>
    <table class="table" style="margin-top: -300px;">
        <div class="container">
            <table class="table table-striped" style="border-radius: 0px;
                            border: 4px solid #FCEE00;">
                <thead>
                    <tr>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Nombre</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Precio</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Cantidad</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Total</th>
                        <th scope="col" style="color: #FCEE00; background-color: transparent;">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí deberías agregar tus filas de datos si tienes alguna -->
                    @foreach($carrito as $item)
                        <tr>
                            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{$item->nombre}}</td>
                            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{number_format($item->precio, 0)}}</td>
                            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">
                                <input type="number" class="input-stand" min="1" max="50" value="{{$item->cantidad}}" id="producto_{{ $item->id }}" style="width: 50%;
                                padding-top: 0; padding-bottom: 0;">
                                <a href="#" class="btn btn-warning btn-update-item"
                                    data-href="{{ route('carrito-actualizar', $item->id) }}" data-id="{{ $item->id }}" style="color: #FCEE00; border-radius: 0px; 
                                                                                          border: 4px solid #FCEE00; padding-inline-end: 5px; padding-left: 5px; background-color: transparent;">
                                    <i class="bi bi-arrow-repeat"></i>
                                </a>
                            </td>
                            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">{{ $item->precio * $item->cantidad }}</td>
                            <td style="color: #FFF; background-color: #07080D; font-weight: bold;">
                                <a href="{{ route('carrito-borrar', $item->id) }}" style="color: #fc0000; border-radius: 0px; 
                                                                                          border: 4px solid #fc0000; padding-inline-end: 5px; padding-left: 5px;">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if(count($carrito) > 0)
                <h5><span class="alert alert-success d-inline-block" style="background-color: transparent;
                                                                            color: #FFF; 
                                                                            font-weight: bold;
                                                                            border-radius: 0px;
                                                                            border: 4px solid #FFF;">Total: ${{ number_format($total, 0) }}</span></h5>
            @else
                <h5><span class="alert alert-warning d-inline-block" style="background-color: transparent;
                                                                            color: #fc0000; 
                                                                            font-weight: bold;
                                                                            border-radius: 0px;
                                                                            border: 4px solid #fc0000;">No hay productos en el carrito</span></h5>
            @endif

            <p><a class="btn btn-info" href="{{ route('productos.index') }}" style="
                        background-color: transparent;
                        color: #FCEE00; 
                        font-weight: bold;
                        border-radius: 0px;
                        border: 4px solid #FCEE00;"
                        onmouseover="this.style.color='#fff'; this.style.borderColor='#fff';"
                        onmouseout="this.style.color='#FCEE00'; this.style.borderColor='#FCEE00';">
                    <i class="fa fa-chevron-circle-left"></i> Seguir Agregando</a>
                @if(count($carrito))
                    <a class="btn btn-success" href="{{ route('ordenar') }}" style="
                        background-color: transparent;
                        color: #FFF; 
                        font-weight: bold;
                        border-radius: 0px;
                        border: 4px solid #FFF;"
                        onmouseover="this.style.color='#FCEE00'; this.style.borderColor='#FCEE00';"
                        onmouseout="this.style.color='#FFF'; this.style.borderColor='#FFF';"> Ordenar <i class="fa fa-chevron-circle-right"></i></a>
                @endif
            </p>
        </div>
        @endsection
    </table>
</div>