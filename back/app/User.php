<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'funcionario';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idfuncionario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'firma',
        'firma_temporal',
        'firma_original',
        'estado',
        'fecha_ingreso',
        'clave',
        'nit',
        'perfil',
        'debe_firmar',
        'tipo',
        'ultimo_pwd',
        'mensajeria',
        'email',
        'sistema',
        'email_contrasena',
        'direccion',
        'telefono',
        'fecha_fin_inactivo',
        'intento_login',
        'foto_original',
        'foto_recorte',
        'foto_cordenadas',
        'ventanilla_radicacion',
        'pertenece_nucleo',
        'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'clave'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ultimo_pwd' => 'datetime',
        'fecha_fin_inactivo' => 'datetime',
    ];
}
