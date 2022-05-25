@extends('layout.master')

@section('title', 'Team')

@section('card-title')
<h3 class="card-title">Add Project</h3>
@endsection
@section('content')
<form action="/project" method="POST" id="form" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">Project Name</label>
            <input
                type="text"
                class="form-control"
                name="name"
                id="name"
                placeholder="input project name"
                value="{{ old('name', '') }}"
            />
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="client">Client</label>
            <input
                type="text"
                class="form-control"
                name="client"
                id="client"
                placeholder="input client name"
                value="{{ old('client', '') }}"
            />
            @error('client')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="team" class="form-label">Team</label>
            <select class="form-select" name="team" id="team" aria-label="Default select example">
                <option selected>--Choose Team--</option>
                @foreach ($team as $key=>$item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('team')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="startDate" class="col-md-4 col-form-label">Start Date</label>
            <input type="text" class="form-control @error('start') is-invalid @enderror" name="start" id="startDate" onfocus="(this.type='date')" onblur="(this.type='text')" required>
            <div class="invalid-feedback">
                Start date must be before end date.
            </div>
        </div>
        <div class="form-group">
            <label for="endDate" class="col-md-4 col-form-label">End Date</label>
            <input type="text" class="form-control @error('end') is-invalid @enderror" name="end" id="endDate" onfocus="(this.type='date')" onblur="(this.type='text')" required>
            <div class="invalid-feedback">
                End date must be before end date.
            </div>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Save Project</button>
    </div>
</form>
@endsection
