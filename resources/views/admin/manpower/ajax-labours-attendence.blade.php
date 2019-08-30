<br>
<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<form action="{{route('attendence.store')}}" method="post">
			<div class="card-body">
				<h3 style="text-align: center;">Attendence of <span class="label label-inverse-info">{{$project->name}}</span> Project</h3>
				<div align="center">
					<div class="col-md-4"> Date : <input class="form-control" name="date" type="date" id="#dropper-default" required=""></div>
				</div>
				<br>
				
				<div class="table-responsive">
					
						@csrf
						<table class="table" id="Attendence">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">Designation</th>
									<th scope="col">1st</th>
									<th scope="col">Food / Advance</th>
									<th scope="col">Note</th>
								</tr>
							</thead>
							<tbody>
								<input type="hidden" name="project_id" value="{{$project->id}}">
								@forelse($project->labours as $index => $labour)
								<tr>
									<th scope="row">{{$index+1}}</th>
									<td>
										{{$labour->name}}
										<input type="hidden" name="labour_id[]" value="{{$labour->id}}">
									</td>
									<td>
										@if($labour->designation=='Massion')
										<span class="label label-success">{{$labour->designation}}</span>
										@elseif($labour->designation=='Helper')
										<span class="label label-warning">{{$labour->designation}}</span>
										@else
										<span class="label label-primary">{{$labour->designation}}</span>
										@endif
									</td>
									<td>
										<input name="first[{{$index}}]" id="checkbox1" type="hidden" value="0">
										<input name="first[{{$index}}]" id="checkbox1" type="checkbox" value="1">
									</td>

									<td>
										<input type="number" name="paid[{{$index}}]" class="form-control">
									</td>
									<td>
										<textarea class="form-control" name="note[{{$index}}]" id="" cols="10" rows="1"></textarea>
									</td>
								</tr>
								@empty
								@endforelse
								
							</tbody>
						</table>
						<div align="center">
							<button type="submit" class="btn btn-lg btn-out waves-effect waves-light btn-primary btn-square">Submit</button>
						</div>
						
				</div>
			</div>
		</form>
		</div>
	</div>
</div>