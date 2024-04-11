@extends('layout.main')

@section('2')
    <div class="row justify-content-center">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="deadline-notification">
            <p>Deadline for submission: {{ $submissionDate->closed_at }}</p>
            <p>Please submit your contribution before this date to ensure it is considered.</p>
        </div>
        <div class="col-md-8">
            <div class="card bg- text-white">
                <h5 class="card-header">Contribution Submit</h5>
                <div class="card-body">
                    <table class="table table-bordered w-90 mx-auto">
                        <form action="{{ route('contributions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="title">Title:</label><br>
                            <input type="text" style="color: rgb(34, 19, 17)" id="title" name="title"><br>

                            <label for="content">Content:</label><br>
                            <textarea style="color: rgb(34, 29, 24)" id="content" name="content" rows="4" cols="50"></textarea><br>

                            <label for="image">Image:</label><br>
                            <input type="file" id="image" name="image"><br>

                            <label for="word_file">Word File:</label><br>
                            <input type="file" id="word_file" name="word_file"><br>

                            <button type="submit">Submit</button>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
