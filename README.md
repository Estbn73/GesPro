
# Proyecto de Laravel - Instrucciones para Ejecución

Este archivo `README.md` proporciona una guía paso a paso sobre cómo ejecutar el proyecto de Laravel en su entorno local.
## Requisitos Previos

- **Node.js**: Asegúrate de tener Node.js instalado en tu máquina.
- **Composer**: Necesario para manejar las dependencias de PHP.
- **Git**: Para clonar el repositorio.
- **Entorno de Desarrollo**: Puede usar XAMPP, WAMP, Laragon, o cualquier otro entorno que soporte PHP y MySQL.

## Pasos para Ejecutar el Proyecto

### 1. Clonar el Repositorio
Clona el repositorio del proyecto y accede al directorio:
```bash
git clone https://github.com/Estbn73/GesPro.git
cd GesPro
```

### 2. Instalar dependencias de PHP
Ejecuta el siguiente comando para instalar las dependencias del proyecto:
```bash
composer install
```

### 3. Configurar el archivo `.env`
Copia el archivo de configuración `.env.example` como `.env`:
```bash
cp .env.example .env
```

Edita el archivo `.env` y configura las credenciales de tu base de datos:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_la_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 4. Generar la clave de la aplicación
Genera una clave única para la aplicación:
```bash
php artisan key:generate
```

### 5. Ejecutar las migraciones
Crea las tablas de la base de datos ejecutando las migraciones:
```bash
php artisan migrate
```

### 6. Instalar dependencias de Node.js
Instala las dependencias necesarias para el frontend:
```bash
npm install
```

Instala adicionalmente las extensiones requeridas para FullCalendar:
```bash
npm install @fullcalendar/core @fullcalendar/daygrid @fullcalendar/timegrid
```

### 7. Compilar los assets 
Ejecutar el servidor de node:
```bash
npm run dev
```

### 8. Iniciar el servidor de desarrollo
Inicia el servidor de Laravel:
```bash
php artisan serve
```

Accede a la aplicación en tu navegador en la URL: [http://localhost:8000](http://localhost:8000)

---

### 9. Configurar Recuperacion de contraseña
Se configura el env en la parte de MAIL de acuerdo a tus necesidades