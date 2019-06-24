@extends('layouts.dashboard')

@section('content')
<img src="{{ asset(auth()->user()->photo) }}" style="width: 250px; height:250px;border-radius:50%">
<form action="{{ route('uploadFoto') }}" enctype="multipart/form-data" method="POST">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <p>
        <label for="photo">
            <input type="file" name="photo" id="photo">
        </label>
    </p>
    <button>Upload</button>
</form>

<form action="{{ route('updateProfile') }}" method="POST">
    @csrf
    <table>
        <tr>
            <td><label>Nama</label></td>
            <td><input type="text" name="name" value="{{Auth::User()->name}}"></td>
        </tr>
        <tr>
            <td><label>Email</label></td>
            <td><input type="email" name="email" value="{{Auth::User()->email}}"></td>
        </tr>
        <tr>
            <td></td>
            <td><button>UPDATE</button></td>
        </tr>
    </table>
</form>
@endsection
