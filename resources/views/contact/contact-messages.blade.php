<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Thuisbezorgd</title>
</head>
<body>
    <header>
        @include('layouts.navigation')
    </header>
    <main>
        <div class="message-items">
            @foreach($messages as $message)
                <div class="message-item">
                    <div>
                        <div>Naam:</div>
                        <div>{{ $message->name }}</div>
                    </div>
                    <div>
                        <div>E-mail:</div>
                        <div>{{ $message->email }}</div>
                    </div>
                    <div>
                        <div>Onderwerp:</div>
                        <div>{{ $message->title }}</div>
                    </div>
                    <div>
                        <div>Bericht:</div>
                        <div>{{ $message->message }}</div>
                    </div>
                    <form action="{{ route('contact.destroy', $message->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Verwijderen</button>
                      </form>
                </div>
            @endforeach
        </div>
    </main>

    <footer>
        
    </footer>
</body>
</html>