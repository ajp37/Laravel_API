<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Characters</title>
</head>
<body>
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
