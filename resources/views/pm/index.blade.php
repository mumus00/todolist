@extends('layouts.dashboard')

@section('content')
<button>
    <a href="/todo/tambah">Add To Do</a></button>
<form action="/search" method="POST">
    @csrf
    <input type="text" name="search">
</form>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Project</th>
            <th>To Do</th>
            <th>Programmer</th>
            <th>Progress</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jobs as $job)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$job->project->name}}</td>
            <td>{{$job->name}}</td>
            @if($job->user_id==0)
            <td>Belum Ada</td>
            @else
            <td>{{$job->user->name}}</td>
            @endif

            @if($job->confirmed == 1)
            <td>Clear</td>
            @else
            <td>Not yet</td>
            @endif
            <td>
                <div class="form-group">
                    <a href="/todo/edit/{{$job->id}}" class="btn btn-warning" title="Edit">
                        <i class="icon-pencil"></i>
                    </a>
                    <form method="Post" action="/todo/delete/{{$job->id}}">
                        @csrf
                        @method("delete")
                        <button>Hapus</button>
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
