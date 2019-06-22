@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:5px;">
                <div class="card-header"> Tambah Todo</div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="/todo/add">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="project" class="col-md-4 control-label">Project</label>

                            <div class="col-md-6">
                                <select class="form-control" name="project" required>
                                    <option value="">SELECT PROJECT</option>
                                    @forelse($projects as $project)
                                    <option value={{$project->id}}>{{$project->name}}</option>
                                    @empty
                                    <option>No Project</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="programmer" class="col-md-4 control-label">Programmer</label>

                            <div class="col-md-6">
                                <select class="form-control" name="programmer">
                                    <option value="0">NOT SELECTED</option>
                                    @forelse($programmers as $programmer)
                                    <option value="{{$programmer->id}}">
                                        {{$programmer->name}}
                                    </option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new-todo" class="col-md-4 control-label">Todo</label>

                            <div class="col-md-6">
                                <input id="new-todo" type="text" class="form-control" name="todo" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
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
