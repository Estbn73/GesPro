<!doctype html>
<html lang="en">

<head>
    <title>Registro</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{ asset('assets/register.css') }}">
</head>

<body>
    <section class="register-section">
        <div class="register-container">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <h2 class="register-title">Crear una cuenta</h2>
                <p class="register-subtitle">Por favor completa los siguientes campos:</p>

                <!-- Nombre de usuario -->
                <div class="input-group">
                    <label for="name">Nombre de usuario</label>
                    <input type="text" name="name" id="name" placeholder="Ingresa tu nombre de usuario" value="{{ old('username') }}" required />
                    @error('name')
                    <span class="error-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Correo electrónico -->
                <div class="input-group">
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" placeholder="Ingresa tu correo" value="{{ old('email') }}" required />
                    @error('email')
                    <span class="error-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" required />
                    @error('password')
                    <span class="error-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Confirmar contraseña -->
                <div class="input-group">
                    <label for="password-confirm">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" id="password-confirm" placeholder="Confirma tu contraseña" required />
                </div>

                <div class="input-group">
                    <label for="rol">Rol</label>
                    <select name="rol" id="rol" required>
                        <option value="">Selecciona un rol</option>
                        <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="user" {{ old('rol') == 'user' ? 'selected' : '' }}>Usuario</option>
                    </select>
                    @error('rol')
                    <span class="error-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <button type="submit" class="register-button">Registrarse</button>


            </form>
        </div>
    </section>
</body>

</html>