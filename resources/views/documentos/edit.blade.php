@extends('layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title pb-4">Editar Documento</h5>
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
            <form method="POST" action="{{ route('update', [$resp->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="formFile" class="form-label">Nombre del Documento</label>
                    <input class="form-control" name="nombre" type="text" placeholder="Nombre" readonly value="{{ $resp->nombre }}">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">&Aacute;rea del Documento</label>
                    <select name="area_id" class="form-select" disabled="disabled">
                        <option selected value="">{{ $resp->area }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">C&oacute;digo del Documento</label>
                    <input class="form-control" name="codigo" type="text" placeholder="C&oacute;digo" disabled="disabled" value="{{ $resp->codigo }}">
                </div>
                <div class="mb-5">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" name="nombre_archivo" type="file" id="formFile">
                </div>
                <hr class="dropdown-divider">
                <div class="row">
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success">Editar</button>
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
