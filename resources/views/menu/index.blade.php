<div class="container">
    <h1>Menu Items</h1>
    <ul>
        @foreach($menuItems as $item)
            <li>{{ $item->naam }}: €{{ number_format($item->prijs )}} - {{ $item->beschrijving }} </li>
        @endforeach
    </ul> 
</div>