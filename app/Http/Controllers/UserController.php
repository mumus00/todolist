<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Job;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $programmers = User::all();
        return view('pm.user.index', compact('programmers'));
    }

    public function create()
    {
        return view('pm.user.tambah');
    }

    public function store(Request $request)
    {
        $programmer = new User([
            'name' => $request->programmer,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $programmer->save();

        return redirect()->route('programmers.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('pm.profile',compact('user'));
    }

    public function edit($id)
    {
        $programmer = User::find($id);
        return view('pm.user.edit', compact('programmer'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->programmer;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('programmers.index');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        Job::where('user_id','=',$id)->update(['user_id' => 0]);
        return redirect()->route('programmers.index');
    }

    public function editPassword(){
        return view('auth.changepassword');
    }

    public function updatePassword(){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }
}
