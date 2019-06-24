@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:5px;">
                <div class="card-body" style="border-top:2px solid #eee; padding-top:20px;">
                    <form class="form-horizontal" action="#" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="form-group" style="width:100%;display:flex;justify-content:center">
                            <img src="{{ asset(auth()->user()->photo) }}" style="width: 250px; height:250px;border-radius:50%">
                        </div>

                        <div class="form-group">
                            <label for="photo" class="col-md-4 control-label">New Photo</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="photo">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{Auth::User()->name}}"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{Auth::User()->email}}"
                                    required>
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
