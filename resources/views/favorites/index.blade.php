<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
</head>
<body>
    <h1>Your Favorite Characters</h1>
    <a href="/characters">Back to Characters</a>
    <ul>
        @foreach ($favorites as $favorite)
            <li>
                <img src="{{ $favorite['image'] }}" alt="{{ $favorite['name'] }}" width="50">
                <strong>{{ $favorite['name'] }}</strong>
                <form action="/favorites/{{ $favorite['id'] }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
