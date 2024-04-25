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
                    <li><a href="{{ route('guest.IT') }}">Home</a></li>
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

    <div class="wrapper row2" style="color: rgb(52, 51, 50)">
        <div class="rounded">
            <nav id="mainav" class="clear">
                <ul class="clear">
                    <h2>Approve Contribution Of Maketing</h2>
                </ul>
            </nav>
        </div>

    </div>
    <ul>
        @foreach ($contributions as $contribution)
            <li>
                <strong>Title:</strong> {{ $contribution->title }}<br>
                <strong>Content:</strong> {{ $contribution->content }}<br>
                <!-- Hiển thị hình ảnh nếu có -->
                @if ($contribution->image_path)
                    <img src="{{ asset('storage/' . $contribution->image_path) }}" alt="Contribution Image"
                        style="max-width: 200px;"><br>
                @endif
                @if (isset($htmlContents[$contribution->id]))
                    <div style="width: 600px; height: 400px; overflow: auto ; color:rgb(132, 144, 155)">
                        {!! $htmlContents[$contribution->id] !!}</div>
                @endif
                <!-- Hiển thị tệp tin Word nếu có -->
            </li>
        @endforeach
    </ul>
    <div class="pagination">
        {{ $contributions->links() }}
    </div>
    </div>

    <script src="{{ url('layout/scripts/jquery.min.js') }}"></script>
    <script src="{{ url('layout/scripts/jquery.fitvids.min.js') }}"></script>
    <script src="{{ url('layout/scripts/jquery.mobilemenu.js') }}"></script>
    <script src="{{ url('layout/scripts/tabslet/jquery.tabslet.min.js') }}"></script>
</body>

</html>
