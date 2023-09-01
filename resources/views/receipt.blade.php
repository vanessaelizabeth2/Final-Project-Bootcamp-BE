<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Invoice Receipt</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>Invoice Details</h3>
                <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
                <p><strong>Date:</strong> {{ $invoice->created_at->format('Y-m-d H:i:s') }}</p>
            </div>
            <div class="col-md-6">
                <h3>Delivery Address</h3>
                <p>{{ $invoice->delivery_address }}</p>
                <p><strong>Postal Code:</strong> {{ $invoice->postal_code }}</p>
            </div>
        </div>
        <hr>
        <h3>Order Summary</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->item_name }}</td>
                    <td>{{ $invoice->quantity }}</td>
                    <td>${{ $invoice->price }}</td>
                    <td>${{ $invoice->quantity * $invoice->price }}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-right">
            <p><strong>Total Price:</strong> ${{ $invoice->quantity * $invoice->price }}</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>