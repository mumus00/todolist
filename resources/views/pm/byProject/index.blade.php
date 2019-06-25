@extends('layouts.dashboard')

@section('content')
<h1>{{$project->name}}</h1>

<div class="row" style="margin-bottom:20px;">
    <div class="col-md-2">
        <a class="btn btn-app-blue" href="{{ route('byProject.create',$project->id) }}">Add To Do</a>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="border-top:2px solid #eee;">No</th>
            <th class="text-center" style="border-top:2px solid #eee;">To Do</th>
            <th class="text-center" style="border-top:2px solid #eee;">Programmer</th>
            <th class="text-center" style="border-top:2px solid #eee;">Progress</th>
            <th class="text-center" style="border-top:2px solid #eee;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jobs as $job)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{$job->name}}</td>
            @if($job->user_id >= 1)
            <td class="text-center">{{$job->user->name}}</td>
            @else
            <td class="text-center">Belum Ada</td>
            @endif
            @if($job->confirmed == 1)
            <td class="text-center">Clear</td>
            @else
            <td class="text-center">Not yet</td>
            @endif
            <td class="text-center" style="display: flex;justify-content:center">
                <table>
                    <tr>
                        <td>
                            <a href="{{ route('byProject.edit',$job->id) }}" class="btn btn-sm btn-success" title="Edit">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form id="delete-form" action="{{ route('byProject.destroy',$job->id) }}" method="POST">
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
