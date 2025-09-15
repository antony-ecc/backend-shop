<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('customer_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Cart',
            'cart' => $carts
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $userId = Auth::user()->id;

        $finalPrice = $product->price;
        if ($product->discount > 0) {
            $finalPrice = $product->price - ($product->price * $product->discount / 100);
        }

        $cartItem = Cart::where('product_id', $product->id)->where('customer_id', $userId)->first();

        if($cartItem) {
            $cartItem->increment('qty', $request->quantity ?? 1);

            $cartItem->update([
                'price' => $finalPrice * $cartItem->qty,
                'weight' => $product->weight * $cartItem->qty,
            ]);
        } else {
            $cartItem = Cart::create([
                'product_id' => $product->id,
                'customer_id' => $request->customer_id,
                'qty' => $request->quantity ?? 1,
                'price' => $finalPrice * ($request->quantity ?? 1),
                'weight' => $product->weight * ($request->quantity ?? 1),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success Add to Cart',
            'quantity' => $cartItem->qty,
            'product' => $cartItem->product,
        ]);
    }

    public function getCartTotal()
    {
        $totalCart = Cart::with('product')
        ->where('customer_id', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->sum('price');

        return response()->json([
            'success' => true,
            'message' => 'Total Price',
            'total' => $totalCart
        ]);
    }

    public function getCartTotalWeight()
    {
        $totalWeight = Cart::with('product')
        ->where('customer_id', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->sum('weight');

        return response()->json([
            'success' => true,
            'message' => 'Total Weight',
            'total' => $totalWeight
        ]);
    }

    public function removeCart(Cart $cart)
    {
        $cart->delete();

        return response()->json([
            'success' => true,
            'message' => 'Remove Item Successfully!',
        ]);
    }
}
