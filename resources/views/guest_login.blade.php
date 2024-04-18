<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('/pages/login/style/style.css') }}">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <header>Sign in</header>
            <form action="" method="post">
                @csrf
                <div class="field input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div>
                    <label for="faculty">Faculty</label>
                    <select name="faculty" id="faculty">
                        <option value="Business administration">Business Administration</option>
                        <option value="Graphics and Digital Design">Graphics and Digital Design</option>
                        <option value="Information technology">Information Technology</option>
                    </select>
                </div>
                <div class="field ">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
