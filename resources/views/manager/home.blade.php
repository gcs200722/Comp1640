@extends('layout.main')
@section('2')
<div style="text-align: center;">
    <h4 style="color: aliceblue;">Home Manager</h4>
</div>
<div class="wrapper row2" style="margin-top: 20px;">
    <div class="rounded">
        <nav id="mainav" class="clear">
            <ul class="clear">
                <li><a class="active" href="{{ route('manager.contribution') }}">Contribution</a></li>
                <li><a class="active" href="{{ route('manager.home') }}">Home</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection