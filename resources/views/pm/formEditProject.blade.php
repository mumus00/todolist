@extends('layouts.dashboard')

@section('content')
		<form action="/project/edit/update/{{$project->id}}" method="POST">
			@csrf
			@method("PUT")
			<table>
				<tr>
					<td><label>ID</label></td>
					<td><input type="text" name="id" value="{{$project->id}}" readonly></td>
				</tr>
				<tr>
					<td><label>Project</label></td>
					<td>
						<input type="text" name="project" value="{{$project->name}}">
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit" name="submit">Edit</button></td>
				</tr>
			</table>
		</form>
@endsection
