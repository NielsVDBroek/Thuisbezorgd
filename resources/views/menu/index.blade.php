<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>My Laravel Site</title>
</head>
<body>
    <header>
        <h1>Header</h1>
    </header>

    <main>
        <div class="menu-container">
            <h1>Menu Items</h1>
            <div class="menu-items">
                @foreach($menuItems as $item)
                    <div class="menu-item">
                        <div class="menu-item-image-name-description">
                            <div class="menu-item-image">
                                {{ $item->afbeelding }}
                            </div>
                            <div class="menu-item-name-description">
                                <div class="menu-item-name">
                                    {{ $item->naam }}
                                </div>
                                <div class="menu-item-description">
                                    {{ $item->beschrijving }}
                                </div>
                            </div>
                        </div>
                        <div class="menu-item-price">
                            €{{ $item->prijs }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <footer>
        
    </footer>
</body>
</html>