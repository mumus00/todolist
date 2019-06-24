@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:5px;">
                <div class="card-header"> Edit Programmer </div>
                <div class="card-body" style="border-top:2px solid #eee; padding-top:20px;"S>
                    <form class="form-horizontal" action="{{ route('programmers.update',$programmer->id) }}" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="programmer" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="programmer"
                                value="{{$programmer->name}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Posisi</label>

                            <div class="col-md-6">
                                <select name="role" class="form-control">
                                    <option value="0" {{$programmer->role == 0 ? 'selected' : ''}}>
                                        Programmer
                                    </option>
                                    <option value="1" {{$programmer->role == 1 ? 'selected' : ''}}>
                                        Project Manager
                                    </option>
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
