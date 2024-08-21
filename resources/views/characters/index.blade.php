<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Characters</title>
</head>

<body>
    <!-- Mensaje cierre de sesión -->
    @if(session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif

    <h1>Characters</h1>
    <br>

    <!-- Formulario de búsqueda por nombre, status, especie y género -->
    <form method="GET" action="{{ url('/characters') }}">
        <input type="text" name="query" placeholder="Name" value="{{ $filters['query'] ?? '' }}">
        <input type="text" name="status" placeholder="Status" value="{{ $filters['status'] ?? '' }}">
        <input type="text" name="species" placeholder="Species" value="{{ $filters['species'] ?? '' }}">
        <input type="text" name="gender" placeholder="Gender" value="{{ $filters['gender'] ?? '' }}">
        <button type="submit">Filter</button>
    </form>
    <br>

    <!-- Solo mostrar si el usuario está autenticado -->
    @auth 
        <a href="/favorites">View Favorites</a>
        <span>&nbsp;/&nbsp;</span>
        <!-- Botón de logout -->
        <form id="logout-form" action="/logout" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth

    <!-- Solo mostrar si el usuario no está autenticado -->
    @guest
        <a href="/register">Register / Login</a>
    @endguest

    <!-- Listado de personajes -->
    <ul>
        @foreach ($characters as $character)
            <li>
                <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}" width="50">
                <strong>
                    <a href="{{ url('/characters/' . $character['id']) }}">{{ $character['name'] }}</a>
                </strong>
                - {{ $character['status'] }} ({{ $character['species'] }}) / Gender: {{ $character['gender'] }}
            </li>
        @endforeach
    </ul>

    <!-- Paginación -->
    <div>
        @if($pagination['current_page'] > 1)
            <a
                href="?page={{ $pagination['current_page'] - 1 }}&name={{ $filters['query'] }}&status={{ $filters['status'] }}&species={{ $filters['species'] }}&gender={{ $filters['gender'] }}">Previous</a>
        @endif
        @if($pagination['current_page'] < $pagination['total_pages'])
            <a
                href="?page={{ $pagination['current_page'] + 1 }}&name={{ $filters['query'] }}&status={{ $filters['status'] }}&species={{ $filters['species'] }}&gender={{ $filters['gender'] }}">Next</a>
        @endif
    </div>
</body>

</html>