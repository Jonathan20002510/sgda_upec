@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg rounded">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">{{ __('Panel de Control') }}</h3>
                </div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h4 class="mb-4">Bienvenido al Sistema Documental de la UPEC</h4>
                    <p class="text-muted">Aquí puedes gestionar toda la documentación de la universidad con facilidad y eficiencia.</p>
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary mt-3">Ir al Panel de Control</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
