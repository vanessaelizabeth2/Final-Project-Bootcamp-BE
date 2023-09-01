<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Add Products</title>
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
    

    <form class="m-5" method="POST" action="{{ route('storeProduct') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Product Category</label>
            <select class="form-select" id="category" name="category">
                <option value="" selected disabled>Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
            </select>
            @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>        
        <div class="mb-3">
            <label for="product-name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product-name" name= "productName">
            @error('productName')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <div class="input-group">
                <span class="input-group-text">Rp. </span>
                <input type="number" class="form-control" id="price" name="price">
                @error('price')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>        
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name= "quantity">
            @error('quantity')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="product-img" class="form-label">Product's Image</label>
            <input type="file" class="form-control" id="product-img" name="image">
            @error('image')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>