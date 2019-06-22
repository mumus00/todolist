@extends('layouts.app')

@section('content')
		<form action="/detail/edit/update/{{$job->project->id}}" method="POST">
			@csrf
			@method("PUT")
			<table>
				<tr>
					<td><label>ID Todo</label></td>
					<td><input type="text" name="id" value="{{$job->id}}" readonly></td>
				</tr>
				<tr>
					<td><label>To Do</label></td>
					<td>
						<input type="text" name="todo" value="{{$job->name}}">
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit" name="submit">Edit</button></td>
				</tr>
			</table>
		</form>
@endsection