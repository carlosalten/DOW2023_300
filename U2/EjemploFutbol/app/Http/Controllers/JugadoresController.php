<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Equipo;
use Illuminate\Http\Request;

class JugadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jugadores = Jugador::orderBy('apellido')->orderBy('nombre')->get();
        return view('jugadores.index',compact('jugadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::orderBy('nombre')->get();
        return view('jugadores.create',compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jugador = new Jugador();
        $jugador->rut = $request->rut;
        $jugador->apellido = $request->apellido;
        $jugador->nombre = $request->nombre;
        $jugador->numero_camiseta = $request->numero_camiseta;
        $jugador->posicion = $request->posicion;
        $jugador->equipo_id = $request->equipo;
        $jugador->save();
        return redirect()->route('jugadores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jugador $jugador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jugador $jugador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jugador $jugador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jugador $jugador)
    {
        //
    }
}
