<?php

namespace App\Http\Requests\AsuntoAdmin;

use Illuminate\Foundation\Http\FormRequest;

class AsuntoRequest extends FormRequest
{
    private $_mensaje;
    private $_reglasx;

    public function __construct()
    {
        $this->_mensaje = [
            'nombre' => 'Ingrese el Nombre',
            'sis_esta_id.required'=> 'Seleccione el estado',
        ];
        $this->_reglasx = [
            'nombre' => ['Required'],
            'sis_esta_id' => ['Required'],
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
    }
}
