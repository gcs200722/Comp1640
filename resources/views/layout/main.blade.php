<!DOCTYPE html>
<html>

<head>
    <title>University</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="{{ url('layout/styles/layout.css') }}" rel="stylesheet" type="text/css" media="all">
</head>

<body id="top">

    <div class="wrapper row0">
        <div id="topbar" class="clear">
            <nav>
                <ul>
                    <li><a href="{{ route('logout') }}">SignOut</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="wrapper row1">
        <header id="header" class="clear">
            <div id="logo" class="fl_left">
                <h1><a href="#">University</a></h1>
                <p>University magazine</p>
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
