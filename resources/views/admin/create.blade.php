@extends('admin.site.layout')
@section('1')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="{{ url('css/admin.css') }}"> -->
        <title>Create</title>

    </head>
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 mt-5">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        Create user
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                                @error('name')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                                @error('email')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role:</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="Student">Student</option>
                                    <option value="Marketing Coordinator">Marketing Coordinator</option>
                                    <option value="University Marketing Manager">University Marketing Manager</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                            </div>

                            <div class="mb-3" id="faculty-div">
                                <label for="faculty" class="form-label">Faculty</label>
                                <select name="faculty" id="faculty" class="form-select">
                                    <option value="Business administration">Business Administration</option>
                                    <option value="Graphics and Digital Design">Graphics and Digital Design</option>
                                    <option value="Information technology">Information Technology</option>
                                    <option value="Maketing">Maketing</option>
                                    <option value="Public Relation">Public Relation</option>
                                </select>
                            </div>

                            <script>
                                // Lắng nghe sự kiện khi người dùng thay đổi giá trị của phần tử select với id="role"
                                document.getElementById('role').addEventListener('change', function() {
                                    var role = this.value; // Lấy giá trị của phần tử select

                                    // Kiểm tra xem vai trò có phải là "Administrator" hoặc "University Marketing Manager" không
                                    if (role === 'Administrator' || role === 'University Marketing Manager') {
                                        // Nếu là vai trò "Administrator" hoặc "University Marketing Manager", ẩn phần tử select với id="faculty"
                                        document.getElementById('faculty-div').style.display = 'none';
                                    } else {
                                        // Nếu không phải là vai trò "Administrator" hoặc "University Marketing Manager", hiển thị phần tử select với id="faculty"
                                        document.getElementById('faculty-div').style.display = 'block';
                                    }
                                });
                            </script>



                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
