@extends('layouts.app')
@extends('librerias.select2')

@section('content')
<div class="container mt-4">
    <div class="card border-success mb-3">
        <!-- Cambié el color de fondo del encabezado a #00703C -->
        <div class="card-header" style="background-color: #00703C; color: white;">Editor de Texto</div>
        <div class="card-body bg-light">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" class="form-label">Tipo de Documento</label>
                            <select class="form-select" id="type" name="type">
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="number" class="form-label">Número de Documento <em>(Si este campo se deja vacío se asignará un número automáticamente)</em></label>
                            <input type="text" class="form-control" placeholder="Inserte un Número de Documento" id="number" name="number" value="{{ old('number') }}" minlength="1" maxlength="4" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div>

                        <div class="form-group mt-3">
                            <label for="nombre" class="form-label">Descripción del Documento</label>
                            <input type="text" class="form-control" placeholder="Inserte una breve descripción" id="nombre" name="nombre" value="{{ old('nombre') }}">
                        </div>
                    </div>

                    <!-- Segunda columna -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="receptor" class="form-label">Para:</label>
                            <select class="form-select select2" id="receptor" name="receptor[]" multiple="multiple">
                                <!-- Opciones dinámicas -->
                                @if($users->count() > 1)
                                <optgroup label="{{ $MiDepartamento->name }}">
                                    <option value="{{ -$MiDepartamento->id }}"> Todo el departamento de {{ $MiDepartamento->name }} </option>
                                    @foreach ($users as $user)
                                    @if($user->id != Auth::user()->id)
                                    <option value="{{ $user->id }}">{{ $user->treatment_abbreviation }}. {{ $user->lastname }} {{ $user->name }} - {{ $user->position_name }} DE {{ strtoupper($user->departament_name) }}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
                                @endif

                                <!-- Más opciones -->
                                <!-- Agrega lógica adicional aquí para los departamentos superiores e inferiores -->
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="objeto" class="form-label">Objeto/Asunto</label>
                            <input type="text" class="form-control" placeholder="Inserte Objeto del documento" id="objeto" name="objeto" value="{{ old('objeto') }}">
                        </div>
                    </div>
                </div>

                <!-- CKEditor para el cuerpo del documento -->
                <div class="form-group mt-4">
                    <label for="cuerpo" class="form-label">Cuerpo</label>
                    <textarea cols="80" id="cuerpo" name="cuerpo" rows="10">{{ old('cuerpo') }}</textarea>
                </div>

                <!-- Botón para Anexos -->
                <!-- Botón para Anexos
                <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#exampleModal">Anexos</button>
                         -->
                <!-- Botón de enviar -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Anexos -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Anexar Documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para anexar -->
                <div class="form-group">
                    <label for="nombreAnexo">Nombre del Anexo</label>
                    <input type="text" class="form-control" id="nombreAnexo" name="nombreAnexo[]">
                </div>
                <div class="form-group">
                    <label for="Anexo">Archivo</label>
                    <input type="file" name="Anexo[]" class="form-control" id="Anexo">
                </div>
                <button class="btn btn-success mt-2" type="button">Añadir</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('ck-editor-CDN')
<!-- Actualiza CKEditor a la última versión -->
<script src="https://cdn.ckeditor.com/4.22.0/full/ckeditor.js"></script>
@endsection

@section('ck-editor')
<script>
    // Reemplazar el textarea con CKEditor y ocupar el 100% del ancho
    CKEDITOR.replace('cuerpo', {
        width: '100%',  // Ocupar todo el ancho disponible
        height: 400,    // Ajusta la altura si es necesario
        removeButtons: 'PasteFromWord,ExportPdf,Print,Save,NewPage,Preview,Source,DocProps'
    });
</script>
@endsection
