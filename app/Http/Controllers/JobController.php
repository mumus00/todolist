<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Project;
use App\User;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();

        return view('pm.todo.index', compact('jobs'));
    }

    public function create()
    {
        $programmers = User::all();
        $projects = Project::all();

        return view('pm.todo.tambah', compact('projects','programmers'));
    }

    public function store(Request $request)
    {
        $job = new Job([
            'name' => $request->todo,
            'project_id' => $request->project,
            'user_id' => $request->programmer
        ]);
        $job->save();

        return redirect('/todos');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $job = Job::where('id',$id)->first();
        $programmers = User::all();
        $projects = Project::all();

        return view('pm.todo.edit',compact('job','programmers','projects'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        $job->name = $request->todo;
        $job->project_id = $request->project;
        $job->user_id = $request->programmer;
        $job->save();

        return redirect('/todos');
    }

    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();

        return redirect('/todos');
    }

    public function search(Request $request){
        $search = $request->search;
        $jobs = Job::orWhereHas('project', function($project) use($search) {
            $project->where('name', 'like', '%'.$search.'%');
          })->orWhereHas('user', function($user) use($search) {
            $user->where('name', 'like', '%'.$search.'%');
          })->orWhere('name', 'like', '%'.$search.'%')->orderBy('name')->get();
        // dd($jobs);
        return view('pm.todo.index', compact('jobs'));
    }
}
