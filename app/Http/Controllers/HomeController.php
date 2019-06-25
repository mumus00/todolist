<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Auth;
use App\User;
use App\Job;
use App\Project;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->route('todos.index');
    }

    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

    public function search(Request $request){
        $search = $request->search;
        $jobs = Job::orWhereHas('project', function($project) use($search) {
            $project->where('name', 'like', '%'.$search.'%');
          })->orWhereHas('user', function($user) use($search) {
            $user->where('name', 'like', '%'.$search.'%');
          })->orWhere('name', 'like', '%'.$search.'%')->orderBy('name')->get();
        // dd($jobs);
        if(Auth::User()->role==1)
            return view('pm.todo.index', compact('jobs'));
        else
            return view('pro.index', compact('jobs'));
    }

    public function searchUser($username){
        $jobs = Job::whereHas('user', function($user) use($username) {
            $user->where('name', 'like', '%'.$username.'%');
          })->orderBy('name')->get();
        if(Auth::User()->role==1)
            return view('pm.todo.index', compact('jobs'));
    }

    public function mytodo(){
        $user_id = Auth::User()->id;
        $jobs = Job::where('user_id', $user_id)
        ->orderBy('confirmed')->get();

        return view('pro.tugas', compact('jobs'));
    }

    public function selesai($id_job){
        $job = Job::find($id_job);
        $job->confirmed = 1;
        $job->save();

        return redirect('/mytodo');
    }
}
