<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outspot test</title>
</head>
<body>
    <form method="POST" action="{{ route('pay') }}">
        @csrf
        <input type="number" name="amount" id="amount" min="10" max="100" required placeholder="Amount"> 
        <input type="submit" value="Pay">
    </form>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>