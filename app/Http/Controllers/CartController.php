<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = CartItem::with('product')->get();
        $grandTotal = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('items','grandTotal'));
    }

    public function add(Product $product)
    {
        $item = CartItem::where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => ['required','integer','min:1'],
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('error', 'Item removed from cart.');
    }

    public function clear()
    {
        CartItem::truncate();
        return redirect()->route('cart.index')->with('error', 'Cart cleared.');
    }
}
