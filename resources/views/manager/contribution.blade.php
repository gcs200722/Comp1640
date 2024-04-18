@extends('layout.main')
@section('2')
    <div class="wrapper row2" style="margin-top: 20px;">
        <div class="rounded">
            <nav id="mainav" class="clear">
                <ul class="clear">
                    <li class="active"><a href="{{ route('manager.home') }}">Home</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <h2>Contributions</h2>
    <ul>
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
                </li>
            @endforeach
        </ul>
        <div class="pagination">
            {{ $contributions->links() }}
        </div>
        </div>
    </ul>
    <a href="{{ route('download.contributions') }}" class="btn btn-primary">Tải xuống tất cả đóng góp</a>
@endsection
