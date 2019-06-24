<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Job;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('pm.project.index', compact('projects'));
    }

    public function create()
    {
        return view('pm.project.tambah');
    }

    public function store(Request $request)
    {
        $project = new Project([
            'name' => $request->project
        ]);
        $project->save();

        return redirect('/project');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $project = Project::find($id)->first();

        return view('pm.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->name = $request->project;
        $project->save();

        return redirect('/project');
    }

    public function destroy($id)
    {
        $project = Project::find($id)->delete();
        $job = Job::where('project_id','=',$id)->delete();

        return redirect('/project');
    }
}
