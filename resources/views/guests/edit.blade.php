@extends('layouts.app')

@section('title', 'Update Guest')

@section('body')

<div class="mt-4 p-5 bg-black text-white rounded">
    <h1>Update Existing Guest</h1>
</div>

<div class="row my-5">
    <div class="col-12 px-5">
        @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('guests.update', $guest) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                    <label for="guest_name">Guest Name</label>
                    <input type="text" class="form-control" id="guest_name" placeholder="Guest Name" name="name" required value="{{ old('name', $guest->name) }}">
            </div>

            <div class="form-group">
                    <label for="guest_name">Guest Category</label>
                    <select class="form-select form-select-lg mb-3" name="category_id">
                        <option value="">No Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $guest->category_id ? "selected" : "" }}>
                            {{ $category->name }}</option>
                        @endforeach
                    </select>


            <div class="form-group">
                    <label for="guest_name">Guest Tags</label>
                    <select class="form-select form-select-lg mb-3" name="tags[]" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ $guest->tags->contains($tag->id) ? "selected" : "" }}>
                            {{ $tag->name }}</option>
                        @endforeach
                    </select>
            </div>
            </div>

            <div class="form-group">
                    <label for="guest_name">Message</label>
                    <input type="text" class="form-control" id="message" placeholder="Message" name="message" required value="{{ old('message', $guest->message) }}">
            </div>

            <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{ old('email', $guest->email) }}">
            </div>

            <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number', $guest->phone_number) }}">
            </div>

            <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" class="form-control" id="avatar"  name="avatar">
                    @if ($guest->avatar)
                        <img src={{ $guest->avatar_url }} class="mt-3" style="max-width: 400px;"/>
                    @endif
            </div>

            <button type="submit" class="btn btn-primary btn-block">Save</button>
        </form>
    </div>
</div>

@endsection
