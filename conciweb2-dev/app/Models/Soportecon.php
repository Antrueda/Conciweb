<?php

namespace App\Models;

use App\Models\Tramiteusuario as ModelsTramiteusuario;
use App\tramiteusuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soportecon extends Model
{
    use HasFactory;

    protected $table = 'conci_soportecons';
    protected $fillable = 
    ['NUM_SOLICITUD', 'nombreOriginalFile', 'descripcion', 'descripcion'];



    public function tramite(){
        return $this->belongsTo(ModelsTramiteusuario::class, 'NUM_SOLICITUD');
    }
}
