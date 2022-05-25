@extends('layout.master')

@section('title', 'Team')

@section('card-title')
<h3 class="card-title">Add Team</h3>
@endsection
@section('content')
<form action="/team" method="POST" id="form" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input
                type="text"
                class="form-control"
                name="name"
                id="name"
                placeholder="input your name"
                value="{{ old('name', '') }}"
            />
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder="input your email"
                value="{{ old('email', '') }}"
            />
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="photo" class="text-md-right">{{ __('photo') }}</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
            @error('photo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Add Team</button>
    </div>
</form>

@endsection
