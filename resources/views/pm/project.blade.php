@extends('layouts.app')

@section('content')
	<button><a href="/project/tambah">Add Project</a></button>
		<?php $i=1; ?>
		<table border="1px">
			<tr>
				<th>No</th>			
				<th>Project</th>
				<th>Aksi</th>
			</tr>
			@forelse($projects as $project)
 			<tr>
				<td>{{$i++}}</td>
				<td>
					<a href="/detail/{{$project->id}}">{{$project->name}}</a>
				</td>
				<td>
					<button><a href="/project/edit/{{$project->id}}">Edit</a></button>
					<form method="Post" action="/project/delete/{{$project->id}}">
						@csrf
						@method("delete")
						<button>Hapus</button>
					</form>
				</td>
			</tr>
			@empty
			<p>No Project Entry</p>
 			@endforelse
			
		</table>
@endsection