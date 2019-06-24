@extends('layouts.dashboard')

@push('styles')
<style>

</style>
@endpush
@section('content')
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-2">
        <a class="btn btn-app-blue" href=" {{ route('projects.create') }} ">Add Project</a>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="border-top:2px solid #eee;">No</th>
            <th class="text-center" style="border-top:2px solid #eee;">Project</th>
            <th class="text-center" style="border-top:2px solid #eee;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($projects as $project)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center"><a href="{{ route('byProject.show',$project->id) }}">{{$project->name}}</a></td>
            <td class="text-center">
                <div class="form-group">
                    <a href=" {{ route('projects.edit',$project->id) }} " class="btn" title="Edit">
                        Edit
                    </a>

                    <form id="delete-form" action=" {{ route('projects.destroy',$project->id) }}" method="POST">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
