<?php

namespace App\Http\Requests\TextoAdmin;

use Illuminate\Foundation\Http\FormRequest;

class TextoEditarRequest extends FormRequest
{
    private $_mensaje;
    private $_reglasx;

    public function __construct()
    {
        $this->_mensaje = [
            'texto.required' => 'Ingrese el texto',
            'tipotexto_id.required' => 'Seleccione el tipo de texto',
            'sis_esta_id.required'=> 'Seleccione el estado',
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
        $this->_reglasx = [
            'texto' => ['Required'],
            'tipotexto_id' => ['Required'],
            'sis_esta_id' => ['Required'],
            ];
        return $this->_reglasx;
    }

    public function validar()
    {
        $dataxxxx = $this->toArray(); // todo lo que se envia del formulario
    }
}

