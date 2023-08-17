<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ConciTiempo;
use Illuminate\Support\Facades\Validator;

class TiempoDesistimientoController extends Controller{
    public function __construct(){
        $this->opciones['permisox']='tiempod';

    }

    public function index(Request $request){
        $datos = $this->datos($request->all());
        $buscar = ($request->buscar) ? $request->buscar : '';
        return view('administracion.Tiempo.index', compact('datos', 'buscar'));
    }

    public function create(Request $request){
        return view('administracion.Tiempo.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        ConciTiempo::create($request->all());
        return redirect()->route('tiempod')->with('info', 'Registro creado con éxito');
    }

    public function show($id){
        $dato = ConciTiempo::findOrFail($id);
        return view('administracion.Tiempo.index', ['accion' => 'Ver'], compact('dato'));
    }

    public function edit($id){
        $dato = ConciTiempo::findOrFail($id);
        
        return view('administracion.Tiempo.index', ['accion' => 'Editar'], compact('dato'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();
        $dato = ConciTiempo::findOrFail($id);
        $dato->fill($request->all())->save();
        
        return redirect()->route('admin');
    }

    public function destroy($id){
        $dato = ConciTiempo::findOrFail($id);
        $dato->sis_esta_id = ($dato->sis_esta_id == 2) ? 1 : 2;
        $dato->save();
        $activado = $dato->sis_esta_id == 2 ? 'inactivado' : 'activado';
        return redirect()->route('tiempod')->with('info', 'Registro '.$activado.' con éxito');
    }

    protected function datos(array $request){
        return ConciTiempo::select('id', 'estado', 'sis_esta_id')
            ->when(request('buscar'), function($q, $buscar){
                return $q->orWhere('estado', 'like', '%'.$buscar.'%')->orWhere('id','like','%'.$buscar.'%');
            })
            ->orderBy('nombre')->paginate(10);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'tiempo' => 'required',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'tiempo' => 'required',
        ]);
    }
}
