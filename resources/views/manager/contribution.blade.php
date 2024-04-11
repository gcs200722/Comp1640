@extends('layout.main')
@section('2')
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
                <li>
                    @if ($contribution->word_file_path)
                        <a href="{{ asset('storage/' . $contribution->word_file_path) }}" download>Download Word File</a><br>
                    @endif

                    <form method="post" action="{{ route('approve', $contribution->id) }}">
                        @csrf
                        @method('put')
                        <button class="btn btn-primary" type="submit">Approve</button>
                    </form>

                    <form method="post" action="{{ route('reject', $contribution->id) }}">
                        @csrf
                        @method('put')
                        <button class="btn btn-danger" type="submit">Reject</button>
                    </form>
                </li>
                <!-- Hiển thị tệp tin Word nếu có -->

                </li>
            @endforeach
        </ul>
        <div class="pagination">
            {{ $contributions->links() }}
        </div>
        </div>
    </ul>
@endsection
