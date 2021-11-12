<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministracionController extends Controller
{
    public function __construct()
    {
        $this->middleware('Administracion');
    }

    public function RegistrarArea(){
        
        $areas = DB::table('area')->get();

        return view('Administracion.RegistrarArea', ['areas'=>$areas]);
    }

    public function guardarArea(Request $request){
        
        $guardar = DB::table('area')
        ->insert([
            'nombre'=>$request->area,
            'estado'=>"1"
        ]);
        
        if($guardar){
            $respuesta = ['success'=>true];
        }else{
            $respuesta = ['success'=>false];
        }

        return $respuesta;
        //return redirect()->route('RegistrarArea')->with('mensaje', 'Registro satisfactorio!');
    }

    public function updateArea(Request $request){

        $actualizar = DB::table('area')
        ->where('idArea', '=', $request->idArea)
        ->update([
            'nombre' => $request->area
        ]);

        if($actualizar){
            $respuesta = ['success'=>true];
        }else{
            $respuesta = ['success'=>false];
        }

        return $respuesta;
    }

    public function reloadArea(){

        $areas = DB::table('area')->get();
        $recargar = null;

        foreach ($areas as $area){
            if ($area->estado==1){
                $estado = '<td><span class="badge badge-success">Activo</span></td>
                <td>
                    <button class="btn btn-danger eliminarActivar" estado="0" idArea="'.$area->idArea .'">Eliminar</button>
                    <button class="btn btn-warning editarArea" editarArea="'.$area->idArea.'">Editar</button>
                </td>';
            }else{
                $estado = '<td><span class="badge badge-danger">Inactivo</span></td>
                <td>
                    <button class="btn btn-primary eliminarActivar" estado="1" idArea="'.$area->idArea .'">Activar</button>
                    <button class="btn btn-warning editarArea" editarArea="'.$area->idArea.'">Editar</button>
                </td>';
            }

            $recargar .= '
            <tr>
                <td>'.$area->idArea.'</td>
                <td>'.$area->nombre.'</td>
                '.$estado.'
            </tr>
            ';
        }

        return $recargar;
    }

    public function eliminarActivar(Request $request){
        
        $actualizar = DB::table('area')
        ->where('idArea', '=', $request->idArea)
        ->update([
            'estado' => $request->estado
        ]);

        if($actualizar){
            $respuesta = ['success'=>true];
        }else{
            $respuesta = ['success'=>false];
        }

        return $respuesta;
    }

    public function editarArea(Request $request){

        $filtro = DB::table('area')
        ->where('idArea', '=', $request->idArea)
        ->first();

        $pintar = null;

        $pintar = '<form id="frmEditarArea">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label for="area">Area</label>
                <input type="text" name="areaEditar" id="areaEditar" value="'.$filtro->nombre.'" class="form-control">
                <input type="text" name="idAreaEditar" id="idAreaEditar" value="'.$filtro->idArea.'" hidden>
            </div>
        </div>
    </form>';

    return $pintar;
    }

    public function registerEmpleado(){

        $areas = DB::table('area')
        ->get();

        $empleados = DB::table('empleado')
        ->select('empleado.*', 'area.nombre as area')
        ->join('area', 'area.idArea', 'empleado.idArea')
        ->get();

        return view('Administracion.Empleado.RegistrarEmpleado', ['areas'=>$areas, 'empleados'=>$empleados]);
    }

    public function guadarEmpleado(Request $request){
        
        $empleado = DB::table('empleado')
        ->insert([
            'nombre' => $request->nombre,
            'dpi' => $request->dpi,
            'nacimiento' => $request->nacimiento,
            'direccion' => $request->direccion,
            'telefono'=> $request->telefono,
            'estadoCivil' => $request->estadoCivil,
            'correo' => $request->correo,
            'idArea' => $request->area
        ]);

        if($empleado){
            $respuesta = ['success'=>true];
        }else{
            $respuesta = ['success'=>false];
        }

        return $respuesta;
    }

    public function recargaEmpleado(){
        
        $empleados = DB::table('empleado')
        ->select('empleado.*', 'area.nombre as area')
        ->join('area', 'area.idArea', 'empleado.idArea')
        ->get();

        $tabla = null;

        foreach($empleados as $empleado){
            
            if ($empleado->estado == 1){
                $estado = '<td><span class="badge badge-success">Activo</span></td>';
                $boton = '<button class="btn btn-danger elimiarActivar" estado="0"
                idEmpleado="'.$empleado->idEmpleado .'">Eliminar</button>';
            }else{
                $estado = '<td><span class="badge badge-danger">Inactivo</span></td>';
                $boton = '<button class="btn btn-success elimiarActivar" estado="1"
                idEmpleado="'. $empleado->idEmpleado .'">Activar</button>';
            }

            $tabla .= '
            <tr>
                <td>'. $empleado->idEmpleado .'</td>
                <td>'. $empleado->nombre .'</td>
                <td>'. $empleado->dpi .'</td>
                <td>'. $empleado->nacimiento .'</td>
                <td>'. $empleado->direccion .'</td>
                <td>'. $empleado->telefono .'</td>
                <td>'. $empleado->estadoCivil .'</td>
                <td>'. $empleado->correo .'</td>
                '.$estado.'
                <td>'. $empleado->area .'</td>
                <td>'.$boton.' <button class="btn btn-info btnEditar"
                idEmpleado="'. $empleado->idEmpleado .'">Editar</button></td>
            </tr>
            ';
                   
        }

        return $tabla;
    }

    public function estadoEmpleado(Request $request){

        $empleado = DB::table('empleado')
        ->where('idEmpleado', '=', $request->idEmpleado)
        ->update([
            'estado' => $request->estado
        ]);

        if($empleado){
            $respuesta = ['success'=>true];
        }else{
            $respuesta = ['success'=>false];
        }

        return $respuesta;
    }

    public function editarEmpleado(Request $request){

        $empleados = DB::table('empleado')
        ->select('empleado.*', 'area.nombre as area')
        ->join('area', 'area.idArea', 'empleado.idArea')
        ->where('empleado.idEmpleado', $request->idEmpleado)
        ->first();

        $areas = DB::table('area')
        ->get();

        $select = null;

        foreach ($areas as $area){
            $select .= '
                <option value="'. $area->idArea .'">'. $area->nombre .'</option>
            ';
        }

        $formulario = '
        <form action="" method="post" id="frmEmpeladoEditar">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <label for="Editarnombre">Nombre:</label>
                    <input type="text" class="form-control" name="Editarnombre" id="Editarnombre" value="'.$empleados->nombre.'">
                    <input type="text" class="form-control" name="EditaridEmpleado" id="EditaridEmpleado" value="'.$empleados->idEmpleado.'" hidden>
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="Editartelefono">Telefono:</label>
                    <input type="text" class="form-control" name="Editartelefono" id="Editartelefono" value="'.$empleados->telefono.'">
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="Editardpi">DPI:</label>
                    <input type="text" class="form-control" name="Editardpi" id="Editardpi" value="'.$empleados->dpi.'">
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="Editarnacimiento">Fecha nacimiento</label>
                    <input type="date" name="Editarnacimiento" id="Editarnacimiento" class="form-control" value="'.$empleados->nacimiento.'">
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="EditarestadoCivil">Estado Civil: <span class="badge badge-info">'.$empleados->estadoCivil.'</span></label>
                    <select name="EditarestadoCivil" id="EditarestadoCivil" class="form-control">
                        <option value="'.$empleados->estadoCivil.'">'.$empleados->estadoCivil.'</option>
                        <option value="Soltero">Soltero</option>
                        <option value="Casado">Casado</option>
                        <option value="Viudo">Viudo</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="Editarcorreo">Correo Electronico:</label>
                    <input type="email" class="form-control" name="Editarcorreo" id="Editarcorreo" value="'.$empleados->correo.'">
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="Editararea">Area: <span class="badge badge-info">'.$empleados->area.'</span></label>
                    <select class="form-control" name="Editararea" id="Editararea">
                    <option value="'.$empleados->idArea.'">'.$empleados->area.'</option>
                        '.$select.'
                    </select>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label for="Editardireccion">Dirección:</label>
                    <textarea class="form-control" name="Editardireccion" id="Editardireccion">'.$empleados->direccion.'</textarea>
                </div>
            </div>
        </form>';

        return $formulario;
    }

    public function updateEmpleado(Request $request){
       
        $empleado = DB::table('empleado')
        ->where('idEmpleado', '=', $request->EditaridEmpleado)
        ->update([
            'nombre' => $request->Editarnombre,
            'dpi' => $request->Editardpi,
            'nacimiento' => $request->Editarnacimiento,
            'direccion' => $request->Editardireccion,
            'telefono'=> $request->Editartelefono,
            'estadoCivil' => $request->EditarestadoCivil,
            'correo' => $request->Editarcorreo,
            'idArea' => $request->Editararea
        ]);

        if($empleado){
            $respuesta = ['success'=>true];
        }else{
            $respuesta = ['success'=>false];
        }

        return $respuesta;
    }
    public function entradas(){
        $empleados = DB::table('empleado')
        ->select('empleado.*', 'area.nombre as area')
        ->join('area', 'area.idArea', 'empleado.idArea')
        ->where('empleado.estado', '=', 1)
        ->get();

        return view('Administracion.Empleado.Entradas', ['empleados'=>$empleados]);
    }

    public function horarioEntrada(Request $request){

        $horario = DB::table('horarios')
        ->insert([
            'horaEntrada' => $request->horaEntrada,
            
        ]);
    }
}
