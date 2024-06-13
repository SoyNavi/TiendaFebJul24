@extends('master')
@section('titulo','Restablecer')
@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius: 0px;">
                <div class="card-header" style="color: #fff; border-radius: 0px; background-color: #07080D;">{{ __('Restablecer Contraseña') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="token" value="{{ $token ?? '' }}">

                        <div class="row">
                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Añadir Email" class="input-stand3" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Contraseña" class="input-stand3" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="Confirmar Contraseña" class="input-stand3" name="password" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <button type="submit" class="btn-mdf" style="width: 30%; margin-left: 30px; margin-top: 20px;">
                                    {{ __('Restablecer Contraseña') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
