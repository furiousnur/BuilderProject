@extends('admin.layouts.master')


@section('content')

<br>
<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<form action="{{route('attendence.updateAttendence')}}" method="POST">
			<div class="card-body">
				<h3 style="text-align: center;">Update Attendence of <span class="label label-inverse-info">{{$project->name}}</span> Project</h3>
				<div align="center">
					<div class="col-md-4"> Date : <input class="form-control" name="date" type="date" id="#dropper-default" required="" value="{{$date}}" readonly=""></div>
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
									<th scope="col">2nd</th>
									<th scope="col">3rd</th>
									<th scope="col">4th</th>
									<th scope="col">Food / Advance</th>
									<th scope="col">Note</th>
								</tr>
							</thead>
							<tbody>
								
								<input type="hidden" name="project_id" value="{{$project->id}}">
								@forelse($attendence as $index => $attendence)
								<input type="hidden" name="attendence_id[]" value="{{$attendence->id}}">
								<tr>
									<th scope="row">{{$index+1}}</th>
									<td>
										<a href="{{route('labours.show',$attendence->labour->id)}}">{{$attendence->labour->name}}</a>
										<input type="hidden" name="labour_id[]" value="{{$attendence->labour->id}}">
									</td>

									<td>
										@if($attendence->labour->designation=='Massion')
										<span class="label label-success">{{$attendence->labour->designation}}</span>
										@elseif($attendence->labour->designation=='Helper')
										<span class="label label-warning">{{$attendence->labour->designation}}</span>
										@else
										<span class="label label-primary">{{$attendence->labour->designation}}</span>
										@endif
									</td>

									<td>
										@if($attendence->first)
											<input name="first[{{$index}}]" id="checkbox1" type="hidden" value="0">
											<input name="first[{{$index}}]" id="checkbox1" type="checkbox" value="1" checked="">
										@else
										<input name="first[{{$index}}]" id="checkbox1" type="hidden" value="0">
										<input name="first[{{$index}}]" id="checkbox1" type="checkbox" value="1">
										@endif
										
									</td>

									<td>
										@if($attendence->secound)
										<input name="secound[{{$index}}]" id="checkbox2" type="hidden" value="0">
										<input name="secound[{{$index}}]" id="checkbox2" type="checkbox" value="1" checked="">
										@else
										<input name="secound[{{$index}}]" id="checkbox2" type="hidden" value="0">
										<input name="secound[{{$index}}]" id="checkbox2" type="checkbox" value="1">
										@endif
									</td>

									<td>
										@if($attendence->third)
										<input name="third[{{$index}}]" id="checkbox3" type="hidden" value="0">
										<input name="third[{{$index}}]" id="checkbox3" type="checkbox" value="1" checked="">
										@else
										<input name="third[{{$index}}]" id="checkbox3" type="hidden" value="0">
										<input name="third[{{$index}}]" id="checkbox3" type="checkbox" value="1">
										@endif
									</td>

									<td>
										@if($attendence->fourth)
										<input name="fourth[{{$index}}]" id="checkbox4" type="hidden" value="0">
										<input name="fourth[{{$index}}]" id="checkbox4" type="checkbox" value="1" checked="">
										@else
										<input name="fourth[{{$index}}]" id="checkbox4" type="hidden" value="0">
										<input name="fourth[{{$index}}]" id="checkbox4" type="checkbox" value="1">
										@endif
									</td>

									<td>
										<input type="number" name="paid[{{$index}}]" class="form-control" value="{{$attendence->paid}}">
									</td>

									<td>
										<textarea class="form-control" name="note[{{$index}}]" id="" cols="10" rows="1">{{$attendence->note}}</textarea>
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

@endsection