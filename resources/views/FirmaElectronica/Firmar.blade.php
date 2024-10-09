@extends('layouts.app')

@section('content')
<div class="card text-white bg-primary border-primary mb-3" style="max-width: 100rem;">
    <div class="card-header">Firma Electronica</div>

    <div class="card-body bg-light text-black">
        @if ((isset($errors)) && strlen($errors) >= 10)
        <div class="alert alert-danger">
            <ul>
                <li>{{ $errors }}</li>
            </ul>
        </div>
        @endif
        
        <!-- Ajuste del formulario -->
        <form action="{{ route('FirmarDoc', ['id' => $document->id]) }}" method="post" enctype="multipart/form-data">
        @csrf

        <p><b>{{ $type->name }} Número: </b> {{ $document->number }}</p>
        <p><b>Descripción:</b> {{ $document->name }}</p>

        <div class="form-group">
            <label for="formFile" class="form-label mt-4">Certificado P12s o PFX</label>
            <input class="form-control" type="file" id="formFile" name="p12">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label mt-4">Contraseña del Certificado</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="senha">
        </div>

        <!-- Eliminar sección de elección de página y posición de firma, ya que no se usa actualmente -->
        </br>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Firmar</button>
            <a href="{{ route('VincularCarpeta', ['id' => $id]) }}" class="btn btn-danger" title="Editar">Continuar sin firma electrónica
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div> 

        </form>
    </div>
</div>
@endsection
