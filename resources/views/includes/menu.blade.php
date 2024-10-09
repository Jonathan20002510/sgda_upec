@if (auth()->check())
    <!-- Inicio SuperAdmin -->
    @if(auth()->user()->is_superadmin)
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm py-2" style="background-color: #2f3532;">
        <div class="container-fluid">
            <!-- Menú izquierdo con las opciones principales -->
            <div class="d-flex">
                <ul class="nav">
                    <li class="nav-item">
                        <a @if (request()->is('Dashboard')) class="nav-link active text-white" style="background-color: #00695c;" 
                           @else class="nav-link text-white" @endif href="{{ route('Dashboard') }}">Panel</a>
                    </li>
                    <li class="nav-item">
                        <a @if (request()->is('usuarios')) class="nav-link active text-white" style="background-color: #00703C;" 
                           @else class="nav-link text-white" @endif href="{{ url('/usuarios') }}">Gestión de Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a @if (request()->is('departamentos')) class="nav-link active text-white" style="background-color: #00703C;" 
                           @else class="nav-link text-white" @endif href="{{ url('/departamentos') }}">Gestionar Departamentos</a>
                    </li>
                    <li class="nav-item">
                        <a @if (request()->is('carpetas')) class="nav-link active text-white" style="background-color: #00796b;" 
                           @else class="nav-link text-white" @endif href="{{route('carpetas.indexs')}}">Gestionar Carpetas</a>
                    </li>
                    <li class="nav-item">
                        <a @if (request()->is('/Documentos')) class="nav-link active text-white" style="background-color: #00796b;" 
                           @else class="nav-link text-white" @endif href="{{ route('MostrarDocumentos', 1) }}">Buscar en Repositorio</a>
                    </li>
                </ul>
            </div>

            <!-- Menú derecho con "Otras Configuraciones" -->
            <div class="ms-auto">
                <ul class="nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" @if (request()->is('cargos') or request()->is('tratamientos')) 
                           style="background-color: #00695c;" @else class="text-white" @endif 
                           data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Otras Configuraciones</a>
                        <ul class="dropdown-menu dropdown-menu-end" style="background-color: #343a40;">

                            <li><a class="dropdown-item text-white" href="{{route('tipe.doc')}}">Agregar tipos de documentos</a></li>
                            <li><a class="dropdown-item text-white" href="{{route('add.cargo')}}">Agregar Cargo</a></li>
                            <li><a class="dropdown-item text-white" href="{{route('trato.honor')}}">Agregar Tratamientos o Títulos Académicos</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Menú para otros usuarios no superadmin -->
    @else
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm py-2" style="background-color: #343a40;">
        <div class="container-fluid">
            <!-- Menú izquierdo con las opciones principales -->
            <div class="d-flex">
                <ul class="nav">
                    <!-- Enviar Documentos Dropdown -->
                    
                    <li class="nav-item">
                        <a @if (request()->is('Recibidos')) class="nav-link active text-white" style="background-color: #00796b;" 
                           @else class="nav-link text-white" @endif href="{{ url('/Recibidos') }}">Documentos Recibidos</a>
                    </li>
                    <li class="nav-item">
                        <a @if (request()->is('Enviados')) class="nav-link active text-white" style="background-color: #00796b;" 
                           @else class="nav-link text-white" @endif href="{{ url('/Enviados') }}">Documentos Enviados</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                            Enviar
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" style="background-color: #343a40;">
                            <li><a class="dropdown-item text-white" href="{{route('FormularioEnvia')}}">Subir Documento</a></li>
                            <li><a class="dropdown-item text-white" href="{{route('edit.redacta')}}">Redactar Documento</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a @if (request()->is('/Documentos')) class="nav-link active text-white" style="background-color: #00796b;" 
                           @else class="nav-link text-white" @endif href="{{ route('MostrarDocumentos', 1) }}">Buscar en Repositorio</a>
                    </li>
                    
                    @if (auth()->user()->is_DepartamentBoss)
                    <li class="nav-item">
                        <a @if (request()->is('carpetas')) class="nav-link active text-white" style="background-color: #00796b;" 
                           @else class="nav-link text-white" @endif href="{{route('carpetas.indexs')}}">Gestionar Carpetas</a>
                    </li>
                    @if (auth()->user()->is_admin)
                    <li class="nav-item">
                        <a @if (request()->is('departamentos')) class="nav-link active text-white" style="background-color: #00703C;" 
                           @else class="nav-link text-white" @endif href="{{ url('/departamentos') }}">Gestionar Departamentos</a>
                    </li>
                    @endif
                    
                    
                    <li class="nav-item">
                        <a @if (request()->is('DescargarCopia')) class="nav-link active text-white" style="background-color: #00796b;" 
                           @else class="nav-link text-white" @endif href="{{route('copia.seguridad')}}">Descargar copias de información</a>
                    </li>

                    
                    @endif
                    
                    @if (auth()->user()->is_admin)
                    <li class="nav-item">
                        <a @if (request()->is('usuarios')) class="nav-link active text-white" style="background-color: #00796b;" 
                           @else class="nav-link text-white" @endif href="{{ url('/usuarios') }}">Gestionar Usuarios</a>
                    </li>
                    
                    @endif
                </ul>


                
            </div>


             <!-- Menú derecho con "Otras Configuraciones" -->
             @if (auth()->user()->is_admin)
             <div class="ms-auto">
                <ul class="nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" @if (request()->is('cargos') or request()->is('tratamientos')) 
                           style="background-color: #00695c;" @else class="text-white" @endif 
                           data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Otras Configuraciones</a>
                        <ul class="dropdown-menu dropdown-menu-end" style="background-color: #343a40;">

                            <li><a class="dropdown-item text-white" href="{{route('tipe.doc')}}">Agregar tipos de documentos</a></li>
                            <li><a class="dropdown-item text-white" href="{{route('add.cargo')}}">Agregar Cargo</a></li>
                            <li><a class="dropdown-item text-white" href="{{route('trato.honor')}}">Agregar Tratamientos o Títulos Académicos</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            @endif
        </div>
    </nav>
    @endif
@endif

<style>
    .dropdown-menu {
        background-color: #343a40;
    }

    .dropdown-item {
        color: white;
    }

    .dropdown-item:hover {
        background-color: rgb(52, 50, 50);
        color: #343a40;
    }
</style>
