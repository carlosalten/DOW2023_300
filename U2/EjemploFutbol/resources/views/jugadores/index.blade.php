@extends('templates.master')

@section('hojas-estilo')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido-principal')
{{-- titulo --}}
<div class="row mt-2">
    <div class="col-8">
        <h3>Jugadores</h3>
        <p>Lista de todos los jugadores ingresados</p>
    </div>
    <div class="col-4 d-flex align-items-center justify-content-end">
        <a href="{{route('jugadores.create')}}" class="btn btn-success">Agregar Jugador</a>
    </div>
</div>

{{-- tabla --}}
<div class="row">
    <div class="col">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>RUT</th>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>Camiseta</th>
                    <th>Posición</th>
                    <th>Equipo</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jugadores as $num=>$jugador)
                <tr>
                    <td class="align-middle">{{$num+1}}</td>
                    <td class="align-middle">{{$jugador->rut}}</td>
                    <td class="align-middle">{{$jugador->apellido}}</td>
                    <td class="align-middle">{{$jugador->nombre}}</td>
                    <td class="align-middle">{{$jugador->numero_camiseta}}</td>
                    <td class="align-middle">{{$jugador->posicion}}</td>
                    <td class="align-middle">{{$jugador->equipo->nombre}}</td>
                    <td>
                        <form method="POST" action="{{route('jugadores.destroy',$jugador->rut)}}">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger" type="submit">
                                <span class="material-icons">delete</span>
                            </button>
                        </form>
                    </td>
                    <td>
                        {{-- <a href="{{route('jugadores.destroy',$jugador->rut)}}" class="btn btn-sm btn-danger pb-0" data-bs-toggle="tooltip" data-bs-title="Borrar Jugador">
                        <span class="material-icons">delete</span>
                        </a> --}}

                        <a href="{{route('jugadores.edit',$jugador->rut)}}" class="btn btn-sm btn-warning pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Editar Jugador">
                            <span class="material-icons">edit</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- volver --}}
<div class="row">
    <div class="col text-end">
        <a href="#" class="btn btn-warning">Volver a Equipos</a>
    </div>
</div>
@endsection

@section('scripts-rteferencias')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
@endsection

@section('scripts-manual')
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

</script>
@endsection
