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
            <td class="text-center"><a href="{{ route('programmers.show',$programmer->id) }}">{{$programmer->name}}</a></td>
            <td class="text-center">
                @if($programmer->role==1)
                Project Manager
                @else
                Programmer
                @endif
            </td>
            <td class="text-center" style="display: flex;justify-content:center">
                <table>
                    <tr>
                        <td>
                            <a href=" {{ route('programmers.edit', $programmer->id) }} " class="btn btn-sm btn-success" title="Edit">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form id="delete-form" action=" {{ route('programmers.destroy',$programmer->id) }} "
                                method="POST">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                        <td>
                            <a href=" {{ route('programmers.reset', $programmer->id) }} " class="btn btn-sm btn-primary" title="Edit">
                                Reset
                            </a>
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
    {{ $programmers->links() }}
</div>
@endsection
