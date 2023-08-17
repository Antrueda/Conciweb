<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ConciDocumento;
use App\Models\Estadoform;
use App\Models\Sistema\SisEsta;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentoDescargaController extends Controller{
    public function __construct(){

        $this->opciones['permisox']='documentd';

    }

    public function index(Request $request){
        $datos = $this->datos($request->all());
        $buscar = ($request->buscar) ? $request->buscar : '';
        return view('administracion.DocumentoDescarga.index', compact('datos', 'buscar'));
    }

    public function create(Request $request){
        return view('administracion.DocumentoDescarga.index', ['accion' => 'Nuevo']);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $document = $request->file("document1");
   
        $nombreOriginalFile = $document->getClientOriginalName();

        $rutaFinalFile = $document->storeAs('Soporte/',$nombreOriginalFile);
        
        
        ConciDocumento::create(['descripcion' => $nombreOriginalFile, 'rutaFinalFile' => $rutaFinalFile, 'nombreOriginalFile' =>$nombreOriginalFile]);
        return redirect()->route('admin');
    }

    public function show($id){
        $dato = ConciDocumento::findOrFail($id);
        return view('administracion.DocumentoDescarga.index', ['accion' => 'Ver'], compact('dato'));
    }

    public function edit($id){
        
        $dato = ConciDocumento::findOrFail($id);
        return view('administracion.DocumentoDescarga.index', ['accion' => 'Editar'], compact('dato','estado'));
    }

    public function update(Request $request, $id){
        $this->validatorUpdate($request->all(), $id)->validate();

        
      
        $dato = ConciDocumento::findOrFail($id);
       $texto = $dato->texto;
  
        $dato->fill($request->all())->save();
        $texto->fill($request->all())->save();
        return redirect()->route('documentd.editar',$id)->with('info', 'Registro actualizado con éxito');
    }

    public function destroy($id){
        $dato = ConciDocumento::findOrFail($id);
        $dato->sis_esta_id = ($dato->sis_esta_id == 2) ? 1 : 2;
        $dato->save();
        $activado = $dato->sis_esta_id == 2 ? 'inactivado' : 'activado';
        return redirect()->route('DocumentoDescarga')->with('info', 'Registro '.$activado.' con éxito');
    }

    protected function datos(array $request){
        return ConciDocumento::select('id', 'nombreoriginalfile', 'rutafinalfile')
            ->when(request('buscar'), function($q, $buscar){
                return $q->orWhere('nombreoriginalfile', 'like', '%'.$buscar.'%')->orWhere('id','like','%'.$buscar.'%');
            })
            ->orderBy('nombreoriginalfile')->paginate(10);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'document1' => 'required',
        ]);
    }

    protected function validatorUpdate(array $data, $id){
        return Validator::make($data, [
            'document1' => 'required',
        ]);
    }
}
