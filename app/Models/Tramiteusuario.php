<?php

namespace App\Models;

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
      'ESTADO_TRAMITE',
      'estadodoc',
      'sis_departam_id',
      'sis_municipio_id',

            'fechanacimiento',
      'escolaridad',
      'sexo',
      'genero',
      'orientacion',
      'nacionalidad',
      

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
}
