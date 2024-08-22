# Proyecto Laravel Rick & Morty API

## Descripción General

Este proyecto es una API backend desarrollada en Laravel que se conecta con la API externa de Rick & Morty. Permite a los usuarios autenticarse, registrar sus datos, obtener una lista de personajes de Rick & Morty, gestionar una lista de personajes favoritos y explorar detalles sobre ellos. La API externa de Rick & Morty se utiliza para obtener información sobre los personajes, y el sistema de autenticación de Laravel protege el acceso a las funcionalidades del usuario.

## Tecnologías Utilizadas

- **Laravel 11**
- **PHP 8.2**
- **SQLite** (base de datos por defecto)
- **API externa de Rick & Morty**: [Documentación de la API](https://rickandmortyapi.com/documentation/)
- **Laravel Sanctum**: Paquete para autenticación de tokens

## Instalación

### Requisitos Previos

- **PHP 8.2**
- **Composer** (gestor de dependencias para PHP)

### Pasos de Instalación

1. **Clonar el Repositorio**

    ```bash
    git clone https://github.com/ajp37/Laravel_API.git
    ```

2. **Navegar al Directorio del Proyecto**

    ```bash
    cd Laravel_API
    ```

3. **Instalar Dependencias**

    ```bash
    composer install
    ```

4. **Instalar Laravel Sanctum**

    ```bash
    composer require laravel/sanctum
    ```

5. **Publicar la Configuración de Sanctum**

    ```bash
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    ```

6. **Ejecutar Migraciones**

    ```bash
    php artisan migrate
    ```

7. **Configurar Sanctum**

    Añade `Sanctum` en el archivo `config/auth.php` en la sección de `guards`:

    ```php
    'api' => [
        'driver' => 'sanctum',
        'provider' => 'users',
    ],
    ```

8. **Configurar Variables de Entorno**

    Copia el archivo de ejemplo de variables de entorno y edítalo según sea necesario:

    ```bash
    cp .env.example .env
    ```

    Asegúrate de configurar el archivo `.env` con los parámetros correctos para tu entorno.

9. **Generar la Clave de la Aplicación**

    ```bash
    php artisan key:generate
    ```

10. **Iniciar el Servidor de Desarrollo**

    ```bash
    php artisan serve
    ```

    La aplicación estará disponible en [http://localhost:8000](http://localhost:8000).

## Uso

### Endpoints Principales

- **POST /register**
    - **Descripción**: Registra un nuevo usuario.
    - **Parámetros**: `name`, `email`, `password`, `password_confirmation`
    - **Respuesta Exitosa**: Autentica al usuario registrado y lo redirige a `/favorites`.

- **POST /login**
    - **Descripción**: Autentica a un usuario y devuelve un token de autenticación.
    - **Parámetros**: `email`, `password`
    - **Respuesta Exitosa**: Retorna un token de autenticación. Redirige a `/favorites`.

- **GET /characters**
    - **Descripción**: Muestra un listado de personajes con opciones de filtrado y paginación.
    - **Parámetros**: `page`, `query` (nombre), `status`, `species`, `gender`
    - **Respuesta Exitosa**: Retorna una lista de personajes filtrados y paginados.

- **GET /characters/{id}**
    - **Descripción**: Muestra detalles de un personaje específico por su ID.
    - **Parámetros**: `id` (ID del personaje)
    - **Respuesta Exitosa**: Retorna detalles del personaje.

- **POST /favorites**
    - **Descripción**: Añade un personaje a la lista de favoritos del usuario.
    - **Parámetros**: `character_id`
    - **Respuesta Exitosa**: Mensaje indicando que el personaje fue añadido a favoritos y redirige a `/favorites`.

- **GET /favorites**
    - **Descripción**: Obtiene el listado de personajes que el usuario ha guardado en su lista de favoritos.
    - **Parámetros**: Ninguno: El endpoint no requiere parámetros en la solicitud. La autenticación del usuario se maneja a nivel de sesión o token.
    - **Respuesta Exitosa**: Muestra la lista de favoritos del usuario.

- **DELETE /favorites/{id}**
    - **Descripción**: Elimina un personaje de la lista de favoritos del usuario.
    - **Parámetros**: `id` (ID del personaje)
    - **Respuesta Exitosa**: Mensaje indicando que el personaje fue eliminado de favoritos.

### Probar API desde interfaz
Al acceder a la ruta base (/), redirige a la página de personajes (/characters), donde el usuario puede acceder a los formularios de registro/inicio de sesión, ver el listado de personajes y ver detalles de un personaje en específico. Pulsando en el nombre del personaje el usuario accede a la vista que ofrece informacion de ese personaje en concreto, donde puede añadirlo a favoritos desde un botón.
Solo si el usuario está autenticado, podrá visualizar el enlace que redirige a la lista de favoritos, visualizar la lista de favoritos y añadir el personaje a favoritos.


### Autenticación

El sistema utiliza autenticación basada en tokens mediante Laravel Sanctum. Los usuarios deben autenticarse a través del endpoint `/login` o `/register` para recibir un token, el cual debe ser incluido en el encabezado `Authorization` para acceder a los endpoints protegidos.

### Filtros y Paginación

- **Filtros Disponibles**:
    - Nombre: `query`
    - Estado: `status`
    - Especie: `species`
    - Género: `gender`

- **Paginación**:
    Utiliza los parámetros `page` para navegar entre páginas de resultados. La API de Rick & Morty limita los resultados a 20 personajes por página.

## Estructura del Proyecto

- **app/Http/Controllers**: Controladores que manejan las solicitudes HTTP.
- **app/Models**: Modelos que representan y gestionan las tablas de la base de datos.
- **routes/web.php**: Definición de rutas y sus controladores asociados.
- **resources/views**: Plantillas Blade para la interfaz de usuario.
- **database/migrations**: Archivos de migración para la base de datos.

## Ejemplos de Uso

### Ejemplo de Solicitud de Registro

```bash
curl -X POST http://localhost:8000/register \
-H "Content-Type: application/json" \
-d '{"name": "John Doe", "email": "john@example.com", "password": "password123", "password_confirmation": "password123"}'
```

### Ejemplo de Solicitud de Login

```bash
curl -X POST http://localhost:8000/login \
-H "Content-Type: application/json" \
-d '{"email": "john@example.com", "password": "password123"}'
```

### Ejemplo de Solicitud para Obtener Personajes

```bash
curl -X GET 'http://localhost:8000/characters?page=1&query=Rick'
```

### Ejemplo de Solicitud para Obtener Detalles de un Personaje
```bash
curl -X GET 'http://localhost:8000/characters/{id}'
```
Reemplaza {id} con el ID del personaje que deseas obtener.

### Ejemplo de Solicitud para Añadir un Personaje a Favoritos
```bash
curl -X POST http://localhost:8000/favorites \
-H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
-H "Content-Type: application/json" \
-d '{"character_id": 1}'
```
Reemplaza 1 con el ID del personaje que deseas añadir a favoritos.

### Ejemplo de Solicitud para Eliminar un Personaje de Favoritos
```bash
curl -X DELETE http://localhost:8000/favorites/1 \
-H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```
Reemplaza 1 con el ID del personaje que deseas eliminar de favoritos.

### Ejemplo de Solicitud para Obtener Lista de Favoritos
```bash
curl -X GET http://localhost:8000/favorites \
-H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```


## Licencia
### Este proyecto está bajo la Licencia MIT.
