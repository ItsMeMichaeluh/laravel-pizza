<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = [
            ['id' => 1, 'name' => 'Margherita', 'price' => 8.99, 'description' => 'Classic pizza with tomato and mozzarella'],
            ['id' => 2, 'name' => 'Pepperoni', 'price' => 10.99, 'description' => 'Spicy pepperoni with cheese'],
            ['id' => 3, 'name' => 'Veggie', 'price' => 9.99, 'description' => 'Loaded with fresh vegetables'],
        ];
        return view('home', compact('pizzas'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $pizza = $request->only('id', 'name', 'price');
        $cart = session()->get('cart', []);
        $cart[] = $pizza;
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Pizza added to cart!');
    }
}
