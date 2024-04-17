<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Thuisbezorgd</title>
</head>
<body>
    @include('menu.header')

    <main>
        <div class="menu-container">
            <h1>Menu Items</h1>
            <div class="col ">
                <button onclick="location.href='{{ route('menu.create') }}'">Item toevoegen</button>
            </div>
            <div class="menu-items">
                @foreach($menuItems as $item)
                    <div class="menu-item">
                        <div class="menu-item-image-name-description">
                            <div class="menu-item-image-container">
                                {{-- Help nodig met ophalen image --}}
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