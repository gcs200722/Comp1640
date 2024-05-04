@extends('admin.site.layout')
@section('1')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg- text-white ">

                <li class="card-header" style="color: black">Accounts List</li>
                <div class="card-body mt-5 ">
                    <table class=" table table-bordered border table-hover  mt-5  ">
                        <thead class="font-weight-bold ">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Faculty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <a href="{{ route('user.create') }}" style="font-weight: bold">Create New User</a>
                        <form action="" method="post">


                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        @if ($user->role !== 'Administrator' && $user->role !== 'University Marketing Manager')
                                            <td>{{ $user->faculty }}</td>
                                        @else
                                            <td class="hidden-cell">&nbsp;</td>
                                        @endif
                                        <td class="text-center">
                                            <div class="d-inline-block">
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="btn btn-primary btn-sm mx-1">Edit</a>
                                            </div>
                                            <div class="d-inline-block">
                                                <form method="post" action="{{ route('user.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm mx-1">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
