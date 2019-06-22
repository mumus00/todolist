@extends('layouts.app')

@section('content')
		<form method="POST" action="/programmer/add">
			@csrf
			<table>
				<tr>
					<td><label for="programmer">Programmer</label></td>
					<td><input type="text" name="programmer"></td>
				</tr>
				<tr>
					<td><label for="password">Password</label></td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td><label for="email">Email</label></td>
					<td><input type="email" name="email"></td>
				</tr>
				<tr>
					<td><label for="status">Status</label></td>
					<td>
						<select name="role">
							<option value="0">Programmer</option>
							<option value="1">Project Manager</option>
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