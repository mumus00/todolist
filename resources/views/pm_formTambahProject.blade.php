@extends('layouts.app')

@section('content')
		<form action="/project/add" method="POST">
			@csrf
			<label for='newproject'>New Project</label><br>
			<input type="text" name="project">
			<button type="submit" name="submit">Go</button>
		</form>
@endsection