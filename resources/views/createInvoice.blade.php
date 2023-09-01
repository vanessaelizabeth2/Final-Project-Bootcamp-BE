<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Create Invoice</title>
</head>
<body>
    <div class="container">
        <h1>Create Invoice</h1>
        <form method="POST" action="{{ route('storeInvoice') }}">
            @csrf

            {{-- <div class="form-group">
                <label for="invoice_number">Invoice Number</label>
                <input type="text" id="invoice_number" name="invoice_number" class="form-control" value="{{ $invoiceId }}" readonly>
            </div> --}}
            
            <div class="form-group">
                <label for="category">Category of Goods</label>
                <input type="text" id="category" name="category" class="form-control" value="{{ $userCart->first()->product->category->category }}" readonly>
                @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="item_name">Item Name & Quantity</label>
                <input type="text" id="item_name" name="item_name" class="form-control" value="{{ $userCart->first()->product->productName }} ({{ $userCart->first()->count }})" readonly>
                @error('item_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="delivery_address">Delivery Address</label>
                <textarea id="delivery_address" name="delivery_address" class="form-control" rows="4" minlength="10" maxlength="100" required></textarea>
                @error('delivery_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" class="form-control" pattern="[0-9]{5}" required>
                @error('postal_code')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Invoice</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>