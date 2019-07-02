@extends('layouts.dashboard')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="border-top:2px solid #eee;">No</th>
            <th class="text-center" style="border-top:2px solid #eee;">Project</th>
            <th class="text-center" style="border-top:2px solid #eee;">To Do</th>
            <th class="text-center" style="border-top:2px solid #eee;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jobs as $job)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{$job->project->name}}</td>
            <td class="text-center">{{$job->name}}</td>
            <td class="text-center">
                <div class="form-group">
                    <a href="{{ route('todos.ambil', $job->id) }}" class="btn btn-primary" title="Ambil">
                        Ambil
                    </a>
                </div>
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
<div style="display: flex;justify-content:center;">
    {{ $jobs->links() }}
</div>
@endsection
