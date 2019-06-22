@extends('layouts.app')

@section('content')
		<form action="/programmer/edit/update/{{$programmer->id}}" method="POST">
			@csrf
			@method("PUT")
			<table>
				<tr>
					<td><label>ID</label></td>
					<td><input type="text" name="id" value="{{$programmer->id}}" readonly></td>
				</tr>
				<tr>
					<td><label>Programmer</label></td>
					<td><input type="text" name="programmer" value="{{$programmer->name}}"></td>
				</tr>
				<tr>
					<td><label>Status</label></td>
					<td>
						<select name="role">
							<option value="0"
							{{$programmer->role == 0 ? 'selected' : '' }}>
								Programmer
							</option>
							<option value="1"
							{{$programmer->role == 1 ? 'selected' : '' }}>
								Project Manager
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button>Edit</button></td>
				</tr>
			</table>
		</form>
@endsection