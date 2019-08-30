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
				<h3 style="text-align: center;"> Add a Vendor</h3>
				<form action="{{route('vendor.store')}}" method="post">
					@csrf
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Name: <span class="red">*</span></label>
		            	<input type="text" class="form-control" id="recipient-name" name="name" value="{{ old('name') }}" required="">
		            </div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Address : </label>
		            	<input type="text" class="form-control" id="recipient-name" name="address" value="{{ old('address') }}" required="">
		            </div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Phone :</label>
		            	<input type="text" class="form-control" id="recipient-name" name="phone" value="{!! old('phone') !!}" required="">
		            </div>
		            <div class="form-group">
						<label for="recipient-name" class="col-form-label">Which Project :<span class="red">*</span> </label>
						<select name="project_id" id="" class="form-control" required="">
							
							@foreach($projects as $project)
								<option {{ (old("project_id") == $project->id ? "selected":"") }} value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
							
						</select>
					</div>
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Note :</label>
		            	<textarea name="note" cols="30" rows="5" class="form-control">{!! old('note') !!}</textarea>
		            </div>
					<br>
					<div class="form-group" align="center">
						<button type="submit" class="btn btn-mat btn-primary"> Add</button>
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