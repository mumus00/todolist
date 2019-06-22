@extends('layouts.dashboard')

@push('styles')
<style>
    th {
        background-color:deepskyblue;
    }
</style>
@endpush
@section('content')
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-2">
        <a class="btn btn-app-blue" href="/project/tambah">Add Project</a>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Project</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($projects as $project)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center"><a href="/detail/{{$project->id}}">{{$project->name}}</a></td>
            <td class="text-center">
                <div class="form-group">
                    <a href="/project/edit/{{$project->id}}" class="btn" title="Edit">
                        Edit
                    </a>

                    <a href="/project/delete/{{$project->id}}" onclick="event.preventDefault();
                        document.getElementById('delete-form').submit();" class="btn">
                        {{ __('Delete') }}
                    </a>

                    <form id="delete-form" action="/project/delete/{{$project->id}}" method="POST" style="display: none;">
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
