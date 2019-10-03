<?php

namespace App\Http\Controllers;

use App\Configuracion;
use Illuminate\Http\Request;
use DB;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = DB::select(DB::raw("SELECT 1c_fecini as primerc_fecini, 1c_fecfin as primerc_fecfin, 2c_fecini as segundoc_fecini, 2c_fecfin as segundoc_fecfin, 3c_fecini as tercerc_fecini, 3c_fecfin as tercerc_fecfin FROM table_configuracion"));
        return json_encode($config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuracion.index');
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
        $primerc_fecini = $request->get('primerc_fecini');
        $primerc_fecfin = $request->get('primerc_fecfin');
        $segundoc_fecini = $request->get('segundoc_fecini');
        $segundoc_fecfin = $request->get('segundoc_fecfin');
        $tercerc_fecini = $request->get('tercerc_fecini');
        $tercerc_fecfin = $request->get('tercerc_fecfin');

        $res = DB::table('table_configuracion')->count();
        if($res > 0){
            DB::table('table_configuracion')->update(['1c_fecini' => $primerc_fecini, '1c_fecfin' => $primerc_fecfin, '2c_fecini' => $segundoc_fecini, '2c_fecfin' => $segundoc_fecfin, '3c_fecini' => $tercerc_fecini, '3c_fecfin' => $tercerc_fecfin]);
        }else{
            DB::table('table_configuracion')->insert(['1c_fecini' => $primerc_fecini, '1c_fecfin' => $primerc_fecfin, '2c_fecini' => $segundoc_fecini, '2c_fecfin' => $segundoc_fecfin, '3c_fecini' => $tercerc_fecini, '3c_fecfin' => $tercerc_fecfin]);
        }
        return response()->json(["mensaje" => "Configuración guardada"]);
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
