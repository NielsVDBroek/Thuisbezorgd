<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Thuisbezorgd</title>
</head>

<body>
    <header>

    </header>
    <main>
        <div class="item-form-container">
            <h3>Add a Post</h3>
            <form action="{{ route('menu.store') }}" enctype="multipart/form-data" method="post">
                <div class="item-form">
                    @csrf
                    <div class="item-form-component">
                        <label for="naam">Naam</label>
                        <input type="text" id="naam" name="naam" required>
                    </div>
                    <div class="item-form-component">
                        <label for="beschrijving">Beschrijving</label>
                        <textarea id="beschrijving" name="beschrijving" rows="3" required></textarea>
                    </div>
                    <div class="item-form-component">
                        <label for="prijs">Prijs</label>
                        <input type="number" step="0.01" id="prijs" name="prijs" required>
                    </div>
                    <div class="item-form-component">
                        <label for="categorie">Categorie</label>
                        <input type="text" id="categorie" name="categorie" required>
                    </div>
                    <div class="item-form-component">
                        <label for="afbeelding">Afbeelding</label>
                        <input type="file" id="afbeelding" name="afbeelding" required>
                    </div>
                    <div>
                        <button type="submit">Item Toevoegen</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>