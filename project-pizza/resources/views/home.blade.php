<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @extends('layouts.app')

@section('content')
    <title>Pizza Shop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f9f9f9; }
        .container { width: 80%; margin: auto; }
        .pizza { border: 1px solid #ddd; margin: 10px; border-radius: 5px; background: #fff; }
        .pizza h3 { margin: 0; }
        .btn { padding: 10px 15px; background: #28a745; color: #fff; text-decoration: none; border-radius: 5px; }
        .btn:hover { background: #218838; }
        .card-body { max-width: 225px; min-height: 280px;}
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-5">Pizza Shop</h1>
        <div class="row">
            @foreach ($pizzas as $pizza)
                <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="has-content">
                                <h3 class="card-title">{{ $pizza['name'] }}</h3>
                                <p class="card-text">{{ $pizza['description'] }}</p>
                                <p><strong>€{{ $pizza['price'] }}</strong></p>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $pizza['id'] }}">
                                    <input type="hidden" name="name" value="{{ $pizza['name'] }}">
                                    <input type="hidden" name="price" value="{{ $pizza['price'] }}">
                                    <button class="btn btn-primary btn-block mt-3">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
