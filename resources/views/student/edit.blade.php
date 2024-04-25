@extends('layout.main')

@section('2')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ url('/pages/login/style/style.css') }}">
        <title>Contribution</title>
    </head>

    <div class="wrapper row2" style="margin-top: 20px;">
        <div class="rounded">
            <nav id="mainav" class="clear">
                <ul class="clear">
                    <li><a class="active" href="{{ route('student.submit') }}">Contribution</a></li>
                    <li class="active"><a href="{{ route('student.home') }}">Home</a></li>
                    <li class="active"><a href="{{ route('student.show') }}">Contribution Show</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="container">
            <div class="box form-box">
                <header style="color: black">
                    Edit : {{ $contribution->id }}
                </header>
                <form method="POST" action="{{ route('contribution.update', $contribution->id) }}">
                    @csrf
                    @method('PUT')

                    <label style="color: black" for="title">Title:</label><br>
                    <input style="color: black" id="title" name="title" value="{{ $contribution->title }}"><br>

                    <label style="color: black" for="content">Content:</label><br>
                    <textarea style="color: black" id="content" name="content" rows="4" cols="50">{{ old('content', $contribution->content) }}</textarea><br>

                    <label style="color: black" for="image">Image:</label><br>
                    <div id="imagePreview">
                        @if ($contribution->image_path)
                            <img src="{{ asset('storage/' . $contribution->image_path) }}" alt="Contribution Image"
                                style="max-width: 100%; margin-bottom: 10px;"><br>
                        @endif
                    </div>
                    <input style="color: black; width: 100%;" type="file" id="image" name="image"
                        onchange="previewImage()"><br>
                    <label style="color: black" for="word_file">Word File:</label><br>
                    <input style="color: black" type="file" id="word_file" name="word_file"><br>

                    <button class="btn-btn-primary" type="submit">Update</button>
                    <label style="color: black">Students please submit your contributions before the due date:
                        {{ $submissionDate->closed_at }}</label>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage() {
            var fileInput = document.getElementById('image');
            var imagePreview = document.getElementById('imagePreview');

            while (imagePreview.firstChild) {
                imagePreview.removeChild(imagePreview.firstChild);
            }

            var files = fileInput.files;
            if (files.length > 0) {
                var img = document.createElement('img');
                img.src = URL.createObjectURL(files[0]);
                img.style.maxWidth = '100%';
                img.style.marginBottom = '10px';
                imagePreview.appendChild(img);
            }
        }
    </script>
@endsection
