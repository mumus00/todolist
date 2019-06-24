@extends('layouts.dashboard')

@section('content')
<h1>{{$project->name}}</h1>

<div class="row" style="margin-bottom:20px;">
    <div class="col-md-2">
        <a class="btn btn-app-blue" href="/detail/tambah/{{$project->id}}">Add Detail</a>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="border-top:2px solid #eee;">No</th>
            <th class="text-center" style="border-top:2px solid #eee;">To Do</th>
            <th class="text-center" style="border-top:2px solid #eee;">Programmer</th>
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
            <td class="text-center">
                <div class="form-group">
                    <a href="/detail/edit/{{$job->id}}" class="btn" title="Edit">
                        Edit
                    </a>

                    <a href="/detail/delete/{{$job->id}}" onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();" class="btn">
                        {{ __('Delete') }}
                    </a>

                    <form id="delete-form" action="/detail/delete/{{$job->id}}" method="POST" style="display: none;">
                        @csrf
                        @method("delete")
                    </form>
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
@endsection
