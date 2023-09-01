<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Your Cart</title>
    <style>
        .navbar {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .navbar .nav-link {
            color: #333;
            transition: color 0.3s ease;
            font-weight: normal;
        }

        .navbar .nav-link.active {
            font-weight: bold;
            color: #6C47EA;
        }

        .navbar .nav-link:hover {
            color: #007bff;
            font-weight: bold;
        }

        .navbar-brand {
            font-weight: bold;
            position: relative;
            display: inline-block;
            line-height: 1;
        }

        .navbar-brand::before {
            content: attr(data-text);
            position: absolute;
            top: 0.25em;
            left: 0;
            width: 0;
            color: transparent;
            overflow: hidden;
            white-space: nowrap;
            transition: width 0.3s ease, color 0.3s ease;
        }

        .navbar-brand:hover::before {
            width: 100%;
            color: #3289DF;
        }
        

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand mr-auto" href="#">BNCC SHOP</a>
            <div class="mx-auto"> <!-- Centered Menu Items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() === 'homepage' ? 'active' : '' }}" href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() === 'cart' ? 'active' : '' }}" href="{{ route('viewCart') }}">Your Cart</a>
                    </li>
                    @can('is_admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() === 'addCategory' ? 'active' : '' }}" href="{{ route('addCategory') }}">Add Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() === 'addProduct' ? 'active' : '' }}" href="{{ route('addProduct') }}">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() === 'editPage' ? 'active' : '' }}" href="{{ route('editPage') }}">Edit Product</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="d-flex">
                @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
                @endauth
                <div class="mx-1"></div>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Your Cart</h1>
        @if ($cartItems->isEmpty())
            <div class="card">
                <div class="card-body">
                    No products in your cart yet.
                </div>
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>{{ optional($cartItem->product)->productName }}</td>
                                <td>
                                    <form action="{{ route('updateQuantity', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group">
                                            <button type="button" class="btn btn-sm btn-primary minus-quantity">-</button>
                                            <input type="number" name="count" value="{{ $cartItem->count }}" min="1" class="form-control text-center">
                                            <button type="button" class="btn btn-sm btn-primary plus-quantity">+</button>
                                        </div>
                                    </form>
                                </td>                            
                                <td>{{ $cartItem->price }}</td>
                            <td>{{ $cartItem->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Total Price: {{ $totalPrice }}</p>
        @endif
        @if (!$cartItems->isEmpty())
            <a href="{{ route('createInvoice') }}" class="btn btn-primary">Create Invoice</a>
        @endif
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
