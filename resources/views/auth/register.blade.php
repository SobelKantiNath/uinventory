<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>NU-IMS Register Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
    <meta name="author" content="Zoyothemes"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        body, html {
            height: 100%;
        }
        .account-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-background {
            background: url('{{ asset("backend/assets/images/NationalUniversity.JPG") }}') no-repeat center center;
            background-size: cover;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255,255,255,0.9);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-white">

<div class="login-background">
    <div class="login-card">
        <div class="text-center mb-2">
            <a href="index.html" class="auth-logo">
                <img src="{{ asset('backend/assets/images/logo-nu.png') }}" alt="logo-nu" height="60" width="45" />
            </a>
        </div>
        <h3 class="text-center "> <b>National University</b> </h3>
        <h5 class="text-center mb-4">Inventory Management System (IMS)</h5>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group mb-1">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" type="name" name="name" id="name" required placeholder="Enter your name">
            </div>

            <div class="form-group mb-1">
                <label for="emailaddress" class="form-label">Email address</label>
                <input class="form-control" type="email" name="email" id="email" required placeholder="Enter your email">
            </div>

            <div class="form-group mb-1">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" type="password" name="password" id="password" required placeholder="Enter your password">
            </div>

            <div class="form-group mb-1">
                <label for="password" class="form-label">Confirm Password</label>
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required placeholder="Enter your confirm password">
            </div>

            <div class="form-group d-flex mb-2">
                <div class="ms-auto">
                    <a class="text-muted fs-14" href="{{ route('password.request') }}">Forgot password?</a>
                </div>
            </div>

            <div class="form-group mb-0">
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit"> Register </button>
                </div>
            </div>
        </form>

        <div class="text-center text-muted mt-3">
            <p class="mb-0">Already you have an account?
                <a class="text-primary ms-2 fw-medium" href="{{ route('login') }}">Sign In</a>
            </p>
        </div>
    </div>
</div>

<!-- Vendor JS -->
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>

<!-- App js-->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>

</body>
</html>
