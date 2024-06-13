<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Mail\RegistroBienvenida;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'idperfil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        // Send welcome email after user is created
        static::created(function ($user) {
            $perfil = Perfil::find($user->idperfil); // Obteniendo el perfil del usuario
            $nombreUsuario = $user->name;
            $nombrePerfil = $perfil ? $perfil->nombre : ''; // Si el perfil existe, obtenemos el nombre del perfil

            Mail::to($user->email)->send(new RegistroBienvenida($nombrePerfil, $nombreUsuario));
        });
    }
}
