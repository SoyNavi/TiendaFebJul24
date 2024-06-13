@extends('master')
@section('titulo', 'Bienvenidos Febrero-Julio 24')

@section('contenido')

@include('secciones.banner')
<div class="container text-center">
    <div class="row" style="background: #07080D;">
        <div class="col">
        <img src="images/borderlands_1.jpg" width="350" height="350">
        <br><br>
        <h3 style="color: #FFF; font-family: Hind Siliguri, sans-serif; font-weight: 700;">Borderlands</h3>
        <br>
        <button class="btn-suscribir" onclick="window.location.href='https://borderlands.2k.com/es-MX/borderlands/'" type="submit">Saber Mas</button>
        </div>
        <div class="col">
        <img src="images/borderlands_2.jpg" width="350" height="350">
        <br><br>
        <h3 style="color: #FFF; font-family: Hind Siliguri, sans-serif; font-weight: 700;">Borderlands 2</h3>
        <br>
        <button class="btn-suscribir" onclick="window.location.href='https://borderlands.2k.com/es-MX/borderlands-2/'" type="submit">Saber Mas</button>
        </div>
        <div class="col">
        <img src="images/borderlands_3.jpg" width="350" height="350">
        <br><br>
        <h3 style="color: #FFF; font-family: Hind Siliguri, sans-serif; font-weight: 700;">Borderlands 3</h3>
        <br>
        <button class="btn-suscribir" onclick="window.location.href='https://borderlands.2k.com/es-MX/borderlands-3/'" type="submit">Saber Mas</button>
        </div>
    </div>
</div>
@endsection