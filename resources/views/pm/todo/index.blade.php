@extends('layouts.dashboard')
@section('content')
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-7">
        <form class="form-inline" action=" {{ route('todos.search') }} " method="POST">
            @csrf
            <div class="form-group">
                <input class="form-control form-control-sm mr-3 w-75" type="text"
                placeholder="User/Project/Todo" aria-label="Search" name="search">
            </div>

            <div class="form-group">
                <div class='input-group date' id='datePicker'>
                    <input type='text' class="form-control" name="dateline" placeholder="Dateline"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="form-group">
                    <button class="btn btn-primary" type="submit"> {{ __('Search') }} </button>

            </div>
        </form>
    </div>
    <div class="col-md-3">

    </div>
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
            @if($job->user_id==0)
            <td class="text-center">Belum Ada</td>
            @else
            <td class="text-center">{{$job->user->name}}</td>
            @endif

            <td class="text-center"> {{ $job->status }} </td>
            <td class="text-center">{{ $job->created_at->format('d/m/Y') }}</td>
            <td class="text-center">{{ $job->dateline }}</td>
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
                        <td>
                            <a href="{{ route('todos.ambil', $job->id) }}" class="btn btn-sm btn-primary" title="Ambil">
                                Ambil
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="12">
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
<script type="text/javascript">
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

    var optComponent = {
        format: 'dd/mm/yyyy',
        container: '#datePicker',
        orientation: 'auto bottom',
        todayHighlight: true,
        autoclose: true
    };

    // COMPONENT
    $('#datePicker').datepicker(optComponent);
</script>
@endpush
