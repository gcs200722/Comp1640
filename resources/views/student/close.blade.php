@extends('layout.main')
@section('2')
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
    <div class="col-md-8" style="box-align: 500px">The submission portal is temporarily closed. Please wait until it reopens
        on the following day : {{ $submissionDate->reopen_at }}</div>
@endsection
