@extends('templates.master')

@section('contenido-principal')
{{-- titulo --}}
<div class="row mt-3">
    <div class="col">
        <h4>Editar Equipo</h4>
    </div>
</div>

{{-- formulario --}}
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Editar {{ $equipo->nombre }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('equipos.update',$equipo->id)}}">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{$equipo->nombre}}">
                    </div>
                    <div class="mb-3">
                        <label for="entrenador" class="form-label">Entrenador</label>
                        <input type="text" id="entrenador" name="entrenador" class="form-control" value="{{$equipo->entrenador}}">
                    </div>
                    <div class="mb-3 d-grid gap-2 d-lg-block">
                        <a href="{{route('equipos.index')}}" class="btn btn-warning">Cancelar</a>
                        <button type="submit" class="btn btn-success">Editar Equipo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
