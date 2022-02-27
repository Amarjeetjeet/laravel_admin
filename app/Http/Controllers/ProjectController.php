<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function Project_view(){
        $projects = Project::all();
        return view('admin.project', compact('projects'));
    }

    public function delete_project($id)
    {
        Project::where('id', $id)->delete();
        return json_encode(array("statusCode"=>200));
    }

    public function add_project(Request $req){
        $projects = new Project;
        $projects->project_name = $req->project_name;
        $projects->deadline = $req->project_deadline;
        $projects->save();
        return redirect('admin/project');
    }
}
