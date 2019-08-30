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
				<h3 style="text-align: center;">Edit Item</h3>
				<form action="{{route('item.update',$itemName->id)}}" method="post">
					@csrf
					<input name="_method" type="hidden" value="PUT">
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Name: <span class="red">*</span></label>
		            	<input type="text" class="form-control" name="name" value="{{$itemName->name}}" required="">
		            </div>
					<br>
					<div class="form-group" align="center">
						<button type="submit" class="btn btn-mat btn-primary">Edit</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>

@endsection


@section('script')

@endsection