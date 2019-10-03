<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_curso, $id_alumno)
    {
        $notas = DB::select(DB::raw("SELECT 
  table_materiascursos.*,
  table_materias.Nombre as materia_nombre,
  (select
      table_nota.nota_1
   from table_nota
   where (table_nota.id_curso=table_materiascursos.id_curso) and
         (table_nota.id_mat=table_materiascursos.id_materia) and
         (table_nota.id_alumno=".$id_alumno.")   ) as nota1,
  (select
      table_nota.nota_2
   from table_nota
   where (table_nota.id_curso=table_materiascursos.id_curso) and
         (table_nota.id_mat=table_materiascursos.id_materia) and
         (table_nota.id_alumno=".$id_alumno.")   ) as nota2,
  (select
      table_nota.nota_3
   from table_nota
   where (table_nota.id_curso=table_materiascursos.id_curso) and
         (table_nota.id_mat=table_materiascursos.id_materia) and
         (table_nota.id_alumno=".$id_alumno.")   ) as nota3
FROM table_materiascursos 
INNER JOIN table_materias ON table_materiascursos.id_materia = table_materias.id 
WHERE table_materiascursos.id_curso = ".$id_curso));
        return $notas;
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
    public function update(Request $request)
    {
        $notas = json_decode($request->get('Notas'), true);
        $id_alumno = $request->get('id_alumno');
        foreach($notas as $nota){
            $id_curso = $nota['id_curso'];
            $id_materia = $nota['id_materia'];
            $res = DB::table('table_nota')->where('id_mat', $id_materia)->where('id_curso', $id_curso)->where('id_alumno', $id_alumno)->count();
            if($res > 0){
                DB::table('table_nota')->where('id_alumno', $id_alumno)->where('id_curso', $id_curso)->where('id_mat',$id_materia)->update(['nota_1' => $nota['nota1'], 'nota_2' => $nota['nota2'], 'nota_3' => $nota['nota3']]);
            }else{
                DB::table('table_nota')->insert(['id_alumno' => $id_alumno, 'id_mat' => $id_materia, 'id_curso' => $id_curso, 'nota_1' => $nota['nota1'], 'nota_2' => $nota['nota2'], 'nota_3' => $nota['nota3']]);
            }
        }

        return response()->json(['notas'=>$notas, 'id_alumno'=>$id_alumno]);
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
}
