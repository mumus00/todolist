@extends('layouts.app')

@section('content')
		<table border="1px">
			<tr>
				<th>No</th>			
				<th>Project</th>
				<th>To Do</th>
				<th>Ambil</th>
			</tr>
			@forelse($jobs as $job)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$job->project->name}}</td>
				<td>{{$job->name}}</td>
				<td>
					<button><a href="/pro/ambil/{{$job->id}}">AMBIL</a></button>
				</td>
			</tr>
			@empty
			<p>No jobs</p>
			@endforelse
		</table>
@endsection