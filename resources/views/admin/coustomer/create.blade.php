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
				<h3 style="text-align: center;">Add a Coustomer</h3>
				<form action="{{route('coustomer.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					
		            
		            <div class="form-group">
		            	<label for="unit" class="col-form-label">Name : <span class="red">*</span></label>
		            	<input type="text" class="form-control" id="" name="name" required="" value="{{old('name')}}">
		            </div>


		            <div class="form-group">
		            	<label for="unit" class="col-form-label">Phone : <span class="red">*</span></label>
		            	<input type="text" class="form-control" id="phone" name="phone" required="" value="{{old('phone')}}">
		            </div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Project: </label>
		            	<select name="project_id" id="" class="form-control" >
							<option disabled="" selected>Select project</option>
							@foreach($projects as $project)
								<option {{ (old("project_id") == $project->id ? "selected":"") }} value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
							
						</select>
		            </div>					
					<div class="form-group">
		            	<label for="note" class="col-form-label">Address :</label>
		            	<textarea class="form-control" name="address" id="" cols="30" rows="5" required="">{!! old('address')!!}</textarea>
		            </div>
					
					<br>
					<div class="form-group" align="center">
						<button type="submit" class="btn btn-mat btn-primary">Add</button>
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