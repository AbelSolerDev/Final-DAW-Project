@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

<div class="text-center">
    <h1>{{ $title }}</h1>
</div>
<div class="container my-2 text-center">
    <p>{{ $description }}</p>
</div>
<div class="container">
        <div class="row">
            <div class="col-md-6 text-right">
                    <a href="{{ route('admin.index') }}" class="btn btn-success button-border">
                        Back
                    </a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h3>List of Users</h3>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('admin.createUser') }}" class="btn btn-primary button-border">
                        Create User
                    </a>
                </div>
            </div>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                                @if($user->id != 1) 
                                    <td class="d-flex align-items-center">
                                        <a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-info mr-2">Edit</a>
                                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                @else
                                    <td class="d-flex align-items-center">
                                        <a href="#" class="btn btn-info mr-2">Not Edit</a>
                                    </td>   
                                @endif
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

        <!--
        <div class="container">
            <div class="col-6">
                <a href="{{ route('admin.index') }}" class="btn btn-success button-border">
                    back
                </a>
            </div>
        </div>

        <script>
            document.getElementById('delete-user-form').addEventListener('submit', function() {
                if (confirm('Are you sure you want to delete this user?')) {
                    location.reload();
                }
            });
        </script>-->


@endsection

