@extends('layouts.app')

@section('content')
<div class="mt-4 p-5 bg-primary text-white rounded">
    <h1>Biodata</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success mt-4">
    {{ session()->get('success') }}
</div>
@endif

<div class="my-4">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{ $user->name }}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{ $user->email }}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{ $user->biodata?->address ?? "Tidak Ada Data"}}
                    <!-- supaya mencegah error dari sisi php ketika berusaha menampilkan value bisa pakai sintaks null safe -->
                    <!-- tambahkan simbol null ?? supaya tidak mengeluarkan 0 untuk data null -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Website</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{ $user->biodata?->website ?? "Tidak Ada Data" }}
                    <!-- supaya mencegah error dari sisi php ketika berusaha menampilkan value bisa pakai sintaks null safe -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">About Me</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{ $user->biodata?->about_me ?? "Tidak Ada Data" }}
                    <!-- supaya mencegah error dari sisi php ketika berusaha menampilkan value bisa pakai sintaks null safe -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{route('biodata.edit') }}" class= "btn btn-secondary">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
