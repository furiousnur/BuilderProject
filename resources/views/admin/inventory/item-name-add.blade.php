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
				<h3 style="text-align: center;">New Item Name</h3>
				<form action="{{route('item.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Name: <span class="red">*</span></label>
		            	<input type="text" class="form-control" id="recipient-name" name="name" value="{{ old('name') }}" required="">
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

@php
$names=App\ItemName::all();
@endphp

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="card comp-card">
			<div class="card-body">
				<h5>All Item names</h5>
				<div class="table-responsive">
				  <table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($names as $index => $name)
					    <tr>
					      <th scope="row">{{$index+1}}</th>
					      <td>{{$name->name}}</td>
					      <td>
					      	<a href="{{route('item.edit',$name->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
							<a id="deleteBtn" data-id="{{$name->id}}" href="" class="btn btn-sm btn-outline-danger">Delete</a>
					      </td>
					    </tr>
						@endforeach
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
@endsection


@section('script')
<script>
    $(document).on('click', '#deleteBtn', function(el) {
        el.preventDefault();
        var postId = $(this).data("id");

        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Deleting...", {
              icon: "success",
            });
            window.location.href = window.location.href = "delete/" + postId;
          } 
        });

    });
</script>
@endsection