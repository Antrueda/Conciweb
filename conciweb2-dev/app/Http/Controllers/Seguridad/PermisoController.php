<?php

namespace App\Http\Controllers\Seguridad;


use App\Http\Controllers\Controller;
use App\Models\Permissionext;
use App\Http\Requests\Seguridad\PermisoCrearRequest;
use App\Http\Requests\Seguridad\PermisoUpdateRequest;
use Illuminate\Http\Request;

class PermisoController extends Controller
{

    private $opciones;

    public function __construct()
    {
        $this->opciones['permisox'] = 'permiso';
        $this->middleware(['permission:'
            . $this->opciones['permisox'] . '-leer|'
            . $this->opciones['permisox'] . '-crear|'
            . $this->opciones['permisox'] . '-editar|'
            . $this->opciones['permisox'] . '-borrar']);

        $this->opciones = ['tituloxx' => '', 'rutaxxxx' => 'permiso', 'vistaxxx' => 'permiso', 'accionxx' => '', 'volverax' => 'Permisos'];
    }
    protected function datos(array $request)
    {
        return Permissionext::select('id', 'name', 'sis_esta_id')
            ->when(request('buscar'), function ($q, $buscar) {
                return $q->where('name', 'like', '%' . $buscar . '%');
            })
            ->orderBy('name')->paginate(10);
    }
    public function index(Request $request)
    {
        $rolesxxx = $this->datos($request->all());
        $buscar = ($request->buscar) ? $request->buscar : '';
        $cabecera = [
            ['td' => 'ID'],
            ['td' => 'NOMBRE  PERMISO'],
            ['td' => 'ESTADO'],
        ];
        $regitabl = [];
        foreach ($rolesxxx as $rolexxxx) {
            $regitabl[] = [
                'body' => [
                    ['td' => $rolexxxx->id],
                    ['td' => $rolexxxx->name],
                    ['td' => $rolexxxx->estado = 1 ? 'ACTIVO' : 'INACTIVO']
                ],
                'id' => $rolexxxx->id,
                'estadoxx' => $rolexxxx->sis_esta_id,
            ];
        }

        return view(
            $this->opciones['rutaxxxx'] . '.index',
            [
                'buscarxx' => $buscar,
                'regitabl' => $regitabl,
                'registro' => $rolesxxx,
                'cabecera' => $cabecera,
                'opciones' => $this->opciones
            ]
        );
    }

    /**
     *
     * Es metodo sen encarga de armar la estructura para los metos create, edit y show
     *
     */
    private function view($objetoxx, $nombobje, $accionxx)
    {
        $this->opciones['estadoxx'] = 'ACTIVO';
        $this->opciones['accionxx'] = $accionxx;

        // indica si se esta actualizando o viendo
        if ($nombobje != '') {
            $objetoxx->estado = 1 ? 'ACTIVO' : 'INACTIVO';
            $this->opciones[$nombobje] = $objetoxx;
        }
        $this->opciones['apermiso'] = Permissionext::get();

        // Se arma el titulo de acuerdo al array opciones
     

        return view($this->opciones['rutaxxxx'] . '.' . strtolower($this->opciones['accionxx']), $this->opciones);
    }

    public function create()
    {
        $this->opciones['tituloxx'] = 'CREAR';
        return $this->view(true, '', 'Crear');
    }

    public function store(PermisoCrearRequest $request)
    {

        $permisox = Permissionext::create(['name' => $request->all()['name']]);

        return redirect()->route($this->opciones['rutaxxxx'] . '.editar', $permisox->id)
            ->with('info', 'Permiso guardado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Permissionext $role
     * @return \Illuminate\Http\Response
     */
    public function show(Permissionext $permiso)
    {

        return $this->view($permiso, 'role', 'Ver');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permissionext  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Permissionext $permiso)
    {
        $this->opciones['tituloxx'] = 'EDITAR';
        return $this->view($permiso, 'modeloxx', 'Editar');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permissionext  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(PermisoUpdateRequest $request, Permissionext $permiso)
    {
        // Actualizar el rol
        $permiso->update($request->all());

        return redirect()->route($this->opciones['rutaxxxx'] . '.editar', $permiso->id)
            ->with('info', 'Permiso actualizado con éxito');
    }

    public function destroy($id)
    {

        echo $id;
    }
}
