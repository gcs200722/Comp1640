@extends('admin.site.layout')
@section('1')
<div class="container mt-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card-body mt-5">
                <div class="container mt-5">
                    <div class="row justify-content-center ">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-primary text-white">Submission Dates</div>
                                <div class="card-body">
                                    @foreach ($submissionDate as $submissionDate)
                                    <form method="POST" action="{{ route('submission_date.update', $submissionDate->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="closed_at" style="color: black">Closed at:</label>
                                            <input type="date" id="closed_at" name="closed_at" class="form-control" value="{{ $submissionDate->closed_at }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="reopen_at" style="color: black">Reopen at:</label>
                                            <input type="date" id="reopen_at" name="reopen_at" class="form-control" value="{{ $submissionDate->reopen_at }}" required>
                                        </div>
                                        <form method="post" action="{{ route('submission_date.destroy', $submissionDate->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <a href="{{ route('submission_date.edit', $submissionDate->id) }}" class="btn btn-primary mt-4">Edit</a>

                                    </form>
                                    @endforeach
                                    <a href="{{ route('submission_date.create') }}" class="btn btn-primary mt-4">Create</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection