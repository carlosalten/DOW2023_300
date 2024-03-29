@extends('templates.master')

@section('hojas-estilo')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido-principal')
<div class="row">
    <div class="col">
        <h4>Equipos</h4>
    </div>
</div>

<div class="row">
    <!-- tabla -->
    <div class="col-12 col-lg-8 order-last order-lg-first">
        <table class="table table striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Entrenador</th>
                    <th>Jugadores</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipos as $num=>$equipo)
                <tr>
                    <td>{{ $num+1 }}</td>
                    <td>{{ $equipo->nombre }}</td>
                    <td>{{ $equipo->entrenador }}</td>
                    <td>{{ count($equipo->jugadores) }}</td>
                    <td>
                        <div class="row">
                            <div class="col">
                                <form method="POST" action="{{route('equipos.destroy',$equipo->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" type="submit" data-bs-toggle="tooltip" data-bs-title="Borrar {{ $equipo->nombre }}">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </form>

                            </div>
                            <div class="col">
                                <a href="{{route('equipos.edit',$equipo->id)}}" class="btn btn-sm btn-warning pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Editar {{ $equipo->nombre }}">
                                    <span class="material-icons">edit</span>
                                </a></div>
                            <div class="col">
                                <a href="{{route('equipos.jugadores',$equipo->id)}}" class="btn btn-sm btn-info pb-0 text-white position-relative" data-bs-toggle="tooltip" data-bs-title="Ver {{ $equipo->nombre }}">
                                    <span class="material-icons">group</span>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        {{ count($equipo->jugadores) }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    <!-- form -->
    <div class="col-12 col-lg-4 order-first order-lg-last">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Agregar Equipo
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="entrenador" class="form-label">Entrenador</label>
                        <input type="text" id="entrenador" class="form-control">
                    </div>
                    <div class="mb-3 d-grid gap-2 d-lg-block">
                        <button class="btn btn-warning">Cancelar</button>
                        <button class="btn btn-success">Agregar Equipo</button>
                    </div>
                </form>
            </div>
        </div>
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
