<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites list</title>
</head>

<body>
    <!-- Mensajes de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1>Your Favorite Characters</h1>
    
    <!-- Lista de favoritos -->
    <ul>
        @foreach ($favorites as $favorite)
            <li>
                <img src="{{ $favorite['image'] }}" alt="{{ $favorite['name'] }}" width="50">
                <strong>
                    <a href="{{ url('/characters/' . $favorite['id']) }}">{{ $favorite['name'] }}</a>
                </strong>
                <form action="/favorites/{{ $favorite['id'] }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove</button>
                </form>
            </li>
        @endforeach
    </ul>
    <br><br>

    <a href="/characters">View Characters List</a> <br><br>
    
    <!-- Botón de logout -->
    <form id="logout-form" action="/logout" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>