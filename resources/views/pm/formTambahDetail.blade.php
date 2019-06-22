@extends('layouts.app')

@section('content')
		{{$project->id}}
		<form method="POST" action="/detail/add/{{$project->id}}">
			@csrf
			<table>
				<tr>
					<td><label>To Do</label></td>
					<td><input type="text" name="todo"></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit" name="submit">Tambah</button></td>
				</tr>
			</table>
			</table>
		</form>
@endsection