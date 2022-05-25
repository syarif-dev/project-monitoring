@extends('layout.master')

@section('title', 'Project')

@section('card-title')
<h3 class="card-title">Project</h3>
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
@endpush

@section('content')

<div>
    <a class="btn btn-primary ml-2 my-2" href="/project/create">Add Project</a>
</div>
<div class="mx-2">
    <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Project Name</th>
            <th>Client</th>
            <th>Project Leader</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Progress</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($project as $key => $item )
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->client }}</td>
            <td class="pt-0">
                <div class="d-flex align-items-center">
                    @if($item->team->photo != Null)
                    <div>
                        <img class="img-profile rounded-circle mr-2"
                        src="{{ asset('/photo') }}/{{ $item->team->photo }}" width="50px" height="50px"
                        alt="User profile picture">
                    </div>
                    @else
                    <div>
                        <img class="img-profile rounded-circle mr-2"
                        src="{{ asset('/photo/user.png') }}" width="50px" height="50px"
                        alt="User profile picture">
                    </div>
                    @endif
                    <div>
                        <p class="mb-0">{{ $item->team->name }}</p>
                        <p class="mb-0">{{ $item->team->email }}</p>
                    </div>
                </div>
            </td>
            <td>{{ $item->FormatStartDate }}</td>
            <td>{{ $item->FormatEndDate }}</td>
            <td style="width: 200px">
                @if ($item->task->count())
                    <div class="progress">
                        @if ($item->task->where('status', 1)->count() / $item->task->count()== 1)
                        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{ ( $item->task->where('status', 1)->count() / $item->task->count() ) * 100 }}%"></div>
                        @else
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{ ( $item->task->where('status', 1)->count() / $item->task->count() ) * 100 }}%"></div>
                        @endif
                    </div>
                    <div>
                        <p>{{ ( $item->task->where('status', 1)->count() / $item->task->count() ) * 100 }}%</p>
                    </div>
                @else
                    Not Progress
                @endif
            </td>
            <td>
                <form action="/project/{{ $item->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-info btn-sm" href="{{ route('task.index', ['project' => $item->id]) }}">Task</a>
                    <a class="btn btn-warning btn-sm" href="/project/{{ $item->id }}/edit">Edit</a>
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @empty
        <h2 class="ml-2">Project Not Found</h2>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th>Project Name</th>
            <th>Client</th>
            <th>Project Leader</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Progress</th>
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
