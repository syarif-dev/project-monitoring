@extends('layout.master')

@section('title', 'Task')

@section('card-title')
<h3 class="card-title">Task</h3>
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
<style>
        /* toggle switch */
        .switch label{
            font-weight: normal;
            font-size: 13px;
            cursor: pointer;
        }
        .switch label input[type=checkbox]{
            opacity: 0;
            width: 0;
            height: 0;
        }
        .switch-col-blue{
            background-color: rgba(11, 32, 49, 0.5);
        }
        .switch label input[type=checkbox]:checked + .lever.switch-col-blue{
            background-color: rgba(33, 150, 243, 0.5);
        }
        .switch label .lever{
            margin: 0 14px;
            content: '';
            display: inline-block;
            position: relative;
            width: 40px;
            height: 15px;
            border-radius: 15px;
            transition: ease;
            vertical-align: middle;
        }
        .switch label input[type=checkbox]:checked + .lever.switch-col-blue:after {
            background-color: #2196F3;
            left: 24px;
        }
        .switch label .lever:after {
            content: "";
            position: absolute;
            display: inline-block;
            width: 21px;
            height: 21px;
            background-color: #F1F1F1;
            border-radius: 21px;
            box-shadow: 0 1px 3px 1px rgb(0 0 0 / 40%);
            left: -5px;
            top: -3px;
            transition: left 0.3s ease, box-shadow 0.1s ease;
        }
    </style>
@endpush

@section('content')

{{-- <div>
    <a class="btn btn-primary ml-2 my-2" href="{{ route('project.task.create', $project->id) }}">Add Task</a>
</div>
<input type="hidden" name="project_id" value="{{$project->id}}">
<div class="mx-2">
    <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Task</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($project->task as $key => $item )
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <form action="/task/{{ $item->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-warning btn-sm" href="/task/{{ $item->id }}/edit">Edit</a>
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @empty
        <h2 class="ml-2">Task Not Found</h2>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th>No.</th>
            <th>Task</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
</div> --}}
<div class="row">
        <div class="col">
            <div class="alert alert-success alert-dismissible fade show" id="alert-check" role="alert">
                <span id="alert-check-text"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bd-highlight">
                            <h3 class="mb-0">Project Task List {{ $project->name }}</h3>
                        </div>
                        <div class="bd-highlight ms-auto">
                            <form id="form-task" action="{{ route('task.store', ['project_id' => $project->id]) }}" method="POST">
                                <input type="hidden" name="_method" id="_method" value="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-7 px-0">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="input task" required>
                                    </div>
                                    <div class="col-5 ps-0 text-end">
                                        <button class="btn btn-primary" id="btn-task"><i class="bi bi-plus-square me-2"></i> Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive my-3">
                        <table class="table table-bordered table-primary table-striped table-hover py-3" id="table-task">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($project->task->count())
                                    @foreach ($project->task as $tasks)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $tasks->name }}</td>
                                            <td>
                                                <div class="switch">
                                                    <label>
                                                        <input type="checkbox" name="status" id="checkbox{{ $tasks->id }}" {{ $tasks->status == 1 ? 'checked' : '' }} onclick="check({{ $tasks->id }})">
                                                        <span class="lever switch-col-blue"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-nowrap">
                                                <button class="btn btn-success"onclick="editTask('{{ $tasks->id }}', '{{ $tasks->name }}')">Edit</button>
                                                <button class="btn btn-danger" onclick="deleteTask('{{ route('task.destroy', ['task' => $tasks->id]) }}')" data-bs-toggle="modal" data-bs-target="#modal-delete">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            No Task Found
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 flex-column pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <i class="fa fa-trash-alt text-danger"></i>
                    <h5 class="modal-title mt-3" id="deleteModalLabel">Delete data</h5>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col">
                            <p>are you sure delete this?</p>
                            <div class="my-4">
                                <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                                <form action="" id="action-id-delete" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-delete-data ms-1">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
    });
</script>
<script>
        $(document).ready(function() {
            $('#table-task').DataTable();
        });
        $(document).ready(function (){
            $('#alert-check').hide();
        });
        function editTask(task_id, name){
            $('#name-task').val(name);
            $('#name-task').attr('placeholder', 'Edit task');
            $('#_method').val('put');
            $('#form-task').attr('action', '/task/'+ task_id);
            $('#btn-task').html('<i class="bi bi-pencil-square me-2"></i> Ubah');
        }
        function check(id){
            let check = $('#checkbox'+ id);
            let val = check.is(':checked') ? true : false;
            console.log(check);
            console.log(val);
            $.ajax({
                type: 'GET',
                url: '{{ route('check') }}',
                data: {
                    "id" : id,
                    "val" : val,
                }, success: function(res) {
                    $('#alert-check-text').html(res.message);
                    $('#alert-check').show();
                }, error: function(err) {
                    console.log(err);
                }
            })
        }
    </script>
    <script>
        function deleteTask(url){
            $('#modal-delete').modal();
            let deleteForm = document.getElementById("action-id-delete");
            deleteForm.setAttribute("action", url)
        }
    </script>
@endpush
