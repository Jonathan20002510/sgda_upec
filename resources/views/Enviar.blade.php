@extends('layouts.app')
@extends('librerias.select2')

@section('content')
<div class="card text-white bg-primary border-primary mb-3 rounded-3" style="max-width: 100rem;">
    <div class="card-header">Enviar Documento</div>

    <div class="card-body bg-light text-black">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error )
                <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Tipo de Documento -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Tipo de Documento</label>
                        <select class="form-select" id="exampleSelect1" name="type">
                            @foreach ($types as $type )
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Número de Documento -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label mt-4" for="inputDefault">Número de Documento <em> (Si este campo se deja vacío se asignará un número automáticamente)</em></label>
                        <input type="text" class="form-control" placeholder="Inserte un Número de Documento" id="inputDefault" name="number" value="{{ old('number') }}" minlength="1" maxlength="4" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Para -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Para:</label>
                        <select class="form-select select2" id="exampleSelect1" name="receptor[]" multiple="multiple">
                            <!-- Opciones de usuarios y departamentos -->
                            @if($users->count() > 1)
                            <optgroup label="{{ $MiDepartamento->name }}">
                                <option value="{{ -$MiDepartamento->id }} ">Todo el departamento de {{ $MiDepartamento->name }}</option>
                                @foreach ($users as $user )
                                @if($user->id != Auth::user()->id)
                                <option value="{{ $user->id }}">{{ $user->treatment_abbreviation }}. {{ $user->lastname }} {{ $user->name }} - {{ $user->position_name }} DE {{ strtoupper($user->departament_name) }}</option>
                                @endif
                                @endforeach
                            </optgroup>
                            @endif
                            <!-- Otros usuarios y departamentos -->
                        </select>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label mt-4" for="inputDefault">Descripción del Documento</label>
                        <input type="text" class="form-control" placeholder="Inserte una breve descripción" id="inputDefault" name="nombre" value="{{ old('nombre') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Subir Archivo PDF -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formFile" class="form-label mt-4">Subir Archivo PDF</label>
                        <input class="form-control" type="file" id="formFile" name="archivo">
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Botones Anexos y Enviar 
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Anexos</button>
                </div>
            -->
                <div class="col-md-6 text-end">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Anexos -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark">Anexar Documentos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Body -->
                <div class="input-group increment">
                    <div class="form-group">
                        <label class="col-form-label mt-4" for="inputDefault">Nombre del Anexo</label>
                        <input type="text" class="form-control" placeholder="Nombre del Documento" name="nombreAnexo[]">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label mt-4" for="inputDefault2">Archivo</label>
                        <input type="file" name="Anexo[]" class="form-control">
                        <br>
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i> Añadir</button>
                            <button class="btn btn-danger" type="button" onclick="limpiar()">Quitar</button>
                        </div>
                    </div>
                </div>

                <div class="clone hide d-none">
                    <div class="control-group input-group" style="margin-top:10px">
                        <div class="form-group">
                            <label class="col-form-label mt-4" for="inputDefault2">Nombre del Anexo</label>
                            <input type="text" class="form-control" placeholder="Nombre del Documento" name="nombreAnexo[]">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label mt-4" for="inputDefault3">Archivo</label>
                            <input type="file" name="Anexo[]" class="form-control">
                            <br>
                            <div class="input-group-btn">
                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Quitar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-success").click(function() {
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });
    });

    function limpiar() {
        document.getElementById('inputDefault2').value = '';
    }
</script>
@endsection
