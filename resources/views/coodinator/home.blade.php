@extends('layout.main')
@section('2')
    <div style="text-align: center;">
        <h4 style="color: aliceblue;">Home Coordinator - {{ $user->faculty }}</h4>
    </div>
    <div class="wrapper row2" style="margin-top: 20px;">
        <div class="rounded">
            <nav id="mainav" class="clear">
                <ul>
                    <li><a href="#">Contribution</a>
                        <ul>
                            <li><a class="active" href="{{ route('contribution') }}">Pending</a></li>
                            <li><a href="{{ route('contribution.approve') }}">Approved Contribution</a></li>
                            <li><a href="{{ route('contribution.rejected') }}">Rejected Contribution</a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="{{ route('coodinator.home') }}">Home</a></li>
                    <li class="active"><a href="{{ route('coodinator.dashboard') }}">Dashboard</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
