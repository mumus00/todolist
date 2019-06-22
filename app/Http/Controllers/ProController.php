<?php

namespace App\Http\Controllers;

use \Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Job;
use App\User;
use App\Project;

class ProController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('programmer');
    }

    public function show(){
        $jobs = Job::where('user_id',0)->where('confirmed',0)->get();

        return view('pro.index',compact('jobs'));
    }

    public function ambil($id){
        $id_user = Auth::User()->id;
        $job = Job::find($id);
        $job->user_id = $id_user;
        $job->save();

        return redirect('/pro');
    }
}
