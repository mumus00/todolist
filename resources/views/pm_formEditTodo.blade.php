@extends('layouts.app')

@section('content')
		<form action="/todo/edit/update/{{$job->id}}" method="POST">
			@csrf
			@method("PUT")
			<table>
				<tr>
					<td><label>ID</label></td>
					<td><input type="text" name="id" value="{{$job->id}}" readonly></td>
				</tr>
				<tr>
					<td><label>Programmer</label></td>
					<td>
						<select name="programmer">
							@foreach($programmers as $programmer)
							<option value="{{$programmer->id}}" 
								{{$programmer->id == $job->user_id ? 'selected' : '' }}
								>{{$programmer->name}}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td><label>To Do</label></td>
					<td><input type="text" name="todo" value="{{$job->name}}"></td>
				</tr>
				<tr>
					<td><label>Project</label></td>
					<td>
						<select name="project">
							@foreach($projects as $project)
							<option value="{{$project->id}}"
								{{$project->id == $job->project_id ? 'selected' : '' }}
								>{{$project->name}}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit" name="submit">Edit</button></td>
				</tr>
			</table>
			
		</form>
@endsection