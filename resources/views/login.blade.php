<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('/pages/login/style/style.css') }}">
    <title>Login</title>
</head>

<body>
    @if (session()->has('error'))
        <div class="alert alert-success">
            {{ session()->get('error') }}
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="container">
        <div class="box form-box">
            <header>Sign in</header>
            <form action="" method="post">
                @csrf
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>
                @error('email')
                    <small>{{ $message }}</small>
                @enderror

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                @error('password')
                    <small>{{ $message }}</small>
                @enderror

                <div class="field ">

                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="{{ route('register') }}">Sign Up Now</a>
                </div>
                <div class="links">
                    <a href="{{ route('guest.login') }}">Login with Guest</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
