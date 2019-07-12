@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:5px;">
                <div class="card-header"> Edit Todo </div>
                <div class="card-body" style="border-top:2px solid #eee; padding-top:20px;">
                    <form class="form-horizontal" action=" {{ route('todos.mytodo.update', $job->id) }} " method="POST">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="project" class="col-md-4 control-label">Project</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="project" value=" {{ $job->project->name }} " readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new-todo" class="col-md-4 control-label">Todo</label>
                            <div class="col-md-6">
                                <input id="new-todo" type="text" class="form-control" name="todo" value="{{ $job->name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="satust" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select name="status" class="form-control">
                                    <option value="Open" {{ $job->status=='Open'? 'selected':'' }}>Open</option>
                                    <option value="To Do" {{ $job->status=='To Do'? 'selected':'' }}>To Do</option>
                                    <option value="Doing" {{ $job->status=='Doing'? 'selected':'' }}>Doing</option>
                                    <option value="Review" {{ $job->status=='Review'? 'selected':'' }}>Review</option>
                                    <option value="Clear" >Clear</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
