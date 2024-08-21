<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $character['name'] }} - Character Details</title>
</head>

<body>
    <h1>{{ $character['name'] }}</h1>
    <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}">
    <p><strong>Status:</strong> {{ $character['status'] }}</p>
    <p><strong>Species:</strong> {{ $character['species'] }}</p>
    <p><strong>Gender:</strong> {{ $character['gender'] }}</p>
    <p><strong>Origin:</strong> {{ $character['origin']['name'] }}</p>
    <p><strong>Location:</strong> {{ $character['location']['name'] }}</p>

    <a href="{{ url('/characters') }}">Back to Characters List</a>


    <form method="POST" action="{{ route('favorites.store') }}">
        @csrf
        <input type="hidden" name="character_id" value="1">
        <button type="submit">Add to Favorites</button>
    </form>




</body>

</html>