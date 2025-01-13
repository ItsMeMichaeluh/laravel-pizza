@extends('layouts.app')

@section('content')
    @php
        // Decode de JSON-string naar een array
        $items = json_decode($orders->items, true);
    @endphp

    @if(is_array($items))
        @foreach($items as $item)
            <div>
                <p>Item ID: {{ $item['id'] }}</p>
                <p>Item Naam: {{ $item['name'] }}</p>
                <p>Item Prijs: €{{ number_format($item['price'], 2) }}</p>
                <p>Aantal: {{ $item['quantity'] }}</p>
            </div>
        @endforeach
    @else
        <p>Geen items gevonden in deze bestelling.</p>
    @endif

    <p>Totaal: €{{ number_format($orders->total, 2) }}</p>

    <a href="{{ route('home') }}" class="btn">Back to Shop</a>
@endsection
