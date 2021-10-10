@extends('layout')

@section('content')
    <table id="documentos" class="table table-striped" style="width:100%">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Area</th>
                <th scope="col">Opcion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $doc)
                <tr>
                    <th scope="row">{{ $doc->id }}</th>
                    <td>
                      <a href="{{ route('file', [$doc->archivo]) }}" type="button" class="btn btn-light">
                        {{ $doc->codigo }}    
                      </a>
                    </td>
                    <td>{{ $doc->nombre }}</td>
                    <td>{{ $doc->area }}</td>
                    <td>
                      <a href="{{ route('edit', [$doc->id]) }}" type="button" class="btn btn-light">
                        <i class="bi bi-pencil-fill"></i>
                      </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
