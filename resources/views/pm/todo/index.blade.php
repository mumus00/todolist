@extends('layouts.dashboard')
@push('styles')
<style>
th {

}
</style>
@endpush
@section('content')
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-5">
        <form action="/search" method="POST">
            @csrf
            <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search" aria-label="Search"
                name="search">
        </form>
    </div>
    <div class="col-md-5"></div>
    <div class="col-md-2">
        <a class="btn btn-app-blue" href="/todo/tambah">Add To Do</a>
    </div>
</div>

<table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center" style="border-top:2px solid #eee;">No</th>
            <th class="text-center" style="border-top:2px solid #eee;">Project</th>
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
            <td class="text-center">{{$job->project->name}}</td>
            <td class="text-center">{{$job->name}}</td>
            @if($job->user_id==0)
            <td class="text-center">Belum Ada</td>
            @else
            <td class="text-center">{{$job->user->name}}</td>
            @endif

            @if($job->confirmed == 1)
            <td class="text-center">Clear</td>
            @else
            <td class="text-center">Not yet</td>
            @endif
            <td class="text-center">
                <div class="form-group">
                    <a href="/todo/edit/{{$job->id}}" class="btn" title="Edit">
                        Edit
                    </a>

                    <a href="/todo/delete/{{$job->id}}" onclick="event.preventDefault();
                    document.getElementById('delete-form').submit();" class="btn">
                        {{ __('Delete') }}
                    </a>

                    <form id="delete-form" action="/todo/delete/{{$job->id}}" method="POST" style="display: none;">
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
