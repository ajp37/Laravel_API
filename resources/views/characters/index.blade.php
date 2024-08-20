<!-- resources/views/characters/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Characters</title>
</head>
<body>
    <!-- Botón de logout -->
    <form id="logout-form" action="/logout" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <!-- Funciona pero hay que dar el logout al cliente y mandar a (/(home)) y hay que quitar que el /characters sea bajo autenticación --> 
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    <h1>Characters</h1>
    <a href="/favorites">View Favorites</a>
    <ul>
        @foreach ($characters as $character)
            <li>
                <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}" width="50">
                <strong>{{ $character['name'] }}</strong> - {{ $character['status'] }} ({{ $character['species'] }})
            </li>
        @endforeach
    </ul>
</body>
</html>
