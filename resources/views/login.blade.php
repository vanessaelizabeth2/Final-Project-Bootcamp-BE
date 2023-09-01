<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto 0;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .login-heading {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }
        .login-form {
            padding: 10px;
        }
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }
        .form-label {
            position: absolute;
            top: -10px;
            left: 15px;
            padding: 0 5px;
            background-color: #ffffff;
            color: #007bff;
        }
        .form-control {
            border-color: #555555;
            padding-top: 18px;
            padding-right: 15px;
            padding-left: 15px;
            padding-bottom: 10px
        }
        .btn-login {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
        .alert-danger {
            margin-top: 5px;
            color: #dc3545;
        }
    </style>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h1 class="login-heading">Login</h1>
            <form class="login-form" method="POST" action="{{ route('authenticate') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
