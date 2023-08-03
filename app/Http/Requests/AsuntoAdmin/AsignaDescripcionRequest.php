<?php

namespace App\Http\Requests\AsuntoAdmin;

use Illuminate\Foundation\Http\FormRequest;

class AsignaDescripcionRequest extends FormRequest
{
    private $_mensaje;
    private $_reglasx;

    public function __construct()
    {
        $this->_mensaje = [
            'descri_id' => 'Seleccione el adjunto',
            'subasu_id' => 'Seleccione el sub asunto',
            'obligatorio' => 'Indique si es obligatorio',
            'sis_esta_id.required'=> 'Seleccione el estado',
        ];
        $this->_reglasx = [
            'descri_id' => ['Required'],
            'subasu_id' => ['Required'],
            'obligatorio' => ['Required'],
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
