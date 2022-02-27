<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function employee_view(){
        $employees = Employee::all();
        return view('admin.employee', compact('employees'));
    }

    public function delete_employee($id)
    {
        Employee::where('id', $id)->delete();
        return json_encode(array("statusCode"=>200));
    }

     function employee_edit($id){
        $data = Employee::find($id);
        if($data){
            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'data' => "Data Not found",
            ]);
        }
    }

    //update data function
    function employee_update(Request $req,$id){
        // return $req->input('data');
        $emp = Employee::find($id);
        $emp->employee_name = $req->input('emp_name');
        $emp->employee_email = $req->input('emp_email');
        $emp->employee_password = $req->input('emp_password');
        $emp->update();
        if($emp){
            return response()->json([
                'status' => 200,
                'data' => $emp,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'data' => "Data Not found",
            ]);
        }
    }


    public function add_employee(Request $req){
        $emp = new Employee;
        $emp->employee_name = $req->emp_name;
        $emp->employee_email = $req->emp_email;
        $emp->employee_password = hash::make($req->emp_password);
        $emp->save();
        return json_encode(array("statusCode"=>200));
    }
}
