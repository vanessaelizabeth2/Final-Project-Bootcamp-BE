<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Create Invoice</title>
    <style>
        .generate-button{
            font-size: 20px;
            padding: 10px 20px;
        }
        .cancel-button{
            font-size: 20px;
            padding: 10px 20px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Create Invoice</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('storeInvoice') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" style="font-weight: bold">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="address" style="font-weight: bold">Delivery Address</label>
                        <textarea id="address" name="address" class="form-control" rows="2" maxlength="100" required></textarea>
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="postalCode" style="font-weight: bold">Postal Code</label>
                        <input type="text" id="postalCode" name="postalCode" class="form-control" pattern="[0-9]{5}" required>
                        @error('postalCode')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="table-responsive mt-4">
                        <h2 class="mb-3">Item Information</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category of Goods</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userCart as $cartItem)
                                    <tr>
                                        <td>{{ $cartItem->product->category->category }}</td>
                                        <td>{{ $cartItem->product->productName }}</td>
                                        <td>{{ $cartItem->count }}</td>
                                        <td>Rp {{ number_format($cartItem->product->price) }}</td>
                                        <td>Rp {{ number_format($cartItem->product->price * $cartItem->count) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <p class="mb-0" style="font-size: 20px;"><strong>Total Orders: </strong> {{ $totalItems }} Products</p>
                    </div>

                    <div class="mt-2">
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size: 20px;"><strong>Total Price</strong></p>
                                <p class="mt-0" style="font-size: 30px; color: #F6490B;"><strong>Rp {{ number_format($totalPrice) }}</strong></p>
                            </div>
                            <div>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary cancel-button" style="background-color: #D8D8D8; color: black; border-color: #D8D8D8;">Cancel</a>
                                <button type="submit" class="btn btn-primary generate-button ml-2">Generate Invoice</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>