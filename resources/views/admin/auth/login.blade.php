<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    <title>Admin Login</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #003EA5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            max-width: 380px;
            width: 100%;
            padding: 2rem;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
        }
        .login-logo img {
            width: 100px;
            height: auto;
            margin-bottom: 1rem;
        }
        .login-card h4 {
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: #333;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 0.5rem;
        }
        .btn-primary:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>

    <div class="login-card text-center">
        <div class="login-logo">
            {{-- Replace with your logo path --}}
            @php $header_logo = App\Http\Helpers\GeneralHelper::getOption('header_logo') @endphp
            <img src="@if(!empty($header_logo))  {{ asset($header_logo) }} @else {!! asset('assets/images/logo-white.png') !!} @endif" alt="Site Logo">
        </div>
        <h4>Admin Login</h4>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>{{ $errors->first() }}</strong>
            </div>
        @endif

        <form method="POST" action="{{ url('admin/login') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember"> Remember me </label>
                </div>
                <!-- <a href="" class="small">Forgot Password?</a> -->
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
        </form>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
