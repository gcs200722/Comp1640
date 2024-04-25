<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('/pages/login/style/style.css') }}">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <header>Register</header>
            <form action="" method="post">
                @csrf
                <div class="field input">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                @error('name')
                    <small>{{ $message }}</small>
                @enderror

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
                <div class="field input">
                    <label for="confirm_password">Confirm_pasword</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                @error('password')
                    <small>{{ $message }}</small>
                @enderror
                <div>
                    <label for="role">Role:</label>
                    <select name="role" id="role">
                        <option value="Student">Student</option>
                        <!-- <option value="Marketing Coordinator">Marketing Coordinator</option>
                        <option value="University Marketing Manager">University Marketing Manager</option>
                        <option value="administrator">Administrator</option>-->
                    </select>
                </div>
                <div>
                    <label for="faculty">Faculty</label>
                    <select name="faculty" id="faculty">
                        <option value="Business administration">Business Administration</option>
                        <option value="Graphics and Digital Design">Graphics and Digital Design</option>
                        <option value="Information technology">Information Technology</option>
                        <option value="Maketing">Maketing</option>
                        <option value="Public Relation">Public Relation</option>
                    </select>
                </div>
                <div class="field ">

                    <button type="submit" class="btn">Register</button>
                </div>
                <div class="links">
                    If you have account? <a href="{{ route('login') }}">Login now</a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>
