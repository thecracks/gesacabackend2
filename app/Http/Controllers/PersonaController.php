<?php

namespace gesaca\Http\Controllers;

use Illuminate\Http\Request;
use gesaca\Model\Persona;
use gesaca\Http\Resources\Persona as PersonaResource;


class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return PersonaResource::collection(Persona::All());
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
        $persona = Persona::create($request->All());
        return new PersonaResource($persona);
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
        $persona = Persona::where("IdPersona", $id)->first();
        return new PersonaResource($persona);
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
        $persona = Persona::where("IdPersona", $id)->first();
        if ($persona) {
            $persona->Nombre = $request->input("Nombre") == "" ? $persona->Nombre : $request->input("Nombre");
            $persona->Materno = $request->input("Materno") == "" ? $persona->Materno : $request->input("Materno");
            $persona->Paterno = $request->input("Paterno") == "" ? $persona->Paterno : $request->input("Paterno");
            $persona->Telefono = $request->input("Telefono") == "" ? $persona->Telefono : $request->input("Telefono");
            $persona->Tipo = $request->input("Tipo") == "" ? $persona->Tipo : $request->input("Tipo");
            $persona->Sub = $request->input("Sub") == "" ? $persona->Sub : $request->input("Sub");            
            //$request->All()
            $persona->save();
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
        $persona = Persona::where("IdPersona", $id)->first();        
        if ($persona)
            $persona->delete(); 
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
