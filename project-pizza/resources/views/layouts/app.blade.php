<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Pizza Shop</title>

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
