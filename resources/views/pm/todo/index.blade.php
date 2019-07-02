@extends('layouts.dashboard')
@push('styles')
<style>
    th {}
</style>
@endpush
@section('content')
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-5">
        <form class="form-inline" action=" {{ route('todos.search') }} " method="POST">
            @csrf
            <div class="input-group">
                <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search"
                    aria-label="Search" name="search">
                <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit"> {{ __('Search') }} </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-5"></div>
    <div class="col-md-2">
        <a class="btn btn-app-blue" href=" {{ route('todos.create') }} ">Add To Do</a>
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
            <th class="text-center" style="border-top:2px solid #eee;">Created_at</th>
            <th class="text-center" style="border-top:2px solid #eee;">Dateline</th>
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
            <td class="text-center">{{ $job->created_at->format('d/m/Y') }}</td>
            <td class="text-center">date</td>
            <td class="text-center" style="display: flex;justify-content:center">
                <table>
                    <tr>
                        <td>
                            <a href="{{ route('todos.edit', $job->id) }}" class="btn btn-sm btn-success" title="Edit">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form id="delete-form" action="{{ route('todos.destroy',$job->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
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
<div style="display: flex;justify-content:center;">
    {{ $jobs->links() }}
</div>
@endsection
