<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Magazine Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.ico') }}" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://www.oxfordinternationaleducationgroup.com/wp-content/uploads/2022/06/Banner-4.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed
        }
    </style>

</head>

<body>
    <div class="container-scroller">

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.home') }}">
                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/12/Icon-Truong-Dai-hoc-Greenwich-Viet-Nam.png"
                        alt="logo" style="width: auto; height: 70px;" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto font-weight-bold fs-5 ">
                        <li class="nav-item ms-5">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="nav-link" href="{{ route('user.index') }}">List User</a>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="nav-link" href="{{ route('submission_date.index') }}">Submission date</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://img.freepik.com/premium-vector/young-smiling-man-avatar-man-with-brown-beard-mustache-hair-wearing-yellow-sweater-sweatshirt-3d-vector-people-character-illustration-cartoon-minimal-style_365941-860.jpg"
                                    alt="avatar img" style="width: auto; height: 50px" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#"><i
                                            class="mdi mdi-cached me-2 text-success"></i> Activity Log</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                            class="mdi mdi-logout me-2 text-primary"></i> Sign out</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>


        <!-- partial -->
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ url('assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{ url('assets/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ url('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ url('assets/js/off-canvas.js') }}"></script>
        <script src="{{ url('assets/js/hoverable-collapse.js') }}"></script>
        <script src="{{ url('assets/js/misc.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{ url('assets/js/dashboard.js') }}"></script>
        <script src="{{ url('assets/js/todolist.js') }}"></script>
        @yield('1')
        <!-- End custom js for this page -->
</body>

</html>
