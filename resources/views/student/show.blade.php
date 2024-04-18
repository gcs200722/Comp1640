@extends('layout.main')
@section('2')
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
    <div class="card bg-primary text-white">
        <div class="card-header">List Contribution</div>
        <div class="card-body">
            <a href="{{ route('student.submit') }}" class="btn btn-success mb-3">Create Contribution</a>
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
                                        <div style="width: 400px; height: 200px; overflow: auto;">{!! $htmlContents[$contribution->id] !!}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Chỉnh Sửa</a>
                                    <form method="post" action="{{ route('user.destroy', $user->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
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
