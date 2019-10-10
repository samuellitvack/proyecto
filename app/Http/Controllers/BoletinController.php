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
        }else{
            $cursando = DB::table('table_cursando')->where('id_alumno', $id_alumno[0]['id'])->where('id_curso', $id_curso[0]['id'])->count();
            if($cursando == 0){
                return response()->json(['error' => true, 'mensaje' => 'No se encontraron resultados']);
            }
        }

        $notas = DB::select(DB::raw("SELECT table_materias.Nombre as Nombre_materia, table_nota.* FROM table_nota INNER JOIN table_materias ON table_nota.id_mat = table_materias.id  WHERE table_nota.id_alumno = ".$id_alumno[0]['id']." AND table_nota.id_curso = ".$id_curso[0]['id']));

        $alumno = DB::select(DB::raw('SELECT table_alumnos.DNI as DNI_alumno, table_alumnos.Nombre as Nombre_alumno, table_alumnos.Apellido as Apellido_alumno FROM table_alumnos WHERE table_alumnos.id = '.$id_alumno[0]['id']));

        $curso = DB::select(DB::raw('SELECT table_cursos.Nivel as Curso_nivel, table_cursos.Division as Curso_division, table_cursos.Año as Curso_año FROM table_cursos WHERE table_cursos.id = '.$id_curso[0]['id']));

        $inasistencia = Asistencia::select('id')->where('id_alumno', $id_alumno[0]['id'])->where('id_curso', $id_curso[0]['id'])->where('Presente', '0')->count();

        $justificada = Asistencia::select('id')->where('id_alumno', $id_alumno[0]['id'])->where('id_curso', $id_curso[0]['id'])->where('Justificada', '1')->count();

        $pdf = PDF::loadView('boletin.pdf', compact('notas', 'alumno', 'curso', 'inasistencia', 'justificada'));
        return $pdf->download('boletin_'.$request->get('DNI').'.pdf');
    }
}
