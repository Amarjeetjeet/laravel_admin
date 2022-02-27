<h1>Project</h1>

@extends('adminlte::page')

@section('title', 'Project')

@section('content_header')
Employee Datatable
@stop
@section('content')

{{-- Minimal --}}
<x-adminlte-modal id="modalMin" title="Form">
    <form action="add_project" method="POST" id="form_id">

            <div class="form-group">
                @csrf
                <label for="formGroupExampleInput">Add Employee</label>
                <input type="text"  class="form-control mb-3" id="project_name" name="project_name" placeholder="Write Name" required>
                <input type="date" class="form-control mb-3" id="emp_email" name="project_deadline" placeholder="Write Deadline" required>
            </div>
            <br>
            <input type="submit" value="Save Project" id="butsave"  class="btn btn-primary">

    </form>

</x-adminlte-modal>
{{-- Example button to open modal --}}
<x-adminlte-button label="Add Project" data-toggle="modal" data-target="#modalMin"/>
@php
$heads = [
    'ID',
    'Name',
    'Deadline',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="table1" :heads="$heads"  head-theme="light" theme="dark"
striped hoverable with-footer footer-theme="light" beautify>
    @foreach($projects as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->project_name}}</td>
            <td>{{$row->deadline}}</td>
            <td><a href="" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a></td>
            {{-- href="delete_employee/{{$row->id}}" --}}
            <td><meta name="csrf-token" content="{{ csrf_token() }}"><button class="btn btn-xs btn-default text-danger mx-1 shadow deleteRecord" data-id="{{$row->id}}"  title="Delete">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button></td>
        </tr>
    @endforeach
</x-adminlte-datatable>

@stop

@section('js')
    <script> console.log('Hi!'); </script>


    <script>
    $(document).on('click','.deleteRecord', function () {
        console.log("yes");
        var id = $(this).data("id");
        console.log(id);
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            type: "get",
            url: "delete_project/"+id,
            data: {
                "id": id,
            _token: '{{csrf_token()}}',
            },
            success: function (response) {
                location.reload();

                console.log("successfull");
            }
        });
    });

    </script>
@stop

