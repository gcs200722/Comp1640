@extends('layout.main')

@section('2')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ url('/pages/login/style/style.css') }}">
        <title>Contribution</title>
        <div class="wrapper row2" style="margin-top: 20px;">
            <div class="rounded">
                <nav id="mainav" class="clear">
                    <ul class="clear">
                        <li><a class="active" href="{{ route('student.submit') }}">Contribution</a>

                        <li class="active"><a href="{{ route('student.home') }}">Home</a></li>
                        <li class="active"><a href="{{ route('student.show') }}">Contribution Show</a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </head>
    <div class="row justify-content-center">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="container">

            <div class="box form-box">
                <header style="color: black">
                    Submit
                </header>
                <form action="{{ route('contributions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label style="color: black" for="title">Title:</label><br>
                    <input style="color: black" type="text" id="title" name="title"><br>

                    <label style="color: black" for="content">Content:</label><br>
                    <textarea style="color: black" id="content" name="content" rows="4" cols="50"></textarea><br>

                    <label style="color: black" for="image">Image:</label><br>
                    <input style="color: black" type="file" id="image" name="image"><br>

                    <label style="color: black" for="word_file">Word File:</label><br>
                    <input style="color: black" type="file" id="word_file" name="word_file"><br>

                    <button class="btn-btn-primary" type="submit">Submit</button>
                    <label style="color: black">Students please submit your contributions before the due date:
                        {{ $submissionDate->closed_at }}</label>

                </form>
            </div>
        </div>
    </div>
@endsection
