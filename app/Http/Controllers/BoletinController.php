<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\Curso;
use App\Asistencia;
use PDF;
use Carbon;
use DB;

class BoletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('boletin.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download(Request $request){
        $buscar_alumno = Alumno::select('id')->where('DNI', $request->get('DNI'))->count();

        $buscar_curso = Curso::select('id')->where('Nivel', $request->get('Nivel'))->where('Division', $request->get('Division'))->where('Año', $request->get('Anio'))->count();

        $id_alumno = Alumno::select('id')->where('DNI', $request->get('DNI'))->get();

        $id_curso = Curso::select('id')->where('Nivel', $request->get('Nivel'))->where('Division', $request->get('Division'))->where('Año', $request->get('Anio'))->get();


        if($buscar_alumno == 0 || $buscar_curso == 0){
            return response()->json(['error' => true, 'mensaje' => 'No se encontraron resultados']);
        }

        $notas = DB::select(DB::raw("SELECT table_materias.Nombre as Nombre_materia,table_alumnos.Nombre as Nombre_alumno, table_alumnos.Apellido as Apellido_alumno, table_alumnos.DNI as DNI_alumno, table_nota.* FROM table_alumnos INNER JOIN table_nota ON table_alumnos.id = table_nota.id_alumno INNER JOIN table_materias ON table_nota.id_mat = table_materias.id  WHERE table_nota.id_alumno = ".$id_alumno[0]['id']." AND table_nota.id_curso = ".$id_curso[0]['id']));

        if(!$notas){
            return response()->json(['error' => true, 'mensaje' => 'No se encontraron resultados 2']);
        }

        $asistencias = Asistencia::select('Presente', 'Justificada', 'Fecha')->where('id_alumno', $id_alumno)->where('id_curso', $id_curso)->get();

        /*
        $pdf = PDF::loadView('boletin.pdf', compact('notas', 'asistencias', 'materias'));
                */
        $arreglo = Curso::all();
        $pdf = PDF::loadView('boletin.pdf', compact('arreglo'));

        return $pdf->download('boletin_'.$request->get('DNI').'.pdf');
    }
}
