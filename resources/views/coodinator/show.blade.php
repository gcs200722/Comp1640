@extends('layout.main')
@section('2')
    <style>
        .contribution-box {
            border: 1px solid #ccc;
            padding: 300px;
            margin-bottom: 10px;
            width: auto;
            /* Chiều rộng của hộp */
            height: auto;
        }

        .contribution-box .status {
            font-weight: bold;
        }

        .contribution-box .title {
            font-size: 18px;
            margin-top: 10px;
        }

        .contribution-box .content {
            margin-top: 10px;
        }

        .contribution-box .image img {
            max-width: 50%;
            height: auto;
            margin-top: 10px;
        }

        .contribution-box .preview {
            width: 100%;
            height: 300px;
            overflow: auto;
            margin-top: 10px;
        }

        .contribution-box .comment {
            width: 100%;
            height: 300px;
            s margin-top: 10px;
        }
    </style>

    <div class="contribution-box">
        <div class="status">Status: {{ $contribution->status }}</div>
        <div class="title">Title: {{ $contribution->title }}</div>
        <div class="content">Content: {{ $contribution->content }}</div>
        <div class="image">Image: <br>
            @if ($contribution->image_path)
                <img src="{{ asset('storage/' . $contribution->image_path) }}" alt="Contribution Image">
            @endif
        </div>
        <div class="preview">
            @if (isset($htmlContents))
                <div class="preview-content">
                    {!! $htmlContents !!}
                </div>
            @endif
        </div>
        <div class="comment">
            <form action="{{ route('comment', $contribution->id) }}" method="post">
                @csrf @method('Put')
                <div class="form-group">
                    <label for="content">Comment:</label>
                    <textarea style="color: black" class="comment" id="content" name="content" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
