<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdjuntarRequest extends FormRequest
{
    private $_mensaje;
    private $_reglasx;

    public function __construct()
    {
        $this->_mensaje = [
            'document1.required' => 'Debe adjuntar el soporte',
            'document1.mimes' => 'El archivo debe ser imagen o pdf',
        ];
        $this->_reglasx = [
            'document1' => 'required|file|mimes:pdf,jpg,jpeg|max:10024',
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
