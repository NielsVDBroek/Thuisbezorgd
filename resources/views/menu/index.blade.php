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
        <div class="menu-container">
            <div class="menu-container-title">Menu Items</div>
            <div class="menu-items">
                @foreach($menuItems as $item)
                    <div class="menu-item">
                        <div class="menu-item-image-name-description">
                            <div class="menu-item-image-container">
                                <img src="{{ asset('storage/' . $item->afbeelding) }}" alt="Menu Image">
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
                        <div class="menu-item-price-edit-delete">
                            <div class="menu-item-price">
                                €{{ $item->prijs }}
                            </div>
                            <div class="menu-item-edit-delete">
                                <div class="menu-item-edit">
                                    <button onclick="location.href='{{ route('menu.edit', $item->id) }}'">Aanpassen</button>
                                </div>
                                <div class="menu-item-delete">
                                    <form action="{{ route('menu.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Verwijderen</button>
                                      </form>
                                </div>
                            </div>
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