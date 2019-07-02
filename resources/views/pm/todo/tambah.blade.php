@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:5px;">
                <div class="card-header">Tambah Todo</div>
                <div class="card-body" style="border-top:2px solid #eee; padding-top:20px;">
                    <form class="form-horizontal" method="POST" action=" {{ route('todos.store') }} ">
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
                            <label for="dateline" class="col-md-4 control-label">Dateline</label>

                            <div class="col-md-6">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span ></span>
                                    </span>
                                </div>

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
@push('script')
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
</script>
@endpush
