<?php

namespace App\Http\Controllers;

use App\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Materia::select('id', 'Nombre')->get();
        return $materias;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("materias.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validar = Validator::make($request->all(), ['Nombre'=>'required']);

        if($validar->fails()){
            $errores = $validar->errors();
            return response()->json(['error' => true, 'mensaje' => $errores->all()]);
        }else{
            $materia = new Materia();
            $materia->Nombre = $request->get('Nombre');

            $existe = DB::table('table_materias')->where('Nombre', $request->get('Nombre'))->count();

            if($existe > 0){
                $mensaje = ['Esta materia ya existe'];
                return response()->json(['error' => true, 'mensaje' => $mensaje]);
            }else{
                $materia->save();
                return response()->json(['error' => false, 'mensaje' => 'Materia cargada correctamente', 'ultimoid' => $materia->id]);
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit(Materia $materia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validar = Validator::make($request->all(), ['Nombre'=>'required']);

        if($validar->fails()){
            $errores = $validar->errors();
            return response()->json(['error' => true, 'mensaje' => $errores->all()]);
        }else{
            $materia = Materia::find($request->get('id'));
            $materia->Nombre = $request->get('Nombre');

            $existe = DB::table('table_materias')->where('Nombre', $request->get('Nombre'))->count();

            if($existe > 0){
                $mensaje = ['Esta materia ya existe'];
                return response()->json(['error' => true, 'mensaje' => $mensaje]);
            }else{
                $materia->save();
                return response()->json(['error' => false, 'mensaje' => 'Materia modificada correctamente']);
            }
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("table_materiascursos")->where('id_materia', $id)->delete();
        DB::table("table_nota")->where('id_mat', $id)->delete();
        
        $materia = Materia::find($id);
        $materia->delete();
        return response()->json(['mensaje' => 'Materia eliminada correctamente']);
    }
}
