<!-- resources/views/characters/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Characters</title>
</head>

<body>
    <h1>Characters</h1>
    <br>

    <form method="GET" action="{{ url('/characters') }}">
        <input type="text" name="query" placeholder="Name" value="{{ $filters['query'] ?? '' }}">
        <input type="text" name="status" placeholder="Status" value="{{ $filters['status'] ?? '' }}">
        <input type="text" name="species" placeholder="Species" value="{{ $filters['species'] ?? '' }}">
        <input type="text" name="gender" placeholder="Gender" value="{{ $filters['gender'] ?? '' }}">
        <button type="submit">Filter</button>
    </form>
    <br>

    <a href="/favorites">View Favorites</a>
    <!-- Mostrar solo a sesion iniciada -->


    <!-- Botón de logout -->
    <form id="logout-form" action="/logout" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>


    <!-- Listado de personajes -->
    <ul>
        @foreach ($characters as $character)
            <li>
                <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}" width="50">
                <strong>{{ $character['name'] }}</strong> - {{ $character['status'] }} ({{ $character['species'] }})
            </li>
        @endforeach
    </ul>

    <!-- Paginación -->
    <div>
        @if($pagination['current_page'] > 1)
            <a href="?page={{ $pagination['current_page'] - 1 }}&name={{ $filters['query'] }}&status={{ $filters['status'] }}&species={{ $filters['species'] }}&gender={{ $filters['gender'] }}">Previous</a>
        @endif
        @if($pagination['current_page'] < $pagination['total_pages'])
            <a href="?page={{ $pagination['current_page'] + 1 }}&name={{ $filters['query'] }}&status={{ $filters['status'] }}&species={{ $filters['species'] }}&gender={{ $filters['gender'] }}">Next</a>
        @endif
    </div>
</body>

</html>