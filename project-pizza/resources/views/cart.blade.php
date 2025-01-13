@extends('layouts.app')

@section('content')
    <h1>Your Cart</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (count($cart) > 0)
        @foreach ($cart as $item)
            <div class="cart-item">
                <h3>{{ $item['name'] }}</h3>
                <p>Price: €{{ $item['price'] }}</p>
                <p>Quantity: {{ $item['quantity'] }}</p>

                <form action="{{ route('cart.increase') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button class="btn">+</button>
                </form>

                <form action="{{ route('cart.decrease') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button class="btn btn-danger">-</button>
                </form>

                <form action="{{ route('cart.remove') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button class="btn btn-warning">Remove</button>
                </form>
            </div>
        @endforeach
    @else
        <p>Your cart is empty!</p>
    @endif

    <a href="{{ route('home') }}" class="btn">Continue Shopping</a>
@endsection

@if (count($cart) > 0)
    <form action="{{ route('checkout') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button class="btn btn-success">Betalen</button>
    </form>
@endif
