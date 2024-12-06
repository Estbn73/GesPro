
<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f0f2f5;">
    <div class="card shadow" style="width: 400px; border-radius: 15px;">
        <div class="card-body">
            <h3 class="text-center mb-4" style="color: #4a90e2;">Iniciar Sesión</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border-radius: 10px;">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border-radius: 10px;">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Recuérdame</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" style="background-color: #4a90e2; border: none; border-radius: 10px;">Iniciar Sesión</button>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center mt-3">
                        <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #4a90e2;">¿Olvidaste tu contraseña?</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
