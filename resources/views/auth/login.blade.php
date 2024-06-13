@extends('master')
@section('titulo','Login')
@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color: #fff; border-radius: 0px; background-color: #07080D;">{{ __('Iniciar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Añadir Email" class="input-stand3" name="email" value="{{ old('email') }}" required autocomplete="new-email">

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
                                <div class="form-check" style="margin-top: 20px;">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" style="border-radius: 0px; 
                                    border: 2px solid #FCEE00; background-color: #000; margin-left: 10px;" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember" style="color: #fff; border-radius: 0px; background-color: transparent; margin-left: 30px;">
                                        {{ __('Recordar') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <button type="submit" class="btn-mdf" style="width: 30%; margin-left: 30px; margin-top: 20px;">
                                    {{ __('Iniciar') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="font-family: 'Hind Siliguri', sans-serif; font-weight: 700; color: #FCEE00; border-radius: 0px; background-color: transparent; margin-left: 30px; margin-top: 20px;">
                                        {{ __('Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
