@extends('admin.site.layout')
@section('1')
<div class="card bg-light">
    <div class="card-header bg-primary text-white">
        <h2 class="mb-0">Edit User: {{ $user->name }}</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <span class="form-control" id="name">{{ $user->name }}</span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <span type="email" class="form-control" id="email">{{ $user->email }}</span>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" name="role" id="role">
                    <option value="Student" {{ $user->role == 'Student' ? 'selected' : '' }}>Student</option>
                    <option value="Marketing Coordinator" {{ $user->role == 'Marketing Coordinator' ? 'selected' : '' }}>Marketing Coordinator</option>
                    <option value="University Marketing Manager" {{ $user->role == 'University Marketing Manager' ? 'selected' : '' }}>University Marketing
                        Manager</option>
                    <option value="Administrator" {{ $user->role == 'Administrator' ? 'selected' : '' }}>Administrator
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="faculty">Faculty:</label>
                <select class="form-control" name="faculty" id="faculty">
                    <option value="Business administration" {{ $user->faculty == 'Business administration' ? 'selected' : '' }}>Business administration
                    </option>
                    <option value="Graphics and Digital Design" {{ $user->faculty == 'Graphics and Digital Design' ? 'selected' : '' }}>Graphics and Digital
                        Design</option>
                    <option value="Information technology" {{ $user->faculty == 'Information technology' ? 'selected' : '' }}>Information technology
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection