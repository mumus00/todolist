@extends('layouts.dashboard')

@section('content')
	<h1>{{$project->name}}</h1>
	<button><a href="/detail/tambah/{{$project->id}}">Add To Do Project </a></button>
		<table border="1px">
			<tr>
				<th>No</th>
				<th>To Do</th>
				<th>Programmer</th>
				<th>Aksi</th>
			</tr>
			@forelse($jobs as $job)
 			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$job->name}}</td>
				@if($job->user_id >= 1)
				<td>{{$job->user->name}}</td>
				@else
				<td>Belum Ada</td>
				@endif
				<td>
					<button><a href="/detail/edit/{{$job->id}}">Edit</a></button>
					<form method="Post" action="/detail/delete/{{$job->id}}">
						@csrf
						@method("delete")
						<button>Hapus</button>
					</form>
				</td>
			</tr>
			@empty
			<p>Tidak ada tugas</p>
 			@endforelse
		</table>
@endsection
