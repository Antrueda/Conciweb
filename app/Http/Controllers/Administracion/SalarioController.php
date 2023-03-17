<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Parametro;
use App\Models\Salario;
use Illuminate\Support\Facades\Validator;

class SalarioController extends Controller{
    public function __construct(){

        $this->opciones['permisox']='salario';

    }

    public function index(Request $request){
        $datos = $this->datos($request->all());
        $buscar = ($request->buscar) ? $request->buscar : '';
        return view('administracion.salario.index', compact('datos', 'buscar'));
    }

    public function create(Request $request){
        return view('administracion.salario.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        Salario::create($request->all());
        return redirect()->route('salario')->with('info', 'Registro creado con éxito');
    }

    public function show($id){
        $dato = Salario::findOrFail($id);
        return view('administracion.salario.index', ['accion' => 'Ver'], compact('dato'));
    }

    public function edit($id){
        $dato = Salario::findOrFail($id);
        return view('administracion.salario.index', ['accion' => 'Editar'], compact('dato'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = Salario::findOrFail($id);
        $dato->fill($request->all())->save();
        return redirect()->route('salario.editar',$id)->with('info', 'Registro actualizado con éxito');
    }

    public function destroy($id){
        $dato = Salario::findOrFail($id);
        $dato->sis_esta_id = ($dato->sis_esta_id == 2) ? 1 : 2;
        $dato->save();
        $activado = $dato->sis_esta_id == 2 ? 'inactivado' : 'activado';
        return redirect()->route('salario')->with('info', 'Registro '.$activado.' con éxito');
    }

    protected function datos(array $request){
        return Salario::select('id', 'numero', 'sis_esta_id')
            ->when(request('buscar'), function($q, $buscar){
                return $q->orWhere('numero', 'like', '%'.$buscar.'%')->orWhere('id','like','%'.$buscar.'%');
            })
            ->orderBy('nombre')->paginate(10);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'numero' => 'required|string|max:120',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'numero' => 'required|string|max:120,'.$id,
        ]);
    }
}
