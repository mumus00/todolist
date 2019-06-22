@extends('layouts.app')

@section('content')
		<form method="POST" action="/todo/add">
			@csrf
			<table>
				<tr>
					<td><label for="project">Project</label></td>
					<td>
						<select name="project">
							@forelse($projects as $project)
							<option value={{$project->id}}>{{$project->name}}</option>
							@empty
							<option>No Project</option>
							@endforelse
						</select>
					</td>
				</tr>
				<tr>
					<td><label>To Do</label></td>
					<td><input type="text" name="todo"></td>
				</tr>
				<tr>
					<td><label>Programmer</label></td>
					<td>
						<select name="programmer">
							<option value="0">No Programmer</option>
							@forelse($programmers as $programmer)
							<option value="{{$programmer->id}}">{{$programmer->name}}</option>
							@empty
							
							@endforelse
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit" name="submit">Tambah</button></td>
				</tr>
			</table>
		</form>
@endsection