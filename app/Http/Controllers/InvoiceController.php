<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Category; // Import the Category model
use App\Models\Product; // Import the Product model

class InvoiceController extends Controller
{
    // Display the invoice creation form
    public function create()
    {
        // You can pass categories and products to your view to populate dropdowns, for example:
        $categories = Category::all('*');
        $products = Product::all('*');

        return view('createInvoice', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required|string|min:10|max:100',
            'postalCode' => 'required|integer|min:10000|max:99999', // Updated min and max values for a 5-digit postal code
            'category' => 'required|integer|exists:categories,id',
            'productName' => 'required|string|exists:products,productName',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'image' => 'required|file'
        ]);

        // Create and save a new invoice record using the Invoice model
        $invoice = new Invoice;
        $invoice->category_id = $validatedData['category']; // Update this to match your database column name
        $invoice->product_name = $validatedData['productName']; // Update this to match your database column name
        $invoice->price = $validatedData['price'];
        $invoice->quantity = $validatedData['quantity'];
        $invoice->address = $validatedData['address'];
        $invoice->postal_code = $validatedData['postalCode'];

        $invoice->save();

        $invoiceNumber = $invoice->id;

        return redirect()->route('/');
        // return redirect()->route('thankyou')->with('invoiceNumber', $invoiceNumber);
    }

}
