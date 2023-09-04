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

        .navbar-toggler-icon {
            background-color: #007bff;
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
                        <a class="nav-link {{ Request::route()->getName() === 'cart' ? 'active' : '' }}" href="{{ route('viewCart') }}">Your Cart</a>
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
    
    <form class="m-5" method="POST" action="{{ route('updateProduct', ['id' => $product->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="category" class="form-label">Product Category</label>
            <select class="form-select" id="category" name="category">
                <option value="" disabled>Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->categoryId == $category->id ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
            @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>           
        <div class="mb-3">
            <label for="product-name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product-name" name= "productName" value="{{$product->productName}}">
            @error('productName')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <div class="input-group">
                <span class="input-group-text">Rp. </span>
                <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}">
                @error('price')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>        
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name= "quantity" value="{{$product->quantity}}">
            @error('quantity')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="product-img" class="form-label">Product's Image</label>
        
            @if ($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                <p>Current Image: {{ $product->image }}</p>
            @else
                <p>No image available for this product.</p>
            @endif
        
            <input type="file" class="form-control" id="product-img" name="image">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
             
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
