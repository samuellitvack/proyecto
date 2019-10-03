<?php

namespace App\Http\Controllers;

use App\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::select('id', 'DNI', 'Nombre', 'Apellido', 'Fecha_nac', 'Telefono', 'Direccion', 'Nacionalidad')->get();
        return $alumnos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("alumnos.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validar = Validator::make($request->all(), ['DNI'=> 'required|integer', 'Nombre'=>'required|alpha', 'Apellido'=>'required|alpha', 'Fecha_nac'=>'required|date', 'Telefono'=>'required', 'Direccion'=>'required', 'Nacionalidad'=>'required']);

        if($validar->fails()){
            $errores = $validar->errors();
            return response()->json(['error' => true, 'mensaje' => $errores->all()]);
        }else{
            $alumno = new Alumno();
            $alumno->DNI = $request->get('DNI');
            $alumno->Nombre = $request->get('Nombre');
            $alumno->Apellido = $request->get('Apellido');
            $alumno->Fecha_nac = $request->get('Fecha_nac');
            $alumno->Telefono = $request->get('Telefono');
            $alumno->Direccion = $request->get('Direccion');
            $alumno->Nacionalidad = $request->get('Nacionalidad');

            $existe = DB::table('table_alumnos')->where('DNI', $request->get('DNI'))->count();

            if($existe > 0){
                $mensaje = ['El alumno ya se encuentra en el sistema'];
                return response()->json(['error' => true, 'mensaje' => $mensaje]);
            }else{
                $alumno->save();
                return response()->json(['error' => false, 'mensaje' => 'Alumno cargada correctamente', 'ultimoid' => $alumno->id]);
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validar = Validator::make($request->all(), ['DNI'=> 'required|integer', 'Nombre'=>'required|alpha', 'Apellido'=>'required|alpha', 'Fecha_nac'=>'required|date', 'Telefono'=>'required', 'Direccion'=>'required', 'Nacionalidad'=>'required']);

        if($validar->fails()){
            $errores = $validar->errors();
            return response()->json(['error' => true, 'mensaje' => $errores->all()]);
        }else{
            $alumno = Alumno::find($request->get('id'));
            $alumno->DNI = $request->get('DNI');
            $alumno->Nombre = $request->get('Nombre');
            $alumno->Apellido = $request->get('Apellido');
            $alumno->Fecha_nac = $request->get('Fecha_nac');
            $alumno->Telefono = $request->get('Telefono');
            $alumno->Direccion = $request->get('Direccion');
            $alumno->Nacionalidad = $request->get('Nacionalidad');

            $alumno->save();
            return response()->json(['error' => false, 'mensaje' => 'Alumno modificado correctamente']);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("table_cursando")->where('id_alumno', $id)->delete();
        DB::table("table_nota")->where('id_alumno', $id)->delete();
        DB::table("table_asistencias")->where('id_alumno', $id)->delete();

        $alumno = Alumno::find($id);
        $alumno->delete();
        return response()->json(['mensaje' => 'Alumno eliminado correctamente']); 
    }
}
