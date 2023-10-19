<?php

namespace App\Models;

use app\Models\Soportecon;
use App\tramiterespuesta;
use App\tramiteusuario as AppTramiteusuario;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramiteusuario extends Model
{
    use HasFactory;
    protected $table = 'conci_tramiteusuarios';
    public $incrementing = false;
    protected $primaryKey = 'num_solicitud';
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
      'estrato',
      'estadodoc',
      'observaciones',
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

  //     public function realizarCambioDespuesDe5Dias($dias)
  //     {
  //       $fechaCreacion = Carbon::parse($this->fec_solicitud_tramite);
        
  //       $fechaCambio = $fechaCreacion->addWeekdays($dias);
        
  //       if (Carbon::now()->isSameDay($fechaCambio) || Carbon::now()->gt($fechaCambio)) {
  //         $this->update(['ESTADO_TRAMITE' => 'Finalizado','estadodoc' => 'Desistimiento Automatico']);
  //       }
  // }


        public function realizarCambioDespuesDe5Dias($dias)
        {
          $fechaCreacion = Carbon::parse($this->fec_solicitud_tramite);
          // dd($this->num_solicitud);
          $tramites=AppTramiteusuario::where('NUM_SOLICITUD',$this->num_solicitud)
          ->where('id_tramite', 335)
          ->where('vigencia',$this->vigencia)->first();

          $respuest=Tramiterespuesta::where('NUM_SOLICITUD',$this->num_solicitud)
          ->where('id_tramite', 335)
          ->where('vigencia',$this->vigencia)->first();

          $respuestsi=tramiterespuesta::where('NUM_SOLICITUD',$this->num_solicitud)
          ->where('id_tramite', 335)
          ->where('vigencia',$this->vigencia)->first();
          
          $fechaCambio = $fechaCreacion->addWeekdays($dias);
          //dd($fechaCambio.' Solicitud: '.$this->num_solicitud . ' fecha '.$this->fec_solicitud_tramite );
          if (Carbon::now()->isSameDay($fechaCambio) || Carbon::now()->gt($fechaCambio)) {
            $this->update(['ESTADO_TRAMITE' => 'Finalizado','estadodoc' => 'Desistimiento Automatico']);
            if(isset($respuestsi)){
              
              $respuestsi=tramiterespuesta::where('NUM_SOLICITUD',$this->num_solicitud)
              ->where('id_tramite', 335)
              ->where('vigencia',$this->vigencia)->update(['ESTADO_TRAMITE' => 'Finalizado']);
            }
            if(isset($respuest)){

              $respuest=Tramiterespuesta::where('NUM_SOLICITUD',$this->num_solicitud)
              ->where('id_tramite', 335)
              ->where('vigencia',$this->vigencia)->update(['ESTADO_TRAMITE' => 'Finalizado']);
    
              
            }
            if(isset($tramites)){
              $tramites=AppTramiteusuario::where('NUM_SOLICITUD',$this->num_solicitud)
              ->where('id_tramite', 335)
              ->where('vigencia',$this->vigencia)->update(['ESTADO_TRAMITE' => 'Finalizado']);
              
            }
          
          }
      }
}

