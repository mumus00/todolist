@extends('layouts.dashboard')

@section('content')

<div class="row" style="margin-bottom:20px;">
    <div class="col-md-10">
        <h2 style="margin:0px;">{{$user->name}}</h2>
    </div>
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
            <th class="text-center" style="border-top:2px solid #eee;">Posted</th>
            <th class="text-center" style="border-top:2px solid #eee;">Deadline</th>
            <th class="text-center" style="border-top:2px solid #eee;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jobs as $job)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{$job->project->name}}</td>
            <td class="text-center">{{$job->name}}</td>
            <td class="text-center"> {{ $job->status }} </td>
            <td class="text-center">{{ $job->created_at->format('d/m/Y') }}</td>
            <td class="text-center">{{ $job->dateline }}</td>
            <td class="text-center" style="display: flex;justify-content:center">
                <table>
                    <tr>
                        <td>
                            <a href="{{ route('byUser.edit',$job->id) }}" class="btn btn-sm btn-success" title="Edit">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form class="delete" action="{{ route('byUser.destroy',$job->id) }}" method="POST">
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

@push('script')
<script>
    $(document).ready(function(){
        $(".delete").on("submit", function(){
            return confirm("Are you sure to delete?")
        })
    })
</script>
@endpush
