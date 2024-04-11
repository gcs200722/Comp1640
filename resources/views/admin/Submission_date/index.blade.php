@extends('admin.site.layout')
@section('1')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg- text-white">
                <h5 class="card-header">Submission_Date</h5>
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header" style="color: rgb(21, 14, 2)">Edit Submission Dates</div>

                                    <div class="card-body">
                                        @foreach ($submissionDate as $submissionDate)
                                            <form method="POST"
                                                action="{{ route('submission_date.update', $submissionDate->id) }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="closed_at">Closed at:</label>
                                                    <input type="date" id="closed_at" name="closed_at"
                                                        class="form-control" value="{{ $submissionDate->closed_at }}"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="reopen_at">Reopen at:</label>
                                                    <input type="date" id="reopen_at" name="reopen_at"
                                                        class="form-control" value="{{ $submissionDate->reopen_at }}"
                                                        required>
                                                </div>
                                                <form method="post"
                                                    action="{{ route('submission_date.destroy', $submissionDate->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                <a href="{{ route('submission_date.edit', $submissionDate->id) }}"
                                                    class="btn btn-primary">Edit</a>

                                            </form>
                                        @endforeach
                                        <a href="{{ route('submission_date.create') }}" class="btn btn-primary">Create</a>
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
