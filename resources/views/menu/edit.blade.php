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
        <div class="item-form-container">
            <h3>Update item</h3>
            <form action="{{ route('menu.update', $item->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                <div class="item-form">
                    <div class="item-form-component">
                        <label for="naam">Naam</label>
                        <input type="text" placeholder="Naam" value="{{ $item->naam }}" id="naam" name="naam" required>
                    </div>
                    <div class="item-form-component">
                        <label for="beschrijving">Beschrijving</label>
                        <textarea placeholder="Beschrijving" id="beschrijving" name="beschrijving" rows="3" required>{{ $item->beschrijving }}</textarea>
                    </div>
                    <div class="item-form-component">
                        <label for="prijs">Prijs</label>
                        <input type="number" step="0.01" placeholder="Prijs" value="{{ $item->prijs }}" id="prijs" name="prijs" required>
                    </div>
                    <div class="item-form-component">
                        <label for="categorie">Categorie</label>
                        <input type="text" placeholder="Categorie" value="{{ $item->categorie }}" id="categorie" name="categorie" required>
                    </div>
                    <div class="item-form-component">
                        <label for="afbeelding">Afbeelding</label>
                        <div>
                            <img src="{{ asset('storage/' . $item->afbeelding) }}" alt="Menu Image" style="width: 150px; height: auto; margin-bottom: 10px;">
                            <input type="file" id="afbeelding" name="afbeelding">
                        </div>
                    </div>
                    <div>
                        <button type="submit">Update Item</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
