@extends('templates.master')

@section('hojas-estilo')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido-principal')
<div class="row">
    <div class="col">
        <h3>Equipos</h3>
        {{-- <h3>{{ Route::current()->getName() }}</h3> --}}
    </div>
</div>

<div class="row">
    <!-- tabla -->
    <div class="col-12 @if(Gate::allows('usuarios-listar')) col-lg-8 @endif order-last order-lg-first">
        <table class="table table-bordered table-striped table-hover">
            <thead>
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
                    <td class="align-middle">{{ $num+1 }}</td>
                    <td class="align-middle">{{ $equipo->nombre }}</td>
                    <td class="align-middle">{{ $equipo->entrenador }}</td>
                    <td>{{ count($equipo->jugadores) }}</td>
                    <td>
                        <div class="row">
                            @if(Gate::allows('usuarios-modificar'))
                            {{-- Borrar --}}
                            <div class="col text-end">
                                <form method="POST" action="{{route('equipos.destroy',$equipo->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </form>
                            </div>
                            {{-- Editar --}}
                            <div class="col text-center">
                                <a href="{{route('equipos.edit',$equipo->id)}}" class="btn btn-sm btn-warning pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Editar {{ $equipo->nombre }}">
                                    <span class="material-icons">edit</span>
                                </a>
                            </div>
                            {{-- Ver detalle --}}
                            <div class="col">
                                <a href="{{route('equipos.show',$equipo->id)}}" class="btn btn-sm btn-info pb-0 text-white position-relative" data-bs-toggle="tooltip" data-bs-title="Ver {{ $equipo->nombre }}">
                                    <span class="material-icons">group</span>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        {{ count($equipo->jugadores) }}
                                    </span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- form agregar equipo -->
    <div class="col-12 col-lg-4 order-first order-lg-last">
        @if(Gate::allows('usuarios-listar'))
        <div class="card">
            <div class="card-header bg-dark text-white">Agregar Equipo</div>
            <div class="card-body">
                {{-- errores --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Por favor solucione los siguientes problemas:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- form --}}
                <form method="POST" action="{{route('equipos.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value=" {{ old('nombre') }}">
                    </div>
                    <div class="mb-3">
                        <label for="entrenador" class="form-label">Entrenador</label>
                        <input type="text" id="entrenador" name="entrenador" class="form-control @error('entrenador') is-invalid @enderror" value="{{ old('entrenador') }}">
                    </div>
                    <div class="mb-3 d-grid gap-2 d-lg-block">
                        <button class="btn btn-warning" type="reset">Cancelar</button>
                        <button class="btn btn-success" type="submit">Agregar Equipo</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
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
