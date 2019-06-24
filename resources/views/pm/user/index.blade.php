<!DOCTYPE html>
@extends('layouts.dashboard')

@section('content')
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-2">
        <a class="btn btn-app-blue" href=" {{ route('programmers.create') }} ">Add Programmer</a>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="border-top:2px solid #eee;">No</th>
            <th class="text-center" style="border-top:2px solid #eee;">Nama</th>
            <th class="text-center" style="border-top:2px solid #eee;">Posisi</th>
            <th class="text-center" style="border-top:2px solid #eee;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($programmers as $programmer)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center"><a href="/search/{{$programmer->name}}">{{$programmer->name}}</a></td>
            <td class="text-center">
                @if($programmer->role==1)
                Project Manager
                @else
                Programmer
                @endif
            </td>
            <td class="text-center">
                <div class="form-group">
                    <a href=" {{ route('programmers.edit', $programmer->id) }} " class="btn" title="Edit">
                        Edit
                    </a>

                    <form id="delete-form" action=" {{ route('programmers.destroy',$programmer->id) }} " method="POST">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
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
@endsection
