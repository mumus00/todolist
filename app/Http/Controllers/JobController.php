<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Job;
use App\Project;
use App\User;
use Carbon\Carbon;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['index','show','ambil','editMytodo','updateMytodo']]);
    }

    public function index()
    {
        if(Auth::User()->isAdmin()){
            $jobs = Job::where('user_id','not like',auth()->user()->id)->orderBy('project_id')->paginate(5);
            return view('pm.todo.index', compact('jobs'));
        }else{
            $jobs = Job::where('status','Open')->paginate(5);
            return view('pro.index',compact('jobs'));
        }
    }

    public function create()
    {
        $programmers = User::all();
        $projects = Project::all();

        return view('pm.todo.tambah', compact('projects','programmers'));
    }

    public function store(Request $request)
    {
        if($request->programmer == 0){
            $status = "Open";
        }else{
            $status = "To Do";
        }

        $job = new Job([
            'name' => $request->todo,
            'status' => $status,
            'dateline' => $request->dateline,
            'project_id' => $request->project,
            'user_id' => $request->programmer,
        ]);
        $job->save();

        return redirect('/todos');
    }

    public function show()
    {
        $jobs = Job::where('user_id', auth()->user()->id)
        ->orderBy('status')->paginate(10);

        return view('mytodo.index', compact('jobs'));
    }

    public function edit($id)
    {
        $job = Job::where('id',$id)->firstOrFail();
        $programmers = User::all();
        $projects = Project::all();
        // dd($job);
        return view('pm.todo.edit', compact('job','programmers','projects'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        if($request->programmer == 0){
            $status = "Open";
        }else{
            $status = "To Do";
        }

        if($request->dateline == null){
            $deadline = $job->dateline;
        }else{
            $deadline = $request->dateline;
        }


        $job->name = $request->todo;
        $job->status = $status;
        $job->project_id = $request->project;
        $job->user_id = $request->programmer;
        $job->dateline = $deadline;
        $job->save();

        return redirect('/todos');
    }

    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();

        return redirect('/todos');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        if($request->dateline != null){
            if($search != null){
                $jobs = Job::where('dateline','like',$request->dateline)
                    ->where(function($q) use($search){
                        $q->where('name', 'like', '%'.$search.'%')
                        ->orWhereHas('project', function($project) use($search){
                            $project->where('name', 'like', '%'.$search.'%');
                        })->orWhereHas('user', function($user) use($search) {
                            $user->where('name', 'like', '%'.$search.'%');
                          });
                    })->where('user_id','not like',auth()->user()->id)->orderBy('project_id')->paginate(25);
            }else{
                $jobs = Job::where('dateline',$request->dateline)->where('user_id','not like',auth()->user()->id)->orderBy('project_id')->paginate(25);
            }
        }else{
            if($search != null){
                $jobs = Job::where(function($q) use($search){
                    $q->where('name', 'like', '%'.$search.'%')
                    ->orWhereHas('project', function($project) use($search){
                        $project->where('name', 'like', '%'.$search.'%');
                    })->orWhereHas('user', function($user) use($search) {
                        $user->where('name', 'like', '%'.$search.'%');
                      });
                })->where('user_id','not like',auth()->user()->id)->orderBy('project_id')->paginate(25);
            }else{
                return redirect()->route('todos.index');
            }
        }

        //$jobs->appends($request->all());
        return view('pm.todo.index', compact('jobs'));
    }

    //Todo Berdasarkan Project
    public function createByProject($id)
    {
        $programmers = User::all();
        $project = Project::find($id);
        return view('pm.byProject.tambah', compact('project','programmers'));
    }

    public function storeByProject(Request $request, $id)
    {
        if($request->programmer == 0){
            $status = "Open";
        }else{
            $status = "To Do";
        }

        $job = new Job([
            'name' => $request->todo,
            'status' => $status,
            'dateline' => $request->dateline,
            'project_id' => $id,
            'user_id' => $request->programmer
        ]);
        $job->save();

        return redirect()->route('projects.show',$id);
    }

    public function editByProject($id)
    {
        $job = Job::find($id);
        $project = Project::find($job->project_id);
        $programmers = User::all();
        return view('pm.byProject.edit', compact('job','project','programmers'));
    }

    public function updateByProject(Request $request, $id)
    {
        $job = Job::find($id);
        if($request->programmer == 0){
            $status = "Open";
        }else{
            $status = "To Do";
        }

        if($request->dateline == null){
            $deadline = $job->dateline;
        }else{
            $deadline = $request->dateline;
        }

        $job->name = $request->todo;
        $job->project_id = $request->project;
        $job->user_id = $request->programmer;
        $job->status = $status;
        $job->dateline = $deadline;
        $job->save();

        return redirect()->route('projects.show',$request->project);
    }

    public function destroyByProject($id)
    {
        $job = Job::find($id);
        $project = Project::find($job->project_id);
        $job->delete();
        return redirect()->route('projects.show',$project->id);
    }

    //Todo Berdasarkan Project
    public function showByUser($id)
    {
        $user = User::find($id);
        $jobs = Job::where('user_id',$id)->paginate(5);
        return view('pm.byUser.index', compact('jobs','user'));
    }

    public function createByUser($id)
    {
        $programmer = User::find($id);
        $projects = Project::all();
        return view('pm.byUser.tambah', compact('projects','programmer'));
    }

    public function storeByUser(Request $request, $id)
    {
        if($request->programmer == 0){
            $status = "Open";
        }else{
            $status = "To Do";
        }

        $job = new Job([
            'name' => $request->todo,
            'status' => $status,
            'dateline' => $request->dateline,
            'project_id' => $request->project,
            'user_id' => $id
        ]);
        $job->save();

        return redirect()->route('byUser.show',$id);
    }

    public function editByUser($id)
    {
        $job = Job::find($id);
        $projects = Project::all();
        $programmer = User::find($job->user_id);
        return view('pm.byUser.edit', compact('job','projects','programmer'));
    }

    public function updateByUser(Request $request, $id)
    {
        $job = Job::find($id);
        if($request->programmer == 0){
            $status = "Open";
        }else{
            $status = "To Do";
        }

        if($request->dateline == null){
            $deadline = $job->dateline;
        }else{
            $deadline = $request->dateline;
        }

        $job->name = $request->todo;
        $job->project_id = $request->project;
        $job->user_id = $request->programmer;
        $job->status = $status;
        $job->dateline = $deadline;
        $job->save();

        return redirect()->route('byUser.show',$request->programmer);
    }

    public function destroyByUser($id)
    {
        $job = Job::find($id);
        $programmer = User::find($job->user_id);
        $job->delete();
        return redirect()->route('byUser.show',$programmer->id);
    }

    public function ambil($id)
    {
        $id_user = Auth::User()->id;
        $job = Job::find($id);
        $job->user_id = $id_user;
        $job->status = 'To Do';
        $job->save();

        return redirect()->route('todos.index');
    }

    public function editMytodo($id_job)
    {
        $job = Job::where('id',$id_job)->first();

        return view('mytodo.edit', compact('job'));
    }

    public function updateMytodo(Request $request, $id_job)
    {
        $job = Job::find($id_job);
        $today = Carbon::yesterday()->format('Y/m/d');
        $tanggal = explode('/',$job->dateline);
        $deadline = $tanggal[2].'/'.$tanggal[1].'/'.$tanggal[0];
        // dd($deadline);
        if($request->status == 'Clear'){
            if($today > $deadline){
                $status = "Finished Late";
            }else{
                $status = "Finished On Time";
            }
            $job->update([
                'status' => $status,
            ]);
        }else{
            if($request->status != 'Open') {
                $job->update([
                    'status' => $request->status,
                ]);
            }else{
                $job->update([
                    'status' => $request->status,
                    'user_id' => 0,
                ]);
            }
        }
        return redirect()->route('todos.mytodo',auth()->user()->id);
    }
}
