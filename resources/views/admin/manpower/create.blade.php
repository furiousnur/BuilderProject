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
				<h3 style="text-align: center;">Add a new Labour / Massion</h3>
				<form action="{{route('labours.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Name: <span class="red">*</span></label>
		            	<input type="text" class="form-control" id="recipient-name" name="name" value="{{ old('name') }}" required="">
		            </div>
		            <div class="form-group">
		            	<label for="father_name" class="col-form-label">Father Name : <span class="red">*</span></label>
		            	<input type="text" class="form-control" id="father_name" name="father_name" required="" name="{{ old('father_name') }}" required="">
		            </div>
		            
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Address : </label>
		            	<input type="text" class="form-control" id="recipient-name" name="address" value="{{ old('address') }}" required="">
		            </div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Phone :<span class="red">*</span></label>
		            	<input type="text" class="form-control" id="recipient-name" name="phone" required="" value="{!! old('phone') !!}" required="">
		            </div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Select Designation :<span class="red">*</span></label>
		            	<select name="designation" id="" class="form-control" required="">
							<option value="ENGINEER" >Engineer</option>
							<option value="Massion" >Massion</option>
							<option value="Labour" >Labour</option>
							<option value="Helper" >Helper</option>
						</select>
		            </div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Which Project :<span class="red">*</span> </label>
						<select name="project_id" id="" class="form-control" required="">
							<option disabled="" selected>Select Project</option>
							@foreach($projects as $project)
								<option {{ (old("project_id") == $project->id ? "selected":"") }} value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
							
						</select>
					</div>
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Section :</label>
		            	<input type="text" class="form-control" id="recipient-name" name="section" required="" value="{{old('section')}}">
		            </div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Wages per day :</label>
		            	<input type="text" class="form-control" id="recipient-name" name="wages" required="" value="{{old('wages')}}">
		            </div>
		            <div class="form-group">
		            	<label for="" class="col-form-label">Picture</label>
		            	<input type="file" class="form-control" id="" name="image">
		            </div>
					<br>
					<div class="form-group" align="center">
						<button type="submit" class="btn btn-mat btn-success"> Add</button>
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