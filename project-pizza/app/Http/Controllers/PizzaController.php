<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = [
            ['id' => 1, 'name' => 'Margherita', 'description' => 'Classic cheese and tomato pizza', 'price' => 7.50],
            ['id' => 2, 'name' => 'Pepperoni', 'description' => 'Topped with pepperoni slices', 'price' => 9.00],
            ['id' => 3, 'name' => 'Hawaiian', 'description' => 'Ham and pineapple topping', 'price' => 8.50],
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

        $exists = false;
        foreach ($cart as &$item) {
            if ($item['id'] == $pizza['id']) {
                $item['quantity'] += 1;
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            $pizza['quantity'] = 1;
            $cart[] = $pizza;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Pizza added to cart!');
    }

    public function increaseQuantity(Request $request)
    {
        $cart = session()->get('cart', []);
        foreach ($cart as &$item) {
            if ($item['id'] == $request->id) {
                $item['quantity'] += 1;
                break;
            }
        }
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Item quantity increased!');
    }

    public function decreaseQuantity(Request $request)
    {
        $cart = session()->get('cart', []);
        foreach ($cart as &$item) {
            if ($item['id'] == $request->id) {
                $item['quantity'] -= 1;
                if ($item['quantity'] <= 0) {
                    $cart = array_filter($cart, fn($i) => $i['id'] != $request->id);
                }
                break;
            }
        }
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Item quantity decreased!');
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $cart = array_filter($cart, fn($item) => $item['id'] != $request->id);
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Item removed from cart!');
    }
}
