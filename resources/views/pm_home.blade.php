@extends('layouts.app')

@section('content')
	<button>
		<a href="/todo/tambah">Add To Do</a></button>
		<form action="/search" method="POST">
			@csrf
			<input type="text" name="search">
		</form>
		<table border="1px">
			<tr>
				<th>No</th>			
				<th>Project</th>
				<th>To Do</th>
				<th>Programmer</th>
				<th>Progress</th>
				<th>Aksi</th>
			</tr>
			@forelse($jobs as $job)
	 			<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$job->project->name}}</td>
					<td>{{$job->name}}</td>
					@if($job->user_id==0)
						<td>Belum Ada</td>
					@else
						<td>{{$job->user->name}}</td>
						@if($job->confirmed == 1)
							<td>Clear</td>
						@else
							<td>Not yet</td>
						@endif
					@endif
					<td>
						<button><a href="/todo/edit/{{$job->id}}">Edit</a></button>
						<form method="Post" action="/todo/delete/{{$job->id}}">
							@csrf
							@method("delete")
							<button>Hapus</button>
						</form>
					</td>
				</tr>
			@empty
			<tr>
				<p>No data entry</p>
			</tr>
 			@endforelse
		</table>
@endsection