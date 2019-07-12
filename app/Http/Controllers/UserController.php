<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use App\Job;
use Illuminate\Support\Facades\Storage;
use File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['except' => ['editPassword','updatePassword','editProfile','updateProfile','show']]);
    }

    public function index()
    {
        $programmers = User::orderBy('role','DESC')->paginate(5);
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
            'photo' => 'profile/default.jpg',
        ]);
        $programmer->save();

        return redirect()->route('programmers.index');
    }

    public function show($id)
    {
        $user = User::find(auth()->user()->id);
        return view('profile.index',compact('user'));
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

    public function updatePassword(Request $request){
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

    public function editProfile(){
        $user = User::find(auth()->user()->id);
        return view('profile.index',compact('user'));
    }

    public function updateProfile(Request $request){
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png',
        ]);

        if($request->image != null){
            $path = $request->file('image')->store('profile');
        }else{
            $path = User::find(auth()->user()->id)->photo;
        }

        User::where('id',auth()->user()->id)->update([
            'photo' => $path,
            'name'  => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('profil.edit');
    }

    public function reset($id){
        User::find($id)->update([
            'password' => bcrypt('123456'),
        ]);

        return redirect()->route('programmers.index');
    }
}
