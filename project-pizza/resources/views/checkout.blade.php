@extends('layouts.app')

@section('content')
    <h1>Order Summary</h1>
    <p><strong>Order ID:</strong> {{ $orders->id }}</p>
    <p><strong>Total:</strong> €{{ $orders->total }}</p>
    <h2>Items:</h2>
    <ul>
        @foreach ($orders->items as $item)
            <li>
                {{ $item['name'] }} - €{{ $item['price'] }} x {{ $item['quantity'] }}
                = €{{ $item['price'] * $item['quantity'] }}
            </li>
        @endforeach
    </ul>
    <a href="{{ route('home') }}" class="btn">Back to Shop</a>
@endsection
