@extends('admin.site.layout')
@section('1')
    <h2>Contributions</h2>
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
                    {!! $htmlContents[$contribution->id] !!}
                @endif
                <!-- Hiển thị tệp tin Word nếu có -->
                @if ($contribution->word_file_path)
                    <a href="{{ asset('storage/' . $contribution->word_file_path) }}" download>Download Word File</a><br>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
