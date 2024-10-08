<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $character['name'] }} - Character Details</title>
</head>

<body>
    <!-- Detalles del personaje -->
    <h1>{{ $character['name'] }}</h1>
    <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}">
    <p><strong>Status:</strong> {{ $character['status'] }}</p>
    <p><strong>Species:</strong> {{ $character['species'] }}</p>
    <p><strong>Gender:</strong> {{ $character['gender'] }}</p>
    <p><strong>Origin:</strong> {{ $character['origin']['name'] }}</p>
    <p><strong>Location:</strong> {{ $character['location']['name'] }}</p>
    <p><strong>ID:</strong> {{$character['id']}}</p>
    <br>

    <!-- Botón para añadir a favoritos -->
    @auth
        <form method="POST" action="{{ route('favorites.store') }}">
            @csrf
            <input type="hidden" name="character_id" value="{{$character['id']}}">
            <button type="submit">Add to Favorites</button>
        </form>
    @endauth

    <br>
    <a href="{{ url('/characters') }}">Back to Characters List</a>
</body>

</html>