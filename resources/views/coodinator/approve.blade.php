@extends('layout.main')
@section('2')
    <div class="wrapper row2">
        <div class="rounded">
            <nav id="mainav" class="clear">
                <ul class="clear">
                    <li><a class="active" href="{{ route('contribution') }}">Contribution</a></li>
                    <li><a href="{{ route('contribution.approve') }}">Approved Contribution</a></li>
                    <li><a href="{{ route('contribution.rejected') }}">Rejected Contribution</a></li>
                    <li class="active"><a href="{{ route('coodinator.home') }}">Home</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="wrapper row2" style="color: rgb(52, 51, 50)">
        <div class="rounded">
            <nav id="mainav" class="clear">
                <ul class="clear">
                    <h2>Approve Contribution</h2>
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
@endsection
