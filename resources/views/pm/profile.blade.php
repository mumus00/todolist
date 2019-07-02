@extends('layouts.dashboard')

@push('styles')
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 999px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        background: red;
        cursor: inherit;
        display: block;
    }

    /* input[readonly] {
  background-color: white !important;
  cursor: text !important;
} */
</style>
@endpush

@section('content')
<div class="container">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:5px;">
                <div class="card-body" style="border-top:2px solid #eee; padding-top:20px;">
                    <form class="form-horizontal" action=" {{ route('profil.update') }} " enctype='multipart/form-data' method="POST">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="form-group" style="width:100%;display:flex;justify-content:center">
                            <img src="{{ asset($user->photo) }}"
                                style="width: 250px; height:250px;border-radius:50%">
                        </div>

                        <div class="form-group">
                            <label for="photo" class="col-md-4 control-label">New Photo</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Browse...
                                            <input name="image" type="file" id="image">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{$user->name}}"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{$user->email}}"
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
