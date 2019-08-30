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
	<div class="col-md-4">
		<div class="card comp-card">
			<div class="card-body">
				<h3 style="text-align: center;">Attendence List</h3><br>
				<form action="{{route('manpower-report.searchAttendence')}}" method="post" id="labSearch">
					@csrf
					<div class="form-group">
						
						<select name="pid" id="pid" class="form-control" required="">
							<option disabled="" selected>Select Project To See All Labour</option>
							@foreach($projects as $project)
							<option value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div><br>
					<div class="form-group">
						<label class="">Select Date : </label>
						<input type="date" id="date" name="date" class="form-control">
					</div>
					<br>
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-block btn-primary"><span style="font-size: 15px;">Search</span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
	<div class="col-md-4">
	</div>
</div>
<br>
<div id="ajaxResult">
	
</div>

@endsection


@section('script')

<script type="text/javascript">
$(document).ready(function() {

  $("#labSearch").submit(function(e) {
  	e.preventDefault();
    var pid=$("#pid").val();
    var date=$("#date").val();
    console.log(pid);
    $.ajax({
    	  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	      url  : "{{route('manpower-report.searchAttendence')}}",
	      type : "POST",
	      data : {pid:pid,date:date},
	      success : function(response){
	          $("#ajaxResult").html(response);

	      },

	      error : function(xhr, status){
	      }
  });
});
});


</script>


<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script>
$('#attendenceofday').DataTable( {
responsive: true,
dom: 'Bfrtip',
buttons: [
'csv', 'pdf', 'print'
]
} );
$('.buttons-csv, .buttons-print, .buttons-pdf').addClass('btn btn-success mr-1');
</script>
@endsection