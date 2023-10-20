<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estadoform;
use App\Models\Sistema\SisEsta;
use App\Models\Texto;
use Illuminate\Support\Facades\Validator;

class EstadoFormController extends Controller{
    public function __construct(){

        $this->opciones['permisox']='salario';

    }

    public function index(Request $request){
        $datos = $this->datos($request->all());
        $buscar = ($request->buscar) ? $request->buscar : '';
        return view('administracion.EstadoFormulario.index', compact('datos', 'buscar'));
    }

    public function create(Request $request){
        return view('administracion.EstadoFormulario.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        Estadoform::create($request->all());
        return redirect()->route('estadoform')->with('info', 'Registro creado con éxito');
    }

    public function show($id){
        $dato = Estadoform::findOrFail($id);
        return view('administracion.EstadoFormulario.index', ['accion' => 'Ver'], compact('dato'));
    }

    public function edit($id){
        $dato = Estadoform::findOrFail($id);
        $estado = SisEsta::combo(['cabecera' => true, 'esajaxxx' => false]);
        return view('administracion.EstadoFormulario.index', ['accion' => 'Editar'], compact('dato','estado'));
    }

    
    public function editcierre($id){
        $dato = Estadoform::findOrFail($id);
        $mensaje = Texto::where('tipotexto_id', 50)->first();
        $estado = SisEsta::combo(['cabecera' => true, 'esajaxxx' => false]);
        return view('administracion.EstadoCierre.index', ['accion' => 'Editar'], compact('dato','estado','mensaje'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();

        $dato = Estadoform::findOrFail($id);
        $texto = $dato->texto;
  
        $dato->fill($request->all())->save();
        $texto->fill($request->all())->save();
        return redirect()->route('estadoform.editar',$id)->with('info', 'Registro actualizado con éxito');
    }

    public function updatecierre(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();

        $dato = Estadoform::findOrFail($id);
       $texto = $dato->texto;
  
        $dato->fill($request->all())->save();
        $texto->fill($request->all())->save();
        return redirect()->route('estadoform.editar',$id)->with('info', 'Registro actualizado con éxito');
    }

    public function destroy($id){
        $dato = Estadoform::findOrFail($id);
        $dato->sis_esta_id = ($dato->sis_esta_id == 2) ? 1 : 2;
        $dato->save();
        $activado = $dato->sis_esta_id == 2 ? 'inactivado' : 'activado';
        return redirect()->route('EstadoFormulario')->with('info', 'Registro '.$activado.' con éxito');
    }

    protected function datos(array $request){
        return Estadoform::select('id', 'estado', 'sis_esta_id')
            ->when(request('buscar'), function($q, $buscar){
                return $q->orWhere('estado', 'like', '%'.$buscar.'%')->orWhere('id','like','%'.$buscar.'%');
            })
            ->orderBy('nombre')->paginate(10);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'sis_esta_id' => 'required',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'sis_esta_id' => 'required',
        ]);
    }
}
