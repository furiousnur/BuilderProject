

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
				<h5 style="text-align: center;">Manager List</h5>
				<div class="table-responsive">
				  <table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">Project</th>
					      <th scope="col">Phone</th>
					      <th scope="col">Email</th>
					      <th scope="col">Remaining Balance</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($managers as $index => $manager)

						  	@php

							$remainBalance=(App\ManagerTransection::where('manager_id',$manager->user->id)->sum('amount'))-(App\LabourTransection::where('given_by',$manager->user->id)->sum('amount'));
							@endphp
					    <tr>
					      <th scope="row">{{$index+1}}</th>
					      <td><a href="{{route('manager.show',$manager->user->id)}}">{{$manager->user->name}}</a></td>
					      <td>{{$manager->project->name}}</td>
					      <td>{{$manager->user->phone}}</td>
					      <td>{{$manager->user->email}}</td>
					      <td>{{$remainBalance}}</td>
					      	
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