<?php

namespace gesaca\Http\Controllers;

use gesaca\Model\Matricula;
use Illuminate\Http\Request;
use gesaca\Http\Resources\Matricula as MatriculaResource;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return MatriculaResource::collection(Matricula::All());
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
        $matricula = Matricula::create($request->All());
        return new MatriculaResource($matricula);
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
        $matricula = Matricula::where("IdMatricula", $id)->first();
        return new MatriculaResource($matricula);
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
        $matricula = Matricula::where("IdMatricula", $id)->first();
        if ($matricula) {
            $matricula->IdPersona = $request->input("IdPersona") == "" ? $matricula->IdPersona : $request->input("IdPersona");
            $matricula->IdNivel = $request->input("IdNivel") == "" ? $matricula->IdNivel : $request->input("IdNivel");
            $matricula->IdAnio = $request->input("IdAnio") == "" ? $matricula->IdAnio : $request->input("IdAnio");
            $matricula->Grado = $request->input("Grado") == "" ? $matricula->Grado : $request->input("Grado");   
            $matricula->Seccion = $request->input("Seccion") == "" ? $matricula->Seccion : $request->input("Seccion");   
            $matricula->Nota = $request->input("Nota") == "" ? $matricula->Nota : $request->input("Nota");       
            //$request->All()
            $matricula->save();
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
        $matricula = Matricula::where("IdMatricula", $id)->first();        
        if ($matricula)
            $matricula->delete(); 
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
