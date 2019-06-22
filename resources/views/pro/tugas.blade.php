@extends('layouts.dashboard')

@section('content')
		<table border="1px">
			<tr>
				<th>No</th>
				<th>Project</th>
				<th>To Do</th>
				<th>Progress</th>
				<th>SELESAI</th>
			</tr>
			@forelse($jobs as $job)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$job->project->name}}</td>
				<td>{{$job->name}}</td>
				@if($job->confirmed == 1)
				<td>Clear</td>
				<td></td>
				@else
				<td>Not Clear</td>
				<td>
					<button><a href="/selesai/{{$job->id}}">SELESAI</a></button>
				</td>
				@endif

			</tr>
			@empty
			<p>You don't Have any Jobs</p>
			@endforelse
		</table>
@endsection
