<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Equipo;
use Illuminate\Http\Request;

class PartidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partidos = Partido::orderByDesc('fecha')->get();
        return view('partidos.index',compact('partidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::orderBy('nombre')->get();
        return view('partidos.create',compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insertar en tabla partido
        //al ejecutar save $partido->id toma valor
        $partido = new Partido();
        $partido->fecha = $request->fecha;
        $partido->estado = $request->estado;
        $partido->save();

        //insertar en tabla de intersección
        $partido->equipos()->attach($request->equipo_local,['es_local'=>true]);
        $partido->equipos()->attach($request->equipo_visita,['es_local'=>false]);

        //vovler a la vista que lista partidos
        return redirect()->route('partidos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partido $partido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partido $partido)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partido $partido)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
 
    }
}
