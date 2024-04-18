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
                            <th>Word File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <ul>
                            @foreach ($contributions as $contribution)
                                <tr>
                                    <td style="color: black">{{ $contribution->status }}</td>
                                    <td style="color: black">{{ $contribution->title }}</td>
                                    <td style="color: black">{{ $contribution->content }}</td>
                                    <td>
                                        @if ($contribution->image_path)
                                            <img src="{{ asset('storage/' . $contribution->image_path) }}"
                                                alt="Contribution Image" style="max-width: 200px;">
                                        @endif
                                    </td>
                                    <td style="color: black">
                                        @if (isset($htmlContents[$contribution->id]))
                                            <div style="width: 400px; height: 200px; overflow: auto;">
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
