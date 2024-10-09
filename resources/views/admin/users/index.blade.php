@extends('layouts.app')

@extends('librerias.DataTable')

@section('content')
<div class="card text-white bg-primary border-primary mb-3" style="max-width: 100rem;">
    <div class="card-header">Registro de Usuarios</div>
    <div class="card-body bg-light text-black">
        @if (session('notification'))
        <div class="alert alert-success">
            {{ session('notification') }}
        </div>
        @endif
        
        <!-- Botón para abrir el modal -->
        <div class="text-right mb-4">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                <i class="fas fa-plus fa-1x"></i> Nuevo Usuario
            </button>
        </div>
        
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Contenido del modal -->
                <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title text-dark">Crear Nuevo Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Formulario -->
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleSelect1" class="form-label mt-2">Tratamiento o Título</label>
                                        <select class="form-control" id="exampleSelect1" name="treatment">
                                            @foreach ($treatments as $treatment)
                                            <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="inputDefault">Número de Cédula</label>
                                        <input type="text" class="form-control" placeholder="Inserte Número de Cédula" 
                                        id="inputDefault" name="identification" value="{{ old('identification') }}" minlength="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="apellidos">Apellidos</label>
                                        <input type="text" class="form-control" placeholder="Inserte Apellidos" id="apellidos" 
                                        name="apellidos" value="{{ old('apellidos') }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="nombres">Nombres</label>
                                        <input type="text" class="form-control" placeholder="Inserte Nombres" id="nombres" 
                                        name="nombres" value="{{ old('nombres') }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label mt-2" for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" placeholder="Inserte Correo Electrónico" id="email" 
                                name="email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label mt-2" for="contrasena">Contraseña</label>
                                <input type="text" class="form-control" placeholder="Inserte Contraseña" id="contrasena" 
                                name="contrasena" value="{{ old('contrasena', Str::random(10)) }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="departamento">Departamento al que pertenece</label>
                                        <select class="form-control" id="departamento" name="departamento">
                                            @foreach ($departaments as $departament)
                                            <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="position">Cargo que desempeña</label>
                                        <select class="form-control" id="position" name="position">
                                            @foreach ($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            @if (auth()->user()->rol == 0)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="rol">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <b>Asignar privilegios de Administradorr</b>
                                </label>
                            </div>
                            @endif

                            <br>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                        </form>

                       
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de usuarios -->
        <table id="DataTable" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th>Departamento</th>
                    <th>Cargo</th>
                    <th>Rol</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->identification }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->departament_name }}</td>
                    <td>{{ $user->position_name }}</td>
                    @php
                        $roles = array("Super Administrador", "Administrador", "Jefe de Departamento", "Funcionario");
                    @endphp
                    <td>{{ $roles[$user->rol + 1] }}</td>
                    @if ($user->deleted_at)
                    <td>
                        @if ($user->id != 1)
                        <a href="{{ route('restore.user', $user->id) }}" class="btn btn-success btn-sm" title="Restaurar">
                            <i class="fas fa-recycle"></i>
                        </a>
                        @endif
                    </td>
                    @else
                    <td>
                        @if ($user->id != 1)
                        <a href="{{ route('edit.user', $user->id) }}" class="btn btn-primary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('deleted.user', $user->id) }}" class="btn btn-danger btn-sm" title="Inactivar">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    @if (count($errors) > 0)
        $('#myModal').modal('show');
    @endif
</script>
@endsection
