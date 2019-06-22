@extends('layouts.dashboard')

@section('content')
		<form action="/password/ganti" method="POST">
			@csrf
			@method('PUT')
			<label for='newpassword'>New Password</label><br>
			<input type="password" name="newpassword"><br>
			<button>Go</button>
		</form>
@endsection
