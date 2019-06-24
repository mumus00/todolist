@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:5px;">
                <div class="card-header">Edit Detail Project ID {{$job->project->id}}</div>
                <div class="card-body" style="border-top:2px solid #eee; padding-top:20px;">
                    <form class="form-horizontal" method="POST" action="/detail/edit/update/{{$job->project->id}}">
                        {{ csrf_field() }}
                        @method("PUT")

                        <div class="form-group">
                            <label for="id" class="col-md-4 control-label">Todo ID</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="id" value="{{$job->id}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="todo" class="col-md-4 control-label">To Do</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="todo" value="{{$job->name}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
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
