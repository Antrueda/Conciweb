<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convocante extends Model
{
    use HasFactory;

    protected $table = 'conci_convocantes';


    protected $fillable = 
    ['nomConvocante', 'apeConvocante', 'emailConvocante', 'NUM_SOLICITUD'];



    public function tramite(){
        return $this->belongsTo(ModelsTramiteusuario::class, 'NUM_SOLICITUD');
    }
}
