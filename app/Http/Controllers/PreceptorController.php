<?php

namespace App\Http\Controllers;

use App\Preceptor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class PreceptorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preceptores = Preceptor::all();
        return $preceptores;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("preceptores.index");
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
            $preceptor = new Preceptor();
            $preceptor->DNI = $request->get('DNI');
            $preceptor->Nombre = $request->get('Nombre');
            $preceptor->Apellido = $request->get('Apellido');
            $preceptor->Fecha_nac = $request->get('Fecha_nac');
            $preceptor->Telefono = $request->get('Telefono');
            $preceptor->Direccion = $request->get('Direccion');
            $preceptor->Nacionalidad = $request->get('Nacionalidad');

            $existe = DB::table('table_preceptores')->where('DNI', $request->get('DNI'))->count();

            if($existe > 0){
                $mensaje = ['El preceptor ya se encuentra en el sistema'];
                return response()->json(['error' => true, 'mensaje' => $mensaje]);
            }else{
                $preceptor->save();
                return response()->json(['error' => false, 'mensaje' => 'Preceptor cargada correctamente', 'ultimoid' => $preceptor->id]);
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Preceptor  $preceptor
     * @return \Illuminate\Http\Response
     */
    public function show(Preceptor $preceptor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Preceptor  $preceptor
     * @return \Illuminate\Http\Response
     */
    public function edit(Preceptor $preceptor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Preceptor  $preceptor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validar = Validator::make($request->all(), ['DNI'=> 'required|integer', 'Nombre'=>'required|alpha', 'Apellido'=>'required|alpha', 'Fecha_nac'=>'required|date', 'Telefono'=>'required', 'Direccion'=>'required', 'Nacionalidad'=>'required']);

        if($validar->fails()){
            $errores = $validar->errors();
            return response()->json(['error' => true, 'mensaje' => $errores->all()]);
        }else{
            $preceptor = Preceptor::find($request->get('id'));
            $preceptor->DNI = $request->get('DNI');
            $preceptor->Nombre = $request->get('Nombre');
            $preceptor->Apellido = $request->get('Apellido');
            $preceptor->Fecha_nac = $request->get('Fecha_nac');
            $preceptor->Telefono = $request->get('Telefono');
            $preceptor->Direccion = $request->get('Direccion');
            $preceptor->Nacionalidad = $request->get('Nacionalidad');

            $preceptor->save();
            return response()->json(['error' => false, 'mensaje' => 'Preceptor modificado correctamente']);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Preceptor  $preceptor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $preceptor = Preceptor::find($id);
        $preceptor->delete();
        return response()->json(['mensaje' => 'Preceptor eliminado correctamente']);    
    }
}
