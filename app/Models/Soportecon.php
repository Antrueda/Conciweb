<?php

namespace App\Models;

use app\Models\Tramiteusuario as ModelsTramiteusuario;
use app\tramiteusuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soportecon extends Model
{
    use HasFactory;

    protected $table = 'conci_soportecons';
    protected $fillable = 
    ['NUM_SOLICITUD', 'nombreOriginalFile', 'rutaFinalFile','rutastorage',
     'descripcion','vigencia'];



    public function tramite(){
        return $this->belongsTo(ModelsTramiteusuario::class, 'NUM_SOLICITUD');
    }
}
