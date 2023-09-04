<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;



class InvoiceController extends Controller
{
    public function createInvoice(){
        $categories = Category::all('*');
        $products = Product::all('*');
        $userCart = Cart::where('user_id', auth()->user()->id)->get();
        $user = auth()->user();
        
        $categoryName = $userCart->first()->product->category;
        
        $totalPrice = 0;
        $totalItems = 0;

        foreach ($userCart as $cartItem) {
            $product = $cartItem->product;
            $itemPrice = $product->price * $cartItem->count;
            $totalPrice += $itemPrice;
            $totalItems += $cartItem->count;
        }
    
        return view('createInvoice', compact('categories', 'products', 'userCart', 'categoryName', 'user', 'totalPrice', 'totalItems'));
    }
    

    public function storeInvoice(Request $request){
        $validatedData = $request->validate([
            'address' => 'required|string|min:10|max:100',
            'postalCode' => 'required|integer|min:10000|max:99999',
        ]);
    
        $userCart = Cart::where('user_id', auth()->user()->id)->get();
    
        if ($userCart->isEmpty()) {
            return redirect()->route('viewCart')->with('error', 'Your cart is empty.');
        }
        
        $categoryNames = [];

        foreach ($userCart as $cartItem) {
            $categoryName = $cartItem->product->category->category;

            $categoryNames[] = $categoryName;
        }

        $categoryString = implode(', ', $categoryNames);

        $quantity = 0;
        $totalPrice = 0;
    
        $category = '';
        $item_name = '';
    
        $firstCartItem = $userCart->first();
        if ($firstCartItem) {
            $category = $firstCartItem->product->category;
            $item_name = $firstCartItem->product->productName;
        }
    
        foreach ($userCart as $cartItem) {
            $product = $cartItem->product;
            $quantity += $cartItem->count;
            
            $itemPrice = $product->price * $cartItem->count;
            $totalPrice += $itemPrice;
        }

        $lastInvoice = Invoice::orderBy('id', 'desc')->first();
        $lastInvoiceId = $lastInvoice ? $lastInvoice->id + 1 : 1;
        $yearLastTwoDigits = now()->format('y');
        $invoiceNumber = $yearLastTwoDigits . now()->format('md') . str_pad($lastInvoiceId, 5, '0', STR_PAD_LEFT);

    
        $invoice = new Invoice;
        $invoice->invoice_number = $invoiceNumber;
        $invoice->category = $category;
        $invoice->item_name = $item_name;
        $invoice->quantity = $quantity;
        $invoice->total_price = $totalPrice;
        $invoice->delivery_address = $validatedData['address'];
        $invoice->postal_code = $validatedData['postalCode'];
        $invoice->price = $itemPrice;

        if ($invoice->save()) {
            foreach ($userCart as $cartItem) {
                $product = $cartItem->product;
                $product->quantity -= $cartItem->count;
                $product->save();
                
                $cartItem->delete();
            }
            return view('receipt', ['invoice' => $invoice]);
        } else {
            return redirect()->route('viewCart')->with('error', 'Failed to create the invoice. Please try again.');
        }

    }
    
    public function searchInvoice(Request $request)
    {
        $invoiceNumber = $request->input('invoice_number');
    
        $invoice = Invoice::where('invoice_number', $invoiceNumber)->first();
    
        if (!$invoice) {
            return view('searchInvoice', ['error' => 'Invoice not found.']);
        }
    
        return view('receipt', compact('invoice'));
    }
    

    public function viewReceipt($invoiceId){
        $invoice = Invoice::find($invoiceId);

        if (!$invoice) {
            return redirect()->route('homepage')->with('error', 'Invoice not found.');
        }

        $cart = $invoice->cart;

        $user = $cart->user;

        return view('receipt', compact('invoice', 'user'));
    }

    
}
