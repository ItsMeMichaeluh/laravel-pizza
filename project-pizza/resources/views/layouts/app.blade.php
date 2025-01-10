<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Shop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f9f9f9; position-top: 0; }
        .navbar { background-color: #333; padding: 10px; color: white;  }
        .navbar a { color: white; text-decoration: none; padding: 10px; margin: 0 15px; }
        .navbar a:hover { background-color: #555; }
        .navbar .cart { float: right; }
        .container { width: 80%; margin: auto; }
        .pizza { border: 1px solid #ddd; padding: 15px; margin: 10px; border-radius: 5px; background: #fff; }
        .pizza h3 { margin: 0; }
        .btn { display: inline-block; padding: 10px 15px; background: #28a745; color: #fff; text-decoration: none; border-radius: 5px; }
        .btn:hover { background: #218838; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('cart') }}" class="cart">
            Cart ({{ session()->get('cart') ? count(session()->get('cart')) : 0 }})
        </a>
    </div>

    <!-- Main content -->
    <div class="container">
        @yield('content')
    </div>

</body>
</html>
