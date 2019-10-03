<?php

namespace App\Http\Controllers;

use App\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesores = Profesor::all();
        return $profesores;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("profesores.index");
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
            $profesor = new Profesor();
            $profesor->DNI = $request->get('DNI');
            $profesor->Nombre = $request->get('Nombre');
            $profesor->Apellido = $request->get('Apellido');
            $profesor->Fecha_nac = $request->get('Fecha_nac');
            $profesor->Telefono = $request->get('Telefono');
            $profesor->Direccion = $request->get('Direccion');
            $profesor->Nacionalidad = $request->get('Nacionalidad');

            $existe = DB::table('table_profesores')->where('DNI', $request->get('DNI'))->count();

            if($existe > 0){
                $mensaje = ['El profesor ya se encuentra en el sistema'];
                return response()->json(['error' => true, 'mensaje' => $mensaje]);
            }else{
                $profesor->save();
                return response()->json(['error' => false, 'mensaje' => 'Profesor cargada correctamente', 'ultimoid' => $profesor->id]);
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor $profesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor $profesor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validar = Validator::make($request->all(), ['DNI'=> 'required|integer', 'Nombre'=>'required|alpha', 'Apellido'=>'required|alpha', 'Fecha_nac'=>'required|date', 'Telefono'=>'required', 'Direccion'=>'required', 'Nacionalidad'=>'required']);

        if($validar->fails()){
            $errores = $validar->errors();
            return response()->json(['error' => true, 'mensaje' => $errores->all()]);
        }else{
            $profesor = Profesor::find($request->get('id'));
            $profesor->DNI = $request->get('DNI');
            $profesor->Nombre = $request->get('Nombre');
            $profesor->Apellido = $request->get('Apellido');
            $profesor->Fecha_nac = $request->get('Fecha_nac');
            $profesor->Telefono = $request->get('Telefono');
            $profesor->Direccion = $request->get('Direccion');
            $profesor->Nacionalidad = $request->get('Nacionalidad');

            $profesor->save();
            return response()->json(['error' => false, 'mensaje' => 'Profesor modificado correctamente']);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesor = Profesor::find($id);
        $profesor->delete();
        return response()->json(['mensaje' => 'Profesor eliminado correctamente']);    
    }
}
