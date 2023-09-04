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

        .details{
            font-size: 16px;
            margin-bottom: 5px;
        }

        .start-shopping{
            border-width: 1px;
            border-color: blue;"
        }

        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-control .btn {
            margin: 0 5px;
        }

        .quantity-control input {
            width: 15px !important;
            text-align: center;
        }


        .quantity-label {
            margin-right: 10px;
        }

        .custom-quantity-input {
            width: 30px !important;
            height: 30px;
            padding: 0;
            text-align: center;
            margin-right: 5px;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand mr-auto" href="#">BNCC SHOP</a>
            <div class="mx-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() === 'homepage' ? 'active' : '' }}" href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() === 'viewCart' ? 'active' : '' }}" href="{{ route('viewCart') }}">Your Cart</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() === 'searchInvoice' ? 'active' : '' }}" href="{{ route('searchInvoice') }}">Search Invoice</a>
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
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                @endauth
                <div class="mx-1"></div>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            </div>
        </div>
    </nav>   

    <div class="container mt-3">
        <h1 class="d-flex justify-content-between align-items-center">
            Your Cart
            <a href="{{ route('searchInvoice') }}" class="btn btn-primary">Search Invoice</a>
        </h1>        
        @if ($cartItems->isEmpty())
            <div class="card">
                <div class="card-body">
                    No products in your cart yet.
                </div>
            </div>
            <div class="mt-2">
                <a href="{{ route('homepage') }}">
                    <button class="start-shopping btn btn-outline-primary" >Start Shopping</button>
                </a>
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
                                <form action="{{ route('updateQuantity', $cartItem->id) }}" method="POST" class="update-quantity-form">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group quantity-control">
                                        <button type="button" class="btn btn-sm btn-danger minus-quantity" data-action="decrement" data-id="{{ $cartItem->id }}">-</button>
                                        <input type="number" name="count" value="{{ $cartItem->count }}" min="1" class="form-control text-center custom-quantity-input">
                                        <button type="button" class="btn btn-sm btn-success plus-quantity" data-action="increment" data-id="{{ $cartItem->id }}">+</button>
                                    </div>
                                    <div class="confirmation-message">
                                        <p>Remove item from the cart?</p>
                                        <button type="button" class="btn btn-sm btn-secondary cancel-remove">No</button>
                                        <button type="button" class="btn btn-sm btn-danger confirm-remove" data-id="{{ $cartItem->id }}">Yes</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const updateQuantityForms = document.querySelectorAll('.update-quantity-form');

        updateQuantityForms.forEach(form => {
            const minusButton = form.querySelector('.minus-quantity');
            const plusButton = form.querySelector('.plus-quantity');
            const countInput = form.querySelector('input[name="count"]');
            const cartItemId = minusButton.getAttribute('data-id');
            const confirmationMessage = form.querySelector('.confirmation-message');
            const confirmRemoveButton = form.querySelector('.confirm-remove');
            const cancelRemoveButton = form.querySelector('.cancel-remove');

            confirmationMessage.style.display = 'none';

            minusButton.addEventListener('click', () => {
                if (parseInt(countInput.value) === 1) {
                    confirmationMessage.style.display = 'block';
                } else {
                    countInput.value = parseInt(countInput.value) - 1;
                    form.submit();
                }
            });

            plusButton.addEventListener('click', () => {
                countInput.value = parseInt(countInput.value) + 1;
                form.submit();
            });

            confirmRemoveButton.addEventListener('click', () => {
                window.location.href = `/removeCartItem/${cartItemId}`;
            });

            cancelRemoveButton.addEventListener('click', () => {
                confirmationMessage.style.display = 'none';
            });
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>