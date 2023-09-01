<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <!-- Include any necessary CSS stylesheets or libraries here -->
</head>
<body>
    <div class="container">
        <h1>Create Invoice</h1>
        <form method="POST" action="{{ route('invoices.store') }}">
            @csrf

            <!-- Invoice number (you can use the generated number or let the user input it) -->
            <div class="form-group">
                <label for="invoice_number">Invoice Number</label>
                <input type="text" id="invoice_number" name="invoice_number" class="form-control" value="{{ $generatedInvoiceNumber }}" readonly>
            </div>

            <!-- Category of goods -->
            <div class="form-group">
                <label for="category">Category of Goods</label>
                <input type="text" id="category" name="category" class="form-control" required>
            </div>

            <!-- Item name and quantity -->
            <div class="form-group">
                <label for="item_name">Item Name & Quantity</label>
                <input type="text" id="item_name" name="item_name" class="form-control" required>
            </div>

            <!-- Delivery address -->
            <div class="form-group">
                <label for="delivery_address">Delivery Address</label>
                <textarea id="delivery_address" name="delivery_address" class="form-control" rows="4" minlength="10" maxlength="100" required></textarea>
            </div>

            <!-- Postal code -->
            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" class="form-control" pattern="[0-9]{5}" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Invoice</button>
        </form>
    </div>
</body>
</html>