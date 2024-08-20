<!-- resources/views/characters/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Characters</title>
</head>
<body>
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    <h1>Characters</h1>
    <a href="/favorites">View Favorites</a>

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
        @if ($pagination['current_page'] > 1)
            <a href="?page={{ $pagination['current_page'] - 1 }}">Previous</a>
        @endif

        @if ($pagination['current_page'] < $pagination['total_pages'])
            <a href="?page={{ $pagination['current_page'] + 1 }}">Next</a>
        @endif
    </div>
</body>
</html>
