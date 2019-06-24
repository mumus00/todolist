<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Job;

class UserController extends Controller
{
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
        //
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
}
