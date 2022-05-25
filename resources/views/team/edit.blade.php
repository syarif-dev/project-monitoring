@extends('layout.master')

@section('title', 'Team')

@section('card-title')
<h3 class="card-title">Edit Team</h3>
@endsection
@section('content')
<form action="/team/{{ $team->id }}" method="POST" id="form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input
                type="text"
                class="form-control"
                name="name"
                id="name"
                value="{{ $team->name }}"
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
                value="{{ $team->email }}"
            />
            @error('name')
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
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>

@endsection
