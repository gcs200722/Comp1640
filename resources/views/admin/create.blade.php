@extends('admin.site.layout')
@section('1')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('css/admin.css') }}">
    <title>Create</title>
    <style>
        .field {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            /* Để tạo khoảng cách giữa các field */
        }

        .field label {
            width: 125px;
            /* Điều chỉnh chiều rộng cố định cho nhãn */
            margin-right: 10px;
            /* Tạo khoảng cách giữa nhãn và trường input */
        }



        .container {
            background-color: #fff;
            color: #fff;
            text-align: center;
            position: relative;
            align-items: center;
            display: flex;
            justify-content: center;
            margin-top: 300px;
            border-radius: 30px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        label {
            display: block;
            /* Đảm bảo mỗi nhãn nằm trên một dòng riêng biệt */
            margin-bottom: 5px;
            /* Tạo khoảng cách dưới của mỗi nhãn */
            font-weight: bold;
            /* Đậm chữ */
            color: #333;
            /* Màu chữ */
            font-family: Arial, sans-serif;
            /* Font chữ */
        }

        select option {
            background-color: #f5f5f5;
            /* Màu nền */
            color: #333;
            /* Màu chữ */
            font-family: Arial, sans-serif;
            /* Font chữ */
            font-size: 14px;
            /* Cỡ chữ */
            padding: 5px 10px;
            /* Khoảng cách nội dung từ viền */
            border-radius: 5px;
            /* Bo tròn góc */
        }

        select option:hover {
            background-color: #e0e0e0;
            /* Màu nền khi di chuột qua */
        }


        .box form-box {
            background-color: #fff;
        }

        h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="box form-box">
            <h1>Create user</h1>
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="field input">
                    <label for="name"> Name</label>
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
                    <label for="confirm_password">Confirm pasword</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                @error('password')
                <small>{{ $message }}</small>
                @enderror
                <div>
                    <label for="role">Role:</label>
                    <select name="role" id="role">
                        <option value="Student">Student</option>
                        <option value="Marketing Coordinator">Marketing Coordinator</option>
                        <option value="University Marketing Manager">University Marketing Manager</option>
                        <option value="administrator">Administrator</option>
                    </select>
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

                    <button type="submit" class="btn">Submit</button>
                </div>
            </form>
        </div>
    </div>


</body>


@endsection