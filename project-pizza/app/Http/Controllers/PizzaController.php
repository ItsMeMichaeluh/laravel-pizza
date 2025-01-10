<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class PizzaController extends Controller
{
    public function index()
    {
        // Laad de beschikbare pizza's
        $pizzas = [
            ['id' => 1, 'name' => 'Margherita', 'price' => 8.99],
            ['id' => 2, 'name' => 'Pepperoni', 'price' => 10.99],
            ['id' => 3, 'name' => 'Hawaii', 'price' => 9.99],
        ];

        return view('home', compact('pizzas'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $pizzaId = $request->id;
        $pizzaName = $request->name;
        $pizzaPrice = $request->price;

        // Check if pizza al in de winkelwagen zit
        $found = false;
        foreach ($cart as &$item) {
            if ($item['id'] == $pizzaId) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        // Zo niet, voeg een nieuw item toe
        if (!$found) {
            $cart[] = [
                'id' => $pizzaId,
                'name' => $pizzaName,
                'price' => $pizzaPrice,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Pizza toegevoegd aan winkelwagen!');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
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

        return redirect()->route('cart')->with('success', 'Aantal verhoogd!');
    }

    public function decreaseQuantity(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $key => &$item) {
            if ($item['id'] == $request->id) {
                $item['quantity'] -= 1;
                if ($item['quantity'] <= 0) {
                    unset($cart[$key]);
                }
                break;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Aantal verlaagd!');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Je winkelwagen is leeg.');
        }

        // Bereken het totaalbedrag
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        // Sla de bestelling op in de database
        $orders = Orders::create([
            'items' => json_encode($cart),
            'total' => $total,
        ]);

        // Maak de winkelwagen leeg
        session()->forget('cart');

        return view('checkout', compact('orders'));
    }
}
