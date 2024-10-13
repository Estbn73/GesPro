<!doctype html>
<html lang="en">
<head>
    <title>Iniciar Sesión</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{ asset('assets/login.css') }}">
</head>

<body>
    <section class="login-section">
        <div class="login-container">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h2 class="login-title">Iniciar sesión</h2>
                <p class="login-subtitle">Por favor ingresa tu correo y contraseña!</p>

                <!-- Campo de Correo -->
                <div class="input-group">
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" placeholder="Ingresa tu correo" value="{{ old('email') }}" required autocomplete="email" autofocus />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Campo de Contraseña -->
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" required autocomplete="current-password" />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

               

                <!-- Botón de Iniciar Sesión -->
                <button type="submit" class="login-button">Iniciar sesión</button>

             
            </form>
        </div>
    </section>
</body>
</html>
