@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card border-success mb-3">
        <div class="card-header" style="background-color: #00703C; color: white;">Guardar documento en Carpeta</div>
        <div class="card-body bg-light">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label"><strong>{{ $type->name }} Número:</strong></label>
                    <p>{{ $document->number }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Descripción:</strong></label>
                    <p>{{ $document->name }}</p>
                </div>

                <!-- Selección de Carpeta Padre -->
                <div class="mb-4">
                    <label for="carpeta" class="form-label">Carpeta Superior</label>
                    <select class="form-select" id="carpeta" name="carpeta">
                        @foreach ($carpetas as $carpeta)
                            @if ($carpeta->deleted_at == NULL)
                                <option value="{{ $carpeta->id }}">&#128193; {{ $carpeta->name }}</option>
                                @php
                                    $hijos = \DB::table('folders AS d1')
                                        ->where('d1.father_folder_id', '=', $carpeta->id)
                                        ->where('d1.departament_id', '=', Auth::user()->departament_id)
                                        ->join('folders AS d2', 'd2.id', '=', 'd1.father_folder_id')
                                        ->join('departaments AS d3', 'd3.id', '=', 'd1.departament_id')
                                        ->select('d1.*', 'd2.name as father_folder', 'd3.name as departament')
                                        ->orderBy('updated_at', 'DESC')
                                        ->get();
                                @endphp
                                @if ($hijos != NULL)
                                    @php
                                        $nivel = 2;
                                    @endphp
                                    @include('admin.folders.tree', ['hijos' => $hijos, 'nivel' => $nivel])
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Radio buttons para documento público -->
                <div class="mb-3 text-center">
                    <label class="form-label">¿Desea hacer este documento público?</label>
                    <div class="d-flex justify-content-center">
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="publico" id="public_si" value="1" @if ($document->public == 1) checked @endif>
                            <label class="btn btn-outline-success" for="public_si" style="width: 80px;">Sí</label>

                            <input type="radio" class="btn-check" name="publico" id="public_no" value="0" @if ($document->public == 0) checked @endif>
                            <label class="btn btn-outline-danger" for="public_no" style="width: 80px;">No</label>
                        </div>
                    </div>
                </div>

                <!-- Botones de guardar y omitir -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary me-2">Guardar</button>
                    <a href="{{ route('Enviados', ['exito' => 1]) }}" class="btn btn-danger">Omitir</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
