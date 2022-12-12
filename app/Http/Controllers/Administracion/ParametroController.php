<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Parametro;
use Illuminate\Support\Facades\Validator;

class ParametroController extends Controller{
    public function __construct(){

        $this->opciones['permisox']='parametro';

    }

    public function index(Request $request){
        $datos = $this->datos($request->all());
        $buscar = ($request->buscar) ? $request->buscar : '';
        return view('administracion.parametro.index', compact('datos', 'buscar'));
    }

    public function create(Request $request){
        return view('administracion.parametro.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        Parametro::create($request->all());
        return redirect()->route('parametro')->with('info', 'Registro creado con éxito');
    }

    public function show($id){
        $dato = Parametro::findOrFail($id);
        return view('administracion.parametro.index', ['accion' => 'Ver'], compact('dato'));
    }

    public function edit($id){
        $dato = Parametro::findOrFail($id);
        return view('administracion.parametro.index', ['accion' => 'Editar'], compact('dato'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Parametro::findOrFail($id);
        $dato->fill($request->all())->save();
        return redirect()->route('parametro')->with('info', 'Registro actualizado con éxito');
    }

    public function destroy($id){
        $dato = Parametro::findOrFail($id);
        $dato->sis_esta_id = ($dato->sis_esta_id == 2) ? 1 : 2;
        $dato->save();
        $activado = $dato->sis_esta_id == 2 ? 'inactivado' : 'activado';
        return redirect()->route('parametro')->with('info', 'Registro '.$activado.' con éxito');
    }

    protected function datos(array $request){
        return Parametro::select('id', 'nombre', 'sis_esta_id')
            ->when(request('buscar'), function($q, $buscar){
                return $q->orWhere('nombre', 'like', '%'.$buscar.'%')->orWhere('id','like','%'.$buscar.'%');
            })
            ->orderBy('nombre')->paginate(10);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'nombre' => 'required|string|max:120|unique:parametros',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'nombre' => 'required|string|max:120|unique:parametros,nombre,'.$id,
        ]);
    }
}
