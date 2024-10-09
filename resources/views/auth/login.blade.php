@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex flex-column justify-content-center align-items-center position-relative">
    <!-- Video de fondo -->
    <video autoplay loop muted playsinline class="position-absolute w-100 h-100" style="object-fit: cover; z-index: -1; opacity: 0.5;">
        <source src="{{ asset('videos/fondo.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Contenedor del formulario -->
    <div class="shadow-lg rounded p-5" style="background-color: rgba(255, 255, 255, 0.85); width: 100%; max-width: 450px; backdrop-filter: blur(5px);">
        <div class="text-center mb-4">
            <h2 class="h4 font-weight-bold text-primary">Universidad Politécnica Estatal del Carchi</h2>
            <h3 class="h6 font-weight-bold text-muted">{{ __('Bienvenido al Sistema Documental UPEC') }}</h3>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Ingrese su correo electrónico">
                @error('email')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Ingrese su contraseña">
                @error('password')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
            <div class="form-group form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ __('Recordarme en este equipo') }}</label>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button type="submit" class="btn btn-primary btn-lg px-4">{{ __('Ingresar') }}</button>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-muted small">{{ __('¿Olvidó su contraseña?') }}</a>
                @endif
            </div>
        </form>
    </div>
</div>

<style>
    /* Estilos adicionales para mejorar la apariencia del login */
    .form-control {
        border-radius: 30px;
        padding: 10px 15px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #00796b;
        box-shadow: none;
    }

    .btn-primary {
        background-color: #00796b;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #005f56;
    }

    /* Ajustes de tamaño para pantallas pequeñas */
    @media (max-width: 575.98px) {
        .shadow-lg {
            padding: 20px;
        }
    }
</style>
@endsection
