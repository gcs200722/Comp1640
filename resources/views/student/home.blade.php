@extends('layout.main')
@section('2')

    <head>
        <div style="text-align: center;">
            <h4 style="color: aliceblue;">Home Student-{{ $user->faculty }}</h4>
        </div>
        <div class="wrapper row2">
            <div class="rounded">
                <nav id="mainav" class="clear">
                    <ul class="clear">
                        <li><a class="active" href="{{ route('student.submit') }}">Contribution</a>
                        <li><a class="active" href="{{ route('student.home') }}">Home</a></li>
                        <li><a class="active" href="{{ route('student.show') }}">Contribution Show</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </head>

    <body>
        HOME PAGE
    </body>
@endsection
