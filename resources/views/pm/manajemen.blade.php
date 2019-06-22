<!DOCTYPE html>
@extends('layouts.dashboard')

@section('content')
		<form method="GET" action="/programmer/tambah">
			@csrf
			<button type="submit" name="submit">Add Programmer</button>
		</form>
		<table border="1px">
			<tr>
				<th>ID</th>
				<th>Nama</th>
				<th>Project Manager</th>
				<th>Aksi</th>
			</tr>
			<?php $i=1; ?>
			@foreach($programmers as $programmer)
			<tr>
				<td>{{$i++}}</td>
				<td><a href="/search/{{$programmer->name}}">{{$programmer->name}}</a></td>
				@if($programmer->role==1)
				<td>Project Manager</td>
				@else
				<td>Programmer</td>
				@endif
				<td>
					<button><a href="/programmer/edit/{{$programmer->id}}">Edit</a></button>
					<form method="Post" action="/programmer/delete/{{$programmer->id}}">
						@csrf
						@method("delete")
						<button>Hapus</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
@endsection
