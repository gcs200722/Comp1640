@extends('admin.site.layout')
@section('1')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 mt-5">
            <div class="card-body mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                Edit Submission Dates
                            </div>
                            <div class="card-body">
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

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection