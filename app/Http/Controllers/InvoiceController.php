<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;

class InvoiceController extends Controller
{
    // Display the invoice creation form
    public function createInvoice(){
        $categories = Category::all('*');
        $products = Product::all('*');

        // Retrieve the user's cart data (modify this query based on your cart structure)
        $userCart = Cart::where('user_id', auth()->user()->id)->get();

        // Assuming you have the category name in your cart data
        $categoryName = $userCart->first()->product->category;

        return view('createInvoice', compact('categories', 'products', 'userCart', 'categoryName'));
    }




    public function storeInvoice(Request $request){
        $validatedData = $request->validate([
            'address' => 'required|string|min:10|max:100',
            'postalCode' => 'required|integer|min:10000|max:99999',
            'category' => 'required|string',
            'productName' => 'required|string|exists:products,productName',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'image' => 'required|file'
        ]);

        $invoice = new Invoice;
        $invoice->category = $validatedData['category'];
        $invoice->product_name = $validatedData['productName'];
        $invoice->price = $validatedData['price'];
        $invoice->quantity = $validatedData['quantity'];
        $invoice->address = $validatedData['address'];
        $invoice->postal_code = $validatedData['postalCode'];

        $invoice->save();

        $invoiceId = $invoice->id; 

        return redirect()->route('viewReceipt', ['invoiceId' => $invoiceId]);
    }

    public function viewReceipt($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);

        if (!$invoice) {
            return redirect()->route('homepage')->with('error', 'Invoice not found.');
        }

        return view('receipt', compact('invoice'));
    }

}
