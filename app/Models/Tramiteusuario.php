<?php

namespace App\Models;

use app\Models\Soportecon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramiteusuario extends Model
{
    use HasFactory;
    protected $table = 'conci_tramiteusuarios';
    protected $fillable = [
      'NUM_SOLICITUD',
      'ID_TRAMITE',
      'ID_USUARIO_REG',
      'FEC_SOLICITUD_TRAMITE',
      'ESTADO_TRAMITE',
      'VIGENCIA',
      'OIDO_CODIGO',
      'PRIMERNOMBRE',
      'SEGUNDONOMBRE',
      'PRIMERAPELLIDO',
      'SEGUNDOAPELLIDO',
      'PRIMERTELEFONO',
      'SEGUNDOTELEFONO',
      'EMAIL',
      'DIRECCION',
      'LOCALIDAD',
      'TIPOSOLICITUD',
      'TIPODOCAPODERADO',
      'NUMDOCAPODERADO',
      'PRIMERNOMBREAPODERADO',
      'SEGUNDONOMBREAPODERADO',
      'PRIMERAPELLIDOAPODERADO',
      'SEGUNDOAPELLIDOAPODERADO',
      'TARJETAPROFESIONAL',
      'PRIMERTELEFONOAPODERADO',
      'SEGUNDOTELEFONOAPODERADO',
      'direccionapoderado',
      'EMAILAPODERADO',
      'TIPOAUDIENCIA',
      'SEDEPRINCIPAL',
      'SEDESECUNDARIA',
      'ASUNTO',
      'SUBASUNTO',
      'TIPODOCUMENTO',
      'DETALLE',
      'CUANTIA',
      'CODE',
      
      'estadodoc',
      'sis_departam_id',
      'sis_municipio_id',
      'id_usuario_adm',
      'fechanacimiento',
      'escolaridad',
      'sexo',
      'genero',
      'orientacion',
      'nacionalidad',
      'grupoafectado',
      'rangoedad',
      'sis_esta_id',
      ];

      public function asuntos()
      {
        return $this->belongsTo(Asunto::class, 'asunto');
      }

      public function subasuntos()
      {
        return $this->belongsTo(SubAsunto::class, 'subasunto');
      }

      public function soportes()
      {
        return $this->hasMany(Soportecon::class, 'subasunto');
      }

      public function realizarCambioDespuesDe5Dias($dias)
      {
        $fechaCreacion = Carbon::parse($this->created_at);

        $fechaCambio = $fechaCreacion->addWeekdays($dias);

        if (Carbon::now()->isSameDay($fechaCambio) || Carbon::now()->gt($fechaCambio)) {
            $this->update(['estado_tramite' => 'Desistimiento']);
        }
  }
}

