<?php

namespace gesaca\Http\Controllers;

use gesaca\Model\Anio;
use Illuminate\Http\Request;
use gesaca\Http\Resources\Anio as AnioResource;

class AnioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$nivel = Nivel::All();
        //echo $nivel;
        return AnioResource::collection(Anio::All());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function create()
    {
        //
    }
    */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $anio = Anio::create($request->All());
        return new AnioResource($anio);
        //$nivel = Nivel::create($request->all());
        //return new NivelResource($nivel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anio = Anio::where("IdAnio", $id)->first();
        return new AnioResource($anio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit($id)
    {
        //
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function update(Request $request, $id)
    {
        $anio = Anio::where("IdAnio", $id)->first();
        if ($anio) {
            $anio->Fecha = $request->input("Fecha") == "" ? $anio->Fecha : $request->input("Fecha");
            $anio->FechaInicio = $request->input("FechaInicio") == "" ? $anio->FechaInicio : $request->input("FechaInicio");
            $anio->FechaFin = $request->input("FechaFin") == "" ? $anio->FechaFin : $request->input("FechaFin");
            $anio->Descripcion = $request->input("Descripcion") == "" ? $anio->Descripcion : $request->input("Descripcion");
            
            //$request->All()
            $anio->save();
        }
        else {
            return response()->json([
                'code_status' => 0,
                'message' => 'Problema con el identificador',
            ]);
        }
        return response()->json([
            'code_status' => 1,
            'message' => 'Se actualizó correctamente',
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Usar directo delete() o 1° first y luego delete
        $anio = Anio::where("IdAnio", $id)->first();        
        if ($anio)
            $anio->delete(); 
        else
            return response()->json([
                'code_status' => 0,
                'message' => 'Problema al eliminar'
            ]);
        return response()->json([
            'code_status' => 1,
            'message' => 'Se eliminó correctamente.'
        ]);
    }
}
