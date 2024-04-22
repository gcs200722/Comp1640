<!DOCTYPE html>
<html>

<head>
    <title>University</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="{{ url('layout/styles/layout.css') }}" rel="stylesheet" type="text/css" media="all">
    <!-- <style>
        body {
            background-image: url('https://careerset.com/assets/university-assets/greenwich/greenwich-logo.png?v=1');
            background-size: contain;
            background-attachment: fixed;

        }
    </style> -->

</head>

<body id="top">


    <div class="wrapper row0">
        <div id="topbar" class="clear">
            <nav>
                <ul>
                    <li>
                        <div id="logo" class="fl_right">
                            <a href="{{ route('logout') }}">Sign Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="wrapper row1">
        <header id="header" class="clear">
            <div id="logo" class="fl_left">
                <a href=""><img src="https://careerset.com/assets/university-assets/greenwich/greenwich-logo.png?v=1" alt="" style="width: 200px;"></a>

                <!-- <h1><a href="#">University</a></h1> -->
                <p style="margin-left: 40px;"> University magazine</p>
            </div>
        </header>
    </div>


    @yield('2')
    <script src="{{ url('layout/scripts/jquery.min.js') }}"></script>
    <script src="{{ url('layout/scripts/jquery.fitvids.min.js') }}"></script>
    <script src="{{ url('layout/scripts/jquery.mobilemenu.js') }}"></script>
    <script src="{{ url('layout/scripts/tabslet/jquery.tabslet.min.js') }}"></script>
</body>

</html>