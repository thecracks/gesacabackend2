<?php

namespace gesaca\Http\Controllers;

use Illuminate\Http\Request;
use gesaca\Model\Nivel;
use gesaca\Http\Resources\Nivel as NivelResource;

class NivelController extends Controller
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
        return NivelResource::collection(Nivel::All());
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
        $nivel = Nivel::create($request->All());
        return new NivelResource($nivel);
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
        $nivel = Nivel::where("IdNivel", $id)->first();
        return new NivelResource($nivel);
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
        $nivel = Nivel::where("IdNivel", $id)->first();
        if ($nivel) {
            $nivel->Descripcion = $request->input("Descripcion") == "" ? $nivel->Descripcion : $request->input("Descripcion");
            $nivel->estado = $request->input("estado") == "" ? $nivel->estado : $request->input("estado");
            
            //$request->All()
            $nivel->save();
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
        $nivel = Nivel::where("IdNivel", $id)->first();        
        if ($nivel)
            $nivel->delete(); 
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
