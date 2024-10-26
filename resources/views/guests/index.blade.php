@extends('layouts.app')

@section('title', 'Guests List')

@section('content')
<div class="mt-4 p-5 bg-black text-white rounded">
    <h1>All Guests</h1>

    <a href="{{ route('guests.create') }}" class="btn btn-primary btn-sm">
        Create New Guest
    </a>
</div>


@if (session()->has('success'))
<div class="alert alert-success mt-4">
    {{ session()->get('success')  }}
</div>

@endif

<div class="container mt-5">
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Message</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($guests as $guest)
            <tr>
                <th scope="row">{{ $guest->id }}</th>
                <td>
                    <a href="{{ route('guests.show', $guest) }}">
                        {{ $guest->name }}
                    </a>
                </td>
                <td>{{ Str::limit($guest->message, 50, '...') }}</td>
                <td>{{ $guest->email }}</td>
                <td>{{ $guest->phone_number }}</td>
                <td>{{ $guest->created_at }}</td>
                <td>{{ $guest->updated_at }}</td>
                <td>
                    <a href="{{ route('guests.edit', $guest) }}" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                    <form action={{ route('guests.destroy', $guest) }} method="POST" class="d-inline-block">
                        @method('DELETE')
                        @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No guest found.</td>
            </tr>
            @endforelse
        </tbody>

    </table>
    <div class="d-flex justify-content-center">
        {!! $guests->links() !!}
    </div>
</div>
@endsection

