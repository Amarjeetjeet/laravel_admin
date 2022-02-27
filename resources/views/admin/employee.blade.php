<h1>Employee</h1>

@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
Employee Datatable
@stop
@section('content')

{{-- Minimal --}}
<x-adminlte-modal id="modalMin" title="Form">
    <form action="add_employee" method="POST" id="form_id">

            <div class="form-group">
                @csrf
                <label for="formGroupExampleInput">Add Employee</label>
                <input type="text"  class="form-control mb-3" id="emp_name" name="emp_name" placeholder="Write Name" required>
                <input type="email" class="form-control mb-3" id="emp_email" name="emp_email" placeholder="Write Email" required>
                <input type="password" class="form-control mb-3" id="emp_password" name="emp_password" placeholder="Write Password" required>
            </div>
            <br>
            <input type="submit" value="Save Employee" id="butsave"  class="btn btn-primary">

    </form>

</x-adminlte-modal>
{{-- Example button to open modal --}}
@can('add-employee',Auth::User())
<x-adminlte-button label="Add Employee" data-toggle="modal" data-target="#modalMin"/>
@endcan



{{-- update --}}
<x-adminlte-modal id="EdituserModel" title="Form">
<form  id="form_id">

    <div class="form-group">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <label for="formGroupExampleInput">Add Employee</label>
        <input type="text"  class="form-control mb-3" id="employee_id" name="emp_id" placeholder="Write Name" required>
        <input type="text"  class="form-control mb-3" id="employee_name" name="emp_name" placeholder="Write Name" required>
        <input type="email" class="form-control mb-3" id="employee_email" name="emp_email" placeholder="Write Email" required>
        <input type="password" class="form-control mb-3" id="employee_password" name="emp_password" placeholder="Write Password" required>
    </div>
    <br>
    <input type="submit" value="Save Employee" id="updateBtn"  class="btn btn-primary">

</form>

{{-- update --}}

</x-adminlte-modal>

{{-- <x-adminlte-button label="Add Employee" data-toggle="modal" data-target="#EdituserModel"/> --}}
@php
 $heads = [
     'ID',
     'Name',
     'Email',
      ['label' => 'Actions', 'no-export' => true, 'width' => 5],
      ['label' => 'Actions', 'no-export' => true, 'width' => 5],

 ];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="table1" :heads="$heads"  head-theme="light" theme="dark"
striped hoverable with-footer footer-theme="light" beautify>
    @foreach($employees as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->employee_name}}</td>
            <td>{{$row->employee_email}}</td>
            @can('edit-employee',Auth::User())
            <td><meta name="csrf-token" content="{{ csrf_token() }}"><button class="btn btn-xs btn-default text-primary mx-1 shadow Edit_data" data-id="{{$row->id}}" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
            </button></td>
            @endcan
            @can('delete-employee',Auth::User())
            <td><meta name="csrf-token" content="{{ csrf_token() }}"><button class="btn btn-xs btn-default text-danger mx-1 shadow deleteRecord" data-id="{{$row->id}}"  title="Delete">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button></td>
            @endcan
        </tr>
    @endforeach
</x-adminlte-datatable>

@stop

@section('js')
    <script> console.log('Hi!'); </script>


    <script>



$(document).on('click','#updateBtn', function (e) {
    console.log("clicked update");
    e.preventDefault();
    var token = $("meta[name='csrf-token']").attr("content");
    var stu_id = $('#employee_id').val();
    $.ajax({
        type: "put",
        url: "employee_update/"+stu_id,
        data: {
        "emp_name" : $('#employee_name').val(),
        "emp_email" : $('#employee_email').val(),
        "emp_password" : $('#employee_password').val(),
        "emp_id" : $('#employee_id').val(),
        _token: '{{csrf_token()}}',
        },
        success: function (response) {
            console.log(response);
            location.reload();
        }
    });
});

    $(document).on('click', '.Edit_data',function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    // alert(id);
    $('#EdituserModel').modal('show');
    $.ajax({
        type: "get",
        url: "employee_edit/"+id,
        success: function (response) {
            console.log(response);
            console.log(response.data.employee_name);
                $('#employee_name').val(response.data.employee_name);
                $('#employee_password').val(response.data.employee_password);
                $('#employee_email').val(response.data.employee_email);
                $('#employee_id').val(id);

        }
    });
});




    $(document).on('click','.deleteRecord', function () {
        console.log("yes");
        var id = $(this).data("id");
        console.log(id);
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            type: "get",
            url: "delete_employee/"+id,
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

