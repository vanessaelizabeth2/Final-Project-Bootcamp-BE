<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('homepage')->with('error', 'Product not found.');
        }

        $userId = auth()->user()->id;

        $existingCartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->count += 1;
            $existingCartItem->total_price = $existingCartItem->count * $existingCartItem->price;
            $existingCartItem->save();
        } else {
            $cartItem = new Cart([
                'product_id' => $product->id,
                'user_id' => $userId,
                'count' => 1,
                'price' => $product->price,
                'total_price' => $product->price,
            ]);
            $cartItem->save();
        }

        return redirect()->route('homepage')->with('success', 'Product added to the cart.');
    }

    public function viewCart()
    {
        $cartItems = Cart::with('product')->get('*');
    
        $totalPrice = 0;
    
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
    
            $totalPrice += $cartItem->total_price;
        }
    
        return view('viewCart', compact('cartItems', 'totalPrice'));
    }
    
    public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::find($id);

        if (!$cartItem) {
            return redirect()->route('viewCart')->with('error', 'Cart item not found.');
        }

        // Validate the form input
        $request->validate([
            'count' => 'required|integer|min:1',
        ]);

        // Update the quantity and total price
        $cartItem->count = $request->count;
        $cartItem->total_price = $cartItem->count * $cartItem->price;
        $cartItem->save();

        return redirect()->route('viewCart')->with('success', 'Quantity updated successfully.');
    }

    // public function checkout(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {  
    //         foreach ($purchasedItems as $item) {
    //             $product = Product::find($item->product_id);
                
    //             // Check if there's enough quantity in stock
    //             if ($product->quantity >= $item->quantity) {
    //                 // Deduct the purchased quantity from the product's stock
    //                 $product->quantity -= $item->quantity;
    //                 $product->save();
    //             } else {
    //                 // Handle insufficient stock, possibly by showing an error to the user
    //                 DB::rollback();
    //                 return redirect()->back()->with('error', 'Insufficient stock for ' . $product->productName);
    //             }
    //         }

    //         // Create an order record in the database and complete the checkout process

    //         // Commit the transaction
    //         DB::commit();

    //         return redirect()->route('checkout.success')->with('success', 'Checkout successful!');
    //     } catch (\Exception $e) {
    //         // Handle any exceptions that may occur during the checkout process
    //         DB::rollback();
    //         return redirect()->route('checkout.error')->with('error', 'An error occurred during checkout.');
    //     }
    // }

}
