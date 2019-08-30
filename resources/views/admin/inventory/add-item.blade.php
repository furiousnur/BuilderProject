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
				<h3 style="text-align: center;">Add a new item in Inventory</h3>
				<form action="{{route('inventory.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Select Name: <span class="red">*</span></label>
		            	<select name="item_name_id" id="" class="form-control" required="">
							@foreach($itemNames as $itemName)
								<option {{ (old("item_name_id") == $itemName->id ? "selected":"") }} value="{{$itemName->id}}">{{$itemName->name}}</option>
							@endforeach
							
						</select>
		            </div>
		            
		            <div class="form-group">
		            	<label for="unit" class="col-form-label">Unit Name : <span class="red">*</span></label>
		            	<input type="text" class="form-control" id="unit" name="unit" required="" name="{{ old('unit') }}" placeholder="Kg / Bosta / Piece">
		            </div>

		            <div class="form-group">
		            	<label for="quentity" class="col-form-label">Quentity : <span class="red">*</span></label>
		            	<input type="text" class="form-control" id="quentity" name="quentity" value="{{ old('quentity') }}" required="">
		            </div>

		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Cost : <span class="red">*</span></label>
		            	<input type="text" class="form-control" name="cost" value="{{ old('cost') }}" required="">
		            </div>
					<br>

		            <div class="form-check">
		            {{-- <label class="col-form-label">Reuseble : <span class="red">*</span></label><br> --}}
					  <input class="form-check-input" type="hidden" name="reusable" id="exampleRadios1" value="1" required="" checked>
					  {{-- <label class="form-check-label" for="exampleRadios1">
					    Yes
					  </label> --}}
					</div>
					{{-- <div class="form-check">
					  <input class="form-check-input" type="radio" name="reusable" id="exampleRadios2" value="0" required="">
					  <label class="form-check-label" for="exampleRadios2">
					    No
					  </label>
					</div> --}}
					<br>
		            

		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Select Vendor : <span class="red">*</span><span class="red">*</span></label>
		            	<select name="vendor_id" id="" class="form-control" required="">
							@foreach($vendors as $vendor)
								<option {{ (old("vendor_id") == $vendor->id ? "selected":"") }} value="{{$vendor->id}}" >{{$vendor->name}}</option>
							@endforeach
						</select>
		            </div>
		            <br>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Which Project : <span class="red">*</span><span class="red">*</span> </label>
						<select name="project" id="" class="form-control" required="">
							@foreach($projects as $project)
								<option {{ (old("project_id") == $project->id ? "selected":"") }} value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
							
						</select>
					</div>
					<div class="form-group">
		            	<label for="note" class="col-form-label">Note :</label>
		            	<textarea class="form-control" name="note" id="" cols="30" rows="5">{!!old('note')!!}</textarea>
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