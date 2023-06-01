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
        $equipos = Equipo::orderBy('nombre')->get();
        $equipoLocal = $partido->equiposConPivot->where('pivot.es_local',true)->first();
        $equipoVisita = $partido->equiposConPivot->where('pivot.es_local',false)->first();
        return view('partidos.edit',compact(['partido','equipos','equipoLocal','equipoVisita']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partido $partido)
    {
        //datos de la tabla partido
        $partido->fecha = $request->fecha;
        $partido->estado = $request->estado;
        $partido->save();

        //datos de la tabla de interseccion
        $equipoLocal = $partido->equiposConPivot->where('pivot.es_local',true)->first();
        $equipoVisita = $partido->equiposConPivot->where('pivot.es_local',false)->first();
        //modificar goles
        $partido->equiposConPivot()->updateExistingPivot($equipoLocal->id,['goles'=>$request->goles_local]);
        $partido->equiposConPivot()->updateExistingPivot($equipoVisita->id,['goles'=>$request->goles_visita]);

        //modificar equipos
        if($equipoLocal->id != $request->equipo_local){
            $partido->equiposConPivot()->updateExistingPivot($equipoLocal->id,['equipo_id'=>$request->equipo_local]);
        }
        if($equipoVisita->id != $request->equipo_visita){
            $partido->equiposConPivot()->updateExistingPivot($equipoVisita->id,['equipo_id'=>$request->equipo_visita]);
        }

        //redireccionar a listado de equipos
        return redirect()->route('partidos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
        $partido->equiposConPivot()->detach();
        $partido->delete();
        return redirect()->route('partidos.index');
    }
}
