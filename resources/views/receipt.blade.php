<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Invoice Receipt</title>
    <style>
        .company-info p {
            margin-bottom: 3px;
        }

        .delivery-address p{
            margin-bottom: 3px;
            margin-top: 3px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-left mt-3">Invoice</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-primary">BNCC SHOP</h3>
                <p class="company-info">Jl. Rw. Belong No.51A,</p>
                <p class="company-info">RT.7/RW.15, Palmerah,</p>
                <p class="company-info">Kec. Palmerah, Kota Jakarta Barat,</p>
                <p class="company-info">Daerah Khusus Ibukota Jakarta 11480</p>
            </div>
            <div class="col-md-6">
                <div class="invoice-details">
                    <h3 class="text-primary mb-3">Invoice Details</h3>
                    <dl class="row">
                        <dt class="col-sm-4"><strong>Invoice Number:</strong></dt>
                        <dd class="col-sm-8">{{ $invoice->invoice_number }}</dd>
                        <dt class="col-sm-4"><strong>Date:</strong></dt>
                        <dd class="col-sm-8">{{ $invoice->created_at->format('Y-m-d H:i:s') }}</dd>
                    </dl>
                </div>
        
                <div class="delivery-address">
                    <h6><strong>Delivery Address</strong></h6>
                    <p>{{ $invoice->delivery_address }}, {{ $invoice->postal_code }}</p>
                </div>
            </div>
        </div>
        <hr>
        <h3>Order Summary</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price per Item</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->lineItems as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price) }}</td>
                    <td>Rp {{ number_format($item->quantity * $item->price) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total Price:</th>
                    <td>Rp {{ number_format($invoice->total_price) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('homepage') }}" class="btn btn-danger">Close</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
