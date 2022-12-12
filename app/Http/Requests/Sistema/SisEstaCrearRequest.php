<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class SisEstaCrearRequest extends FormRequest
{

    private $_mensaje;
    private $_reglasx;

    public function __construct()
    {

        $this->_mensaje = [
            's_estado.required' => 'Ingrese el nombre del estado',
            's_estado.unique' => 'El estado ya se encuentra en uso',
        ];
        $this->_reglasx = [
            's_estado' =>
            [
                'required',
                'unique:sis_estas,s_estado,'
            ],
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return $this->_mensaje;
    }

    /**
     * Get the validation rules that Apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->validar();
        return $this->_reglasx;
    }

    public function validar()
    {
        $dataxxxx = $this->toArray(); // todo lo que se envia del formulario
        // unico para relacion multiple
        // $docuindi = InDocIndi::where('in_indicador_id', $dataxxxx['in_indicador_id'])
        //     ->where('sis_docfuen_id', $dataxxxx['sis_docfuen_id'])->first();
        // if (isset($docuindi->id)) {
        //     $this->_mensaje['asociacion.required'] = 'la asociacion del indicador y el docuemnto fuente ya existe';
        //     $this->_reglasx['asociacion'] = 'required';
        // }

        // if (!isset($dataxxxx['permissions'])) {
        //     $this->_mensaje['permissions.required'] = 'Seleccione al menos un permios';
        //     $this->_reglasx['permissions'] = 'required';
        // }
    }
}
