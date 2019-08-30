<br>
<style>
.dot-success {
  height: 20px;
  width: 20px;
  background-color: #00af5e;
  border-radius: 50%;
  display: inline-block;
}
.dot-danger {
  height: 20px;
  width: 20px;
  background-color: #ec4747;
  border-radius: 50%;
  display: inline-block;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h3 style="text-align: center;">Attendence of <span class="label label-inverse-info">{{$project->name}}</span> Project</h3>
				<div align="center">
					<div class="col-md-4"> Date : {{$date}}</div>
				</div>
				<br>

				@if(count($attendence) <= 0)
				<div>
					<h3 style="text-align: center;margin-top: 20px;color: red;">No Attendence Found in {{$date}}!!</h3>
				</div>
				@else
				<div class="table-responsive">
					<table class="table" id="attendenceofday">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col">1st Shift</th>
								<th scope="col">2nd Shift</th>
								<th scope="col">3rd Shift</th>
								<th scope="col">4th Shift</th>
								<th scope="col">Food</th>
							</tr>
						</thead>
						<tbody>
							@foreach($attendence as $index => $attendence)
							<tr>
								<td>{{$index+1}}</td>
								<td>{{$attendence->labour->name}}</td>
								<td>
									@if($attendence->first)
									<span class="dot-success"></span>
									@else
									<span class="dot-danger"></span>
									@endif
								</td>
								<td>
									@if($attendence->secound)
									<span class="dot-success"></span>
									@else
									<span class="dot-danger"></span>
									@endif
								</td>
								<td>
									@if($attendence->third)
									<span class="dot-success"></span>
									@else
									<span class="dot-danger"></span>
									@endif
								</td>
								<td>
									@if($attendence->fourth)
									<span class="dot-success"></span>
									@else
									<span class="dot-danger"></span>
									@endif
								</td>
								<td>
									<h3><span class="badge badge-primary">{{$attendence->paid}}</span></h3>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endif
				
				
			</div>
		</div>
	</div>
</div>