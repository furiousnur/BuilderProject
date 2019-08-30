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
				<h3 style="text-align: center;"> Create a Manager</h3>
				<form action="{{route('manager.store')}}" method="post">
					@csrf
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Name: <span class="red">*</span></label>
		            	<input type="text" class="form-control" id="recipient-name" name="name" value="" required="" value="{{old('name')}}">
		            </div>
		            <br>
		            <div class="form-group">
		            	<label for="pid" class="col-form-label">Which Project : <span class="red">*</span> </label>
						<select name="project_id" id="pid" class="form-control" required="">
							@foreach($projects as $project)
							<option {{ (old("project_id") == $project->id ? "selected":"") }} value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div>
		            

		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Password :</label>
		            	<input type="text" class="form-control" id="recipient-name" name="password" required="">
		            </div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Confirm Password :</label>
		            	<input type="text" class="form-control" id="recipient-name" name="password_confirmation" value="" required="">
		            </div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Phone :</label>
		            	<input type="text" class="form-control" id="recipient-name" name="phone" value="{{old('phone')}}" required="">
		            </div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Email :</label>
		            	<input type="text" class="form-control" id="recipient-name" name="email" value="{{old('email')}}" required="" >
		            </div>
					<br>
					<div class="form-group" align="center">
						<button type="submit" class="btn btn-mat btn-primary"> Create</button>
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