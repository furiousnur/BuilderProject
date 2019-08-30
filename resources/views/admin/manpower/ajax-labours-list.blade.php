<br>
<div class="row">
<div class="col-md-12">
	<div class="card comp-card">
		<div class="card-body">
			<h3 style="text-align: center;">All Labour of <span style="color: #f91484;">{{$project->name}}</span> Project</h3>
			<div class="table-responsive">
				<table class="table" id="allProjects">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Designation</th>
							<th scope="col">Project</th>
							<th scope="col">Wages</th>
							<th scope="col">Father Name</th>
							<th scope="col">Address</th>
							<th scope="col">Phone</th>
						</tr>
					</thead>
					<tbody>
						@foreach($project->labours as $index => $labour)
						<tr>
							<th scope="row">{{$index+1}}</th>
							<td><a href="{{route('labours.show',$labour->id)}}">{{$labour->name}}</a></td>
							
							<td>
								@if($labour->designation=='Massion')
									<span class="label label-success">{{$labour->designation}}</span>
								@elseif($labour->designation=='Helper')
									<span class="label label-warning">{{$labour->designation}}</span>
								@else
									<span class="label label-primary">{{$labour->designation}}</span>
								@endif
							</td>
							<td>{{$labour->project->name}}</td>
							<td>{{$labour->wages}} TK</td>
							<td>{{$labour->father_name}}</td>
							<td>{{$labour->address}}</td>
							<td>{{$labour->phone}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$('#allProjects').DataTable( {
		responsive: true,
		} );
</script>
</div>
