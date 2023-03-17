<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolUsuarioEditarRequest extends FormRequest
{
    private $_mensaje;
    private $_reglasx;

    public function __construct()
    {

        $this->_mensaje = [
            'model_id.required' => 'Seleccione un usuario',
            'role_id.required' => 'Seleccione un rol',
            'sis_esta_id.required' => 'Seleccione un estado',

        ];
        $this->_reglasx = [
            'model_id' => ['required'],
            'role_id' => ['required'],
            'sis_esta_id' => ['required'],
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
        $dataxxxx = $this->segments(); // todo lo que se envia del formulario
    }
}
