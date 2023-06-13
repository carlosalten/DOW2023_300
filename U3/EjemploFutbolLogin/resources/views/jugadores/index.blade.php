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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jugadores as $index => $jugador)
                <tr>
                    <td class="align-middle">{{$index+1}}</td>
                    <td class="align-middle">{{$jugador->rut}}</td>
                    <td class="align-middle">{{$jugador->apellido}}</td>
                    <td class="align-middle">{{$jugador->nombre}}</td>
                    <td class="align-middle">{{$jugador->numero_camiseta}}</td>
                    <td class="align-middle">{{$jugador->posicion}}</td>
                    <td class="align-middle">
                        {{-- {{$jugador->equipo!=null?$jugador->equipo->nombre:'Sin Equipo'}} --}}
                        @if($jugador->equipo!=null)
                        {{$jugador->equipo->nombre}}
                        @else
                        <span class="text-danger">Sin Equipo</span>
                        @endif
                    </td>
                    <td>
                        <!-- Modal -->
                        <div class="modal fade" id="borrarModal{{$jugador->rut}}" tabindex="-1" aria-labelledby="borrarModalLabel{{$jugador->rut}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="borrarModalLabel{{$jugador->rut}}">Confirmación de Borrado</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{route('jugadores.destroy',$jugador->rut)}}">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-body">
                                            ¿Borrar al jugador <span class="text-danger fw-bold">{{$jugador->nombre}} {{$jugador->apellido}}</span> del equipo <span class="fw-bold">{{$jugador->equipo->nombre}}</span>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Borrar Jugador</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- borrar --}}
                            <div class="col text-end">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#borrarModal{{$jugador->rut}}">
                                    <span class="material-icons">delete</span>
                                </button>
                            </div>
                            {{-- <div class="col text-end">
                                <form method="POST" action="{{route('jugadores.destroy',$jugador->rut)}}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">
                                <span class="material-icons">delete</span>
                            </button>
                            </form>
                        </div> --}}
                        {{-- editar --}}
                        <div class="col">
                            <a href="{{route('jugadores.edit',$jugador->rut)}}" class="btn btn-sm btn-warning pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Editar Jugador">
                                <span class="material-icons">edit</span>
                            </a>
                        </div>
    </div>
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

@section('script-referencias')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
@endsection

@section('script-manual')
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

</script>
@endsection
