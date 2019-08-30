@extends('admin.layouts.master')
@section('style')
<style>
	.form-group {
margin-bottom: unset;
	}
	.form-group {
	margin-bottom: unset;
	}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="card comp-card">
			<div class="card-body">
				<h3 style="text-align: center;"> Update attendence of a date</h3>
				<form action="{{route('attendence.editForm')}}" method="get">
					@csrf
		            <div class="form-group">
		            	<label for="project_id" class="col-form-label">Select Project : <span class="red">*</span> </label>
						<select name="project_id" id="pid" class="form-control" required="">
							
							@foreach($projects as $project)
							<option value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Date : <span class="red">*</span></label>
		            	<input type="date" class="form-control" id="recipient-name" name="date" value="" required="">
		            </div>
					<br>
					<div class="form-group" align="center">
						<button type="submit" class="btn btn-mat btn-primary"> Search</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>


</div>
<br>

@endsection


@section('script')

@endsection