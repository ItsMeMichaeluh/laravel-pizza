@extends('layouts.app')

@section('content')
    <h1>Pizza Shop</h1>
    <div>
        @foreach ($pizzas as $pizza)
            <div class="pizza">
                <h3>{{ $pizza['name'] }}</h3>
                <p>{{ $pizza['description'] }}</p>
                <p><strong>€{{ $pizza['price'] }}</strong></p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $pizza['id'] }}">
                    <input type="hidden" name="name" value="{{ $pizza['name'] }}">
                    <input type="hidden" name="price" value="{{ $pizza['price'] }}">
                    <button class="btn">Add to Cart</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
