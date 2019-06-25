@extends('layouts.dashboard')

@section('content')
<h1>{{$user->name}}</h1>

<div class="row" style="margin-bottom:20px;">
    <div class="col-md-2">
        <a class="btn btn-app-blue" href="{{ route('byUser.create',$user->id) }}">Add To Do</a>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="border-top:2px solid #eee;">No</th>
            <th class="text-center" style="border-top:2px solid #eee;">Project</th>
            <th class="text-center" style="border-top:2px solid #eee;">To Do</th>
            <th class="text-center" style="border-top:2px solid #eee;">Progress</th>
            <th class="text-center" style="border-top:2px solid #eee;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jobs as $job)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{$job->project->name}}</td>
            <td class="text-center">{{$job->name}}</td>
            @if($job->confirmed == 1)
            <td class="text-center">Clear</td>
            @else
            <td class="text-center">Not yet</td>
            @endif
            <td class="text-center" style="display: flex;justify-content:center">
                <table>
                    <tr>
                        <td>
                            <a href="{{ route('byUser.edit',$job->id) }}" class="btn btn-sm btn-success" title="Edit">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form id="delete-form" action="{{ route('byUser.destroy',$job->id) }}" method="POST">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">
                <div class="alert alert-warning text-center mb0">
                    <p>No Data</p>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
