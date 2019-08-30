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
				<h5 style="text-align: center;">Coustomer List</h5>
				<div class="table-responsive">
				  <table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">phone</th>
					      <th scope="col">address</th>
					      <th scope="col">Project</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($coustomers as $index => $coustomer)
					  	<td>{{$index+1}}</td>
					      <td><a href="{{route('coustomer.show',$coustomer->id)}}">{{$coustomer->name}}</a></td>
					      <td>{{$coustomer->phone}}</td>
					      <td>{{$coustomer->address}}</td>
					      @php
					      if (!empty($coustomer->project_id)) {
					      	$projectName=App\Project::findOrFail($coustomer->project_id)->value('name');
					      }else{
					      	$projectName='';
					      }
					      
					      @endphp
					      <td>{{$projectName}}</td>
					      	
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