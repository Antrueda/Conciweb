<?php

namespace App\Models;

use App\Models\Texto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadoform extends Model
{
    use HasFactory;

    protected $fillable = ['estado', 'sis_esta_id','texto_id','horainicio','horacierre','findesemana'];

    

    public function texto(){
        return $this->belongsTo(Texto::class, 'texto_id');
    }
}
