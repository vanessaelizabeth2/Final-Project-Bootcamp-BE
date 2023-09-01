<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
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
    
    <div class="product-container d-flex flex-wrap justify-content-left mt-5">
        @foreach ($products as $product)
        <div class="card product-card m-3" style="width: 18rem;">
            <img src="{{ asset('storage/products/' . $product->image) }}" class="img-fluid" alt="products-image">
            <div class="card-body">
                <h5 class="card-title">{{ $product->productName }}</h5>
                <p class="card-text"><strong>Category: </strong>{{ $product->category->category }}</p>
                <p class="card-text"><strong>Price: Rp </strong> {{ $product->price }}</p>
                <p class="card-text"><strong>Quantity: </strong> {{ $product->quantity }}</p>
                {{-- <a href="{{route ('bookDetail', ['id'=>$book->id])}}" class="btn btn-primary">See More Detail</a> --}}
                <div class="mt-2">
                    <a href="{{ route('editProduct', ['id' => $product->id]) }}" class="btn btn-success">Update</a>
                    <a href="{{route('confirmDelete', ['id'=>$product->id]) }}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>