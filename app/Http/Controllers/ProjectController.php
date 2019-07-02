<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Job;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $projects = Project::paginate(5);
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

        return redirect()->route('projects.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $project = Project::find($id);

        return view('pm.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->name = $request->project;
        $project->save();

        return redirect()->route('projects.index');
    }

    public function destroy($id)
    {
        Project::find($id)->delete();
        Job::where('project_id','=',$id)->delete();

        return redirect()->route('projects.index');
    }
}
