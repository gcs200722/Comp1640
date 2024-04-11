@extends('layout.main')
@section('2')
    <div class="wrapper row2" style="margin-top: 20px;">
        <div class="rounded">
            <nav id="mainav" class="clear">
                <ul class="clear">
                    <li><a class="active" href="{{ route('manager.contribution') }}">Contribution</a></li>
                    <li class="active"><a href="{{ route('manager.home') }}">Home</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
