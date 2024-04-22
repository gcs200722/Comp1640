@extends('layout.main')
@section('2')
<style>
    .btn-container {
        display: flex;
    }

    .btn-container form {
        margin-right: 10px;
        /* Khoảng cách giữa các nút */
    }

    .btn {
        /* display: inline-block; */
        padding: 8px 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f0f0f0;
        color: #333;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .btn:hover {
        background-color: #ddd;
        color: #000;
        border-color: #999;
    }
</style>
<div class="wrapper row2">
    <div class="rounded">
        <nav id="mainav" class="clear">
            <ul class="clear">
                <li><a class="active" href="{{ route('contribution') }}">Contribution</a></li>
                <li><a href="{{ route('contribution.approve') }}">Approved Contribution</a></li>
                <li><a href="{{ route('contribution.rejected') }}">Rejected Contribution</a></li>
                <li class="active"><a href="{{ route('coodinator.home') }}">Home</a></li>
            </ul>
        </nav>
    </div>
</div>
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
                        <th>Actions</th>
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
                                <img src="{{ asset('storage/' . $contribution->image_path) }}" alt="Contribution Image" style="max-width: 200px;">
                                @endif
                            </td>
                            <td style="color: black">
                                @if (isset($htmlContents[$contribution->id]))
                                <div style="width: 400px; height: 200px; overflow: auto;">
                                    {!! $htmlContents[$contribution->id] !!}
                                </div>
                                @endif
                            </td>
                            <td>
                                <form method="post" action="{{ route('approve', $contribution->id) }}">
                                    @csrf @method('put')
                                    <button class="btn ">approve</a></button>
                                </form>
                                <form method="post" action="{{ route('reject', $contribution->id) }}">
                                    @csrf @method('put')
                                    <button class="btn ">Reject</a></button>
                                </form>
                                <form method="post" action="{{ route('delete', $contribution->id) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn" type="submit">Delete</a></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection