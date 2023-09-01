<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .product-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            color: #333;
        }

        .btn-danger {
            background-color: #d9534f;
            border-color: #d9534f;
        }

        .btn-danger:hover {
            background-color: #c9302c;
            border-color: #ac2925;
        }

        .btn-primary {
            background-color: #337ab7;
            border-color: #2e6da4;
        }

        .btn-primary:hover {
            background-color: #286090;
            border-color: #204d74;
        }
    </style>
    <title>Delete Product</title>
</head>
<body>
    <div class="container">
        <div class="card product-card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Are you sure you want to delete?</h5>
            </div>
            <form action="{{ route('deleteProduct', ['id'=>$product->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('editPage') }}" class="btn btn-primary">Cancel</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
