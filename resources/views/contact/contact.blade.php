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

<body>
    <header>
        @include('layouts.navigation')
    </header>
    <main>
        @if (auth()->check())
            <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                @csrf
                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
        @else
            <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                @csrf
                <div class="contact-form-input-field">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="contact-form-input-field">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
        @endif
                <div class="contact-form-input-field">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="contact-form-input-field">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                

                <button type="submit">Send</button>
            </form>

    </main>
    <footer>

    </footer>
</body>

</html>