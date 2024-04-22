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
<a href="{{ route('download.contributions') }}" class="btn btn-primary">Download All Contribution</a>
<div class="card bg-primary text-white">
    <div class="card-header">List Contribution</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    <ul>
                        @foreach ($contributions as $contribution)
                        <tr>
                            <td style="color: black;width: auto; height:fit-content">{{ $contribution->status }}</td>
                            <td style="color: black;width: auto; height:fit-content">{{ $contribution->title }}</td>
                            <td style="color: black;width: auto; height:fit-content">{{ $contribution->content }}</td>
                            <td style="color: black; width:auto; height:auto">
                                @if ($contribution->image_path)
                                <img src="{{ asset('storage/' . $contribution->image_path) }}" alt="Contribution Image" style="max-width: 100%">
                                @endif
                            </td>
                            <td style="color: black; width: 500px; height: 100px;">
                                @if (isset($htmlContents[$contribution->id]))
                                <div style="width: 1200px; height:300px; overflow: auto;">
                                    {!! $htmlContents[$contribution->id] !!}
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection