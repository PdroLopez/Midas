<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Consulta as consulta;
use Auth;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name','apellido', 'email','fecha_nacimiento', 'password','roles_id','rut','dv','telefono','foto','validar','validar_email','validar_telefono','id_socialite','nom_socialite','bk_comunidades_id','nom_user_ig','cod_telefono'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Role','roles_id');
    }

    public function direccion()
    {
        return $this->hasMany('App\DireccionUsuario','users_id');
    }

    public function empresa_user()
    {
        return $this->hasMany('App\EmpresaUsuario','users_id');
    }
}
