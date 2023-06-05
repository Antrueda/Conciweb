<?php

namespace app\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use app\Dependencia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection = 'oracleexterna';
    protected $table = 'usuario_rol';
    protected $primaryKey = 'cedula';
    protected $keyType = 'string';
    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function dependencia(){
    
        return $this->belongsTo(Dependencia::class, 'depend_codigo')->select(['consecutivo', 'descripcion']); 
    }

 


    
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
