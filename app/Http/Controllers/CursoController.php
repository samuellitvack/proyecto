<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::orderBy('Año', 'DESC')->get();
        return $cursos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cursos.index");    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validar = Validator::make($request->all(), ['Nivel' => 'required|integer','Division'=>'required|integer','Año'=>'required|integer']);

        if($validar->fails()){
            $errores = $validar->errors();
            return response()->json(['error' => true, 'mensaje' => $errores->all()]);
        }else{
            $materias = json_decode($request->get('Materias'), true);
            $curso = new Curso();
            $curso->Nivel = $request->get('Nivel');
            $curso->Division = $request->get('Division');
            $curso->Año = $request->get('Año');

            $existe = DB::table('table_cursos')->where('Nivel', $request->get('Nivel'))->where('Division', $request->get('Division'))->where('Año', $request->get('Año'))->count();

            if($existe > 0){
                $mensaje = ['Este curso ya existe'];
                return response()->json(['error' => true, 'mensaje' => $mensaje]);
            }else{
                $curso->save();
                foreach($materias as $materia){
                    DB::table('table_materiascursos')->insert( ['id_curso' => $curso->id, 'id_materia' => $materia['id']] );
                }
                return response()->json(['error' => false, 'mensaje' => 'Curso creado correctamente', 'ultimoid'=>$curso->id]);
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validar = Validator::make($request->all(), ['Nivel' => 'required|integer','Division'=>'required|integer','Año'=>'required|integer']);

        if($validar->fails()){
            $errores = $validar->errors();
            return response()->json(['error' => true, 'mensaje' => $errores->all()]);
        }else{
            $materias = json_decode($request->get('Materias'), true);
            $materias_actual = json_decode(json_encode($this->materias_curso($request->get('id'))), true);
            //$materias_actual = $this->materias_curso($request->get('id'));

            $curso = Curso::find($request->get('id'));
            $curso->Nivel = $request->get('Nivel');
            $curso->Division = $request->get('Division');
            $curso->Año = $request->get('Año');

            $curso->save();
            //Si la materia no está en el curso, se agrega
            foreach($materias as $materia){
                $id = $materia['id'];
                $res = DB::table('table_materiascursos')->where('id_materia', $id)->where('id_curso', $request->get('id'))->count();
                if($res == 0){
                    $res = DB::table('table_materiascursos')->insert(['id_curso' => $request->get('id'), 'id_materia' => $id]);
                }
            }

            //Borrar materia del curso
            foreach($materias_actual as $am){
                $e = 0;
                foreach($materias as $m){
                    if($am['id'] == $m['id']){
                        $e = 1;
                    }
                }

                if($e != 1){
                    DB::table('table_materiascursos')->where('id_materia', $am['id'])->where('id_curso', $request->get('id'))->delete();
                }
            }

            return response()->json(['error' => false, 'mensaje' => 'Curso modificado correctamente']);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("table_cursando")->where('id_curso', $id)->delete();
        DB::table("table_materiascursos")->where('id_curso', $id)->delete();
        DB::table("table_asistencias")->where('id_curso', $id)->delete();
        DB::table("table_nota")->where('id_curso', $id)->delete();

        $curso = Curso::find($id);
        $curso->delete();
        return response()->json(['mensaje' => 'Curso eliminado correctamente']);  
    }

    //Método para agregar o quitar alumnos del curso
    public function alumnos_en_curso(Request $request){
        $alumnos = json_decode($request->get('Alumnos'), true);
        $alumnos_actual = json_decode(json_encode($this->alumnos_curso($request->get('id'))), true);

        //Si el alumno no está en el curso, se agrega
        foreach($alumnos as $alumno){
            $id = $alumno['id'];
            $res = DB::table('table_cursando')->where('id_alumno', $id)->where('id_curso', $request->get('id'))->count();

            if($res == 0){
                $res = DB::table('table_cursando')->insert(['id_curso' => $request->get('id'), 'id_alumno' => $id]);
            }
        }

        //Remover alumno del curso
        foreach($alumnos_actual as $aa){
            $e = 0;
            foreach($alumnos as $alumno){
                if($aa['id'] == $alumno['id']){
                    $e = 1;
                }
            }
            
            if($e != 1){
                DB::table('table_cursando')->where('id_alumno', $aa['id'])->where('id_curso', $request->get('id'))->delete();
            }
        }

        return response()->json(['error' => false, 'mensaje' => 'Alumnos modificados correctamente']);
    }

    //Método que retorna las materias/asignaturas del curso 
    public function materias_curso($id){
        $materias = DB::select(DB::raw("SELECT table_materias.id, table_materias.Nombre FROM table_materias INNER JOIN table_materiascursos ON table_materias.id = table_materiascursos.id_materia WHERE table_materiascursos.id_curso = ".$id));
        return $materias;
    }

    //Método que retorna los alumnos en el curso
    public function alumnos_curso($id){
        $alumnos = DB::select(DB::raw("SELECT table_alumnos.id as id, table_alumnos.DNI as DNI, table_alumnos.Nombre as Nombre, table_alumnos.Apellido as Apellido FROM table_alumnos INNER JOIN table_cursando ON table_cursando.id_alumno = table_alumnos.id WHERE table_cursando.id_curso = ".$id));
        return $alumnos;
    }
}
