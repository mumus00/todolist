@extends('layouts.dashboard')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="border-top:2px solid #eee;">No</th>
            <th class="text-center" style="border-top:2px solid #eee;">Project</th>
            <th class="text-center" style="border-top:2px solid #eee;">To Do</th>
            <th class="text-center" style="border-top:2px solid #eee;">Progress</th>
            <th class="text-center" style="border-top:2px solid #eee;">Deadline</th>
            <th class="text-center" style="border-top:2px solid #eee;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jobs as $job)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{$job->project->name}}</td>
            <td class="text-center">{{$job->name}}</td>
            <td class="text-center"> {{$job->status}} </td>
            <td class="text-center"> {{$job->dateline}} </td>
            <td class="text-center"><a href=" {{ route('todos.mytodo.edit', [auth()->user()->id, $job->id]) }} " class="btn btn-primary">Change Progress</a></td>
        </tr>
        @empty
        <tr>
            <td colspan="6">
                <div class="alert alert-warning text-center mb0">
                    <p>Data Not Found</p>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
<div style="display: flex;justify-content:center;">
    {{ $jobs->links() }}
</div>
@endsection
