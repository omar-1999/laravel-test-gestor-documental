@extends('layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title pb-4">Crear Documento</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                @if ($errors->all())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
            </h6>
            <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="formFile" class="form-label">Nombre del Documento</label>
                    <input class="form-control" name="nombre" type="text" placeholder="Nombre">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">&Aacute;rea del Documento</label>
                    <select name="area_id" class="form-select">
                        <option selected value="">Seleccione...</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">C&oacute;digo del Documento</label>
                    <input class="form-control" name="codigo" type="text" placeholder="C&oacute;digo">
                </div>
                <div class="mb-5">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" name="nombre_archivo" type="file" id="formFile">
                </div>
                <hr class="dropdown-divider">
                <div class="row">
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('index') }}">
                            <button type="button" class="btn btn-danger">Cancelar</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
