<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    private function verifyToken($token)
    {
        return $token === 'token';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratorios = Laboratorio::all();
        return $laboratorios;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->header('Authorization');
        $token_is_valid = $this->verifyToken($token);
        if($token_is_valid){
            $laboratorio = new Laboratorio();
            $laboratorio->nombre = $request->nombre;
    
            $laboratorio->save();
            return $laboratorio;
        } else {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkStore(Request $request)
    {
        $token = $request->header('Authorization');
        $token_is_valid = $this->verifyToken($token);
        if($token_is_valid){
            $laboratorios = $request->all();
            foreach($laboratorios as $laboratoriojson){
                echo json_encode($laboratoriojson['nombre']);
                $laboratorio = new Laboratorio();
                $laboratorio->nombre = $laboratoriojson['nombre'];
                $laboratorio->save();
            }

            return $laboratorios;
        } else {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laboratorio = Laboratorio::find($id);
        return $laboratorio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $laboratorio = Laboratorio::findOrFail($request->id);
        $laboratorio->nombre = $request->nombre;

        $laboratorio->save();
        return $laboratorio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $laboratorio = Laboratorio::destroy($id);
        return $laboratorio;
    }
}
