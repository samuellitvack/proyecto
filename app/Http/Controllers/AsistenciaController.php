<?php

namespace App\Http\Controllers;

use App\Asistencia;
use Illuminate\Http\Request;
use DB;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_curso, $fecha)
    {
        $asistencias = DB::select(DB::raw("SELECT 
table_cursando.*,
table_alumnos.DNI as DNI_alumno,
table_alumnos.Nombre as Nombre_alumno,
table_alumnos.Apellido as Apellido_alumno,

(SELECT table_asistencias.Presente FROM table_asistencias WHERE table_asistencias.id_curso = table_cursando.id_curso AND table_cursando.id_alumno = table_asistencias.id_alumno AND table_asistencias.Fecha = '".$fecha."') as Presente,

(SELECT table_asistencias.Justificada FROM table_asistencias WHERE table_asistencias.id_curso = table_cursando.id_curso AND table_cursando.id_alumno = table_asistencias.id_alumno AND table_asistencias.Fecha = '".$fecha."') as Justificada

FROM table_cursando
INNER JOIN table_alumnos ON table_alumnos.id = table_cursando.id_alumno WHERE table_cursando.id_curso = ".$id_curso));
        return $asistencias;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $asistencias = json_decode($request->get('asistencias'), true);
        $fecha = $request->get('fecha');

        foreach($asistencias as $asistencia){
            $id_alumno = $asistencia['id_alumno'];
            $id_curso = $asistencia['id_curso'];
            $presente = $asistencia['Presente'];
            $justificada = $asistencia['Justificada'];

            if($presente && $justificada){
                $mensaje = ['Error. Revise las casillas seleccionadas'];
                return response()->json(['error' => true, 'mensaje' => $mensaje]);
            }else{
                if($presente){
                    $presente = 1;
                }else{
                    $presente = 0;
                }

                if($justificada){
                    $justificada = 1;
                }else{
                    $justificada = 0;
                }

                $res = DB::table('table_asistencias')->where('id_alumno', $id_alumno)->where('id_curso', $id_curso)->where('Fecha', $fecha)->count();

                if($res > 0){
                    DB::table('table_asistencias')->where('id_alumno', $id_alumno)->where('id_curso', $id_curso)->where('Fecha', $fecha)->update(['Presente' => $presente, 'Justificada' => $justificada]);
                }else{
                    DB::table('table_asistencias')->insert(['id_alumno' => $id_alumno, 'id_curso' => $id_curso, 'Presente' => $presente, 'Justificada' => $justificada, 'Fecha' => $fecha]);
                }
            }
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $asistencia)
    {

    }
}
