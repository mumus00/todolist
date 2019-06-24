<?php

namespace App\Http\Controllers;

use \Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Job;
use App\User;
use App\Project;

class PmController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return redirect()->route('todos.index');
    }

    public function showProject(){
        $projects = Project::all();

        return view('pm.project.index', compact('projects'));
    }

    public function showProgrammer(){
        $programmers = User::all();

        return view('pm.user.index', compact('programmers'));
    }

    public function showDetail($id_project){
        $project = Project::find($id_project);

        $jobs = Job::where('project_id',$id_project)->get();

        return view('pm.detail.index')
            ->with(compact('jobs'))
            ->with(compact('project'));
    }

    public function edit($id){
        $job = Job::where('id',$id)->first();

        $programmers = User::all();

        $projects = Project::all();

        return view('pm.todo.edit')
            ->with(compact('job'))
            ->with(compact('programmers'))
            ->with(compact('projects'));
    }

    public function editProgrammer($id){
        $programmer = User::find($id);

        return view('pm.user.edit', compact('programmer'));
    }

    public function editProject($id){
        $project = Project::find($id)->first();

        return view('pm.project.edit', compact('project'));
    }

    public function editDetail($id_job){
        $job = Job::find($id_job);

        return view('pm.detail.edit', compact('job'));
    }

    public function update(Request $request, $id){
        $job = Job::find($id);
        $job->name = $request->todo;
        $job->project_id = $request->project;
        $job->user_id = $request->programmer;
        $job->save();

        return redirect('/pm');
    }

    public function updateProgrammer(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->programmer;
        $user->role = $request->role;
        $user->save();

        return redirect('/programmer');
    }

    public function updateProject(Request $request, $id){
        $project = Project::find($id);
        $project->name = $request->project;
        $project->save();

        return redirect('/project');
    }

    public function updateDetail(Request $request, $id_project){
        $job = Job::find($request->id);
        $job->name = $request->todo;
        $job->save();

        return redirect('/detail/'.$id_project);
    }

    public function delete($id){
        $job = Job::find($id);
        dd($job);
        $job->delete();

        return redirect('/pm');
    }

    public function deleteProgrammer($id){
        $job = User::find($id);
        $job->job->user_id=0;
        $job->save();

        $user = User::find($id);
        $user->delete();

        return redirect('/programmer');
    }

    public function deleteProject($id){
        $project = Project::find($id)->delete();
        $job = Job::where('project_id','=',$id)->delete();

        return redirect('/project');
    }

    public function deleteDetail($id){
        // DB::table('todo')->where('id',$id)->delete();
        $job = Job::find($id)->delete();
        return redirect('/');
    }

    public function tambah(){
        $programmers = User::all();
        $projects = Project::all();

        return view('pm.todo.tambah', ['projects'=>$projects, 'programmers'=>$programmers]);
    }

    public function tambahProgrammer(){
        return view('pm.user.tambah');
    }

    public function tambahProject(){
        return view('pm.project.tambah');
    }

    public function tambahDetail($id_project){
        $project = Project::find($id_project);

        return view('pm.detail.tambah', compact('project'));
    }

    public function add(Request $request){
        $job = new Job([
            'name' => $request->todo,
            'project_id' => $request->project,
            'user_id' => $request->programmer
        ]);
        $job->save();

        return redirect('/pm');
    }

    public function addProgrammer(Request $request){
        $programmer = new User([
            'name' => $request->programmer,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $programmer->save();

        return redirect('/programmer');
    }

    public function addProject(Request $request){
        $project = new Project([
            'name' => $request->project
        ]);
        $project->save();

        return redirect('/project');
    }

    public function addDetail(Request $request, $id){
        $job = new Job([
            'name' => $request->todo,
            'project_id' => $id,
            'user_id' => 0
        ]);
        $job->save();

        return redirect('/detail/'.$id);
    }
}
