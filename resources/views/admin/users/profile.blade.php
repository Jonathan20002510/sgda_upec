@extends('layouts.app')

@section('content')
<div class="card text-white bg-primary border-primary mb-3" style="max-width: 100rem;">
    <div class="card-header">Mi Perfil</div>

    <div class="card-body bg-light text-black">
        @if (session('notification'))
            <div class="alert alert-success">
                {{ session('notification') }}
            </div>
        @endif

        @if (count ($errors) > 0)
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
                <!-- Primera columna -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Tratamiento o Título</label>
                        <select class="rounded form-select" id="exampleSelect1" name="treatment">
                            @foreach ($treatments as $treatment )
                                <option value="{{ $treatment->id }}" @if ($treatment->id == $user->treatment_id) selected @endif> 
                                    {{ $treatment->name }} 
                                </option>   
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label mt-4" for="inputDefault">Número de Cédula</label>
                        <input type="text" class="form-control" placeholder="Inserte Número de Cédula" id="inputDefault" name="identification" 
                            value="{{ old('identification', $user->identification) }}" minlength="10" maxlength="10" 
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label mt-4" for="inputDefault">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Inserte Apellidos" id="inputDefault" name="apellidos" 
                            value="{{ old('apellidos', $user->lastname) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                </div>

                <!-- Segunda columna -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label mt-4" for="inputDefault">Nombres</label>
                        <input type="text" class="form-control" placeholder="Inserte Nombres" id="inputDefault" name="nombres" 
                            value="{{ old('nombres', $user->name) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label mt-4" for="inputDefault">Correo Electrónico</label>
                        <input type="email" class="form-control" placeholder="Inserte Correo Electrónico" id="inputDefault" name="email" 
                            value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label mt-4" for="inputDefault">Contraseña <em> Ingresar solo en caso de que desee modificarse</em></label>
                        <input type="password" class="form-control" placeholder="Inserte Contraseña" id="inputDefault" name="contrasena">
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div> 
        </form>
    </div>
</div>
@endsection
