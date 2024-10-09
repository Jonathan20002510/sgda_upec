@extends('layouts.app')
@extends('librerias.DataTable')

@section('content')

<style>
  .abs-center {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .icon-large {
    font-size: 10rem; /* Aumenta el tamaño de los íconos */
  }

  .bg-custom-primary {
    background-color: #006400;
    color: white;
  }

  .bg-custom-success {
    background-color: #28a745;
    color: white;
  }

  .bg-custom-warning {
    background-color: #FFC107;
    color: black;
  }

  .bg-custom-dark {
    background-color: #FF5722; /* Naranja oscuro */
    color: white;
  }

  .bg-custom-secundary {
    background-color: #004d00; /* Verde oscuro */
    color: white;
  }

  .card-body {
    position: relative;
  }

  .card-text {
    font-size: 1.5rem;
    position: absolute;
    top: 10px;
    right: 18px;
    font-weight: bold;
  }

  .material-symbols-outlined {
    font-size: 15rem; /* Aumenta el tamaño de los íconos */
    display: block;
    margin: 12 auto;
  }
</style>

<!-- Carga de iconos desde Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,200" rel="stylesheet">

<div class="card text-white bg-custom-primary border-primary mb-3" style="max-width: 110rem;">
  <div class="card-header">Panel de Control</div>

  <div class="card-body bg-light text-black">
    <!-- Fila 1: Usuarios y Departamentos -->
    <div class="row">
      <div class="col-sm-6">
        <div class="card bg-custom-success">
          <div class="card-body">
            <h5 class="card-title text-center">Usuarios</h5>
            <p class="card-text">{{ $usuarios }}</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card bg-custom-dark">
          <div class="card-body">
            <h5 class="card-title text-center">Departamentos</h5>
            <p class="card-text">{{ $departamentos }}</p>
          </div>
        </div>
      </div>
    </div>

    <br>

    <!-- Fila 2: Carpetas y Documentos -->
    <div class="row">
      <div class="col-sm-6">
        <div class="card bg-custom-primary">
          <div class="card-body">
            <h5 class="card-title text-center">Carpetas</h5>
            <p class="card-text">{{ $carpetas }}</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card bg-custom-warning">
          <div class="card-body">
            <h5 class="card-title text-center">Documentos</h5>
            <p class="card-text">{{ $documentos }}</p>
          </div>
        </div>
      </div>
    </div>

    <br>
  </div>
</div>

@endsection
