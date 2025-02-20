@extends('moonshine::layouts.app')

@section('title', 'Users Management')

@section('content')
    <div class="overflow-hidden card">
        <div class="p-6">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users ?? [] as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <a href="#" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>
                                        <form action="#" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
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
@endsection
