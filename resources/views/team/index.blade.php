@extends('layout.master')

@section('title', 'Team')

@section('card-title')
<h3 class="card-title">Team</h3>
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
@endpush

@section('content')

<div>
    <a class="btn btn-primary ml-2 my-2" href="/team/create">Add Team</a>
</div>
<div class="mx-2">
    <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name </th>
            <th>Email</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($team as $key => $item )
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>
                @if($item->photo != Null)
                <div>
                    <img class="img-profile rounded-circle mb-3"
                    src="{{ asset('/photo') }}/{{ $item->photo }}" width="50px" height="50px"
                    alt="User profile picture">
                </div>
                @else
                <div>
                    <img class="img-profile rounded-circle mb-3"
                    src="{{ asset('/photo/user.png') }}" width="50px" height="50px"
                    alt="User profile picture">
                </div>
                @endif
            </td>
            <td>
                <form action="/team/{{ $item->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-warning btn-sm" href="/team/{{ $item->id }}/edit">Edit</a>
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @empty
        <h2 class="ml-2">Team Not Found</h2>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th>No.</th>
            <th>Name </th>
            <th>Email</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
</div>


@endsection

@push('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
    });
</script>
@endpush
