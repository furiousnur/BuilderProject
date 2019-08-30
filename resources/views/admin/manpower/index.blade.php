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
@if(Auth::user()->id==1)
<div class="row">
	<div class="col-md-4">
		<div class="card comp-card">
			<div class="card-body">
				<form action="{{route('labours.search')}}" method="post" id="labSearch">
					@csrf
					<div class="form-group">
						<label class="label label-inverse-success">See Labour List</label>
						<select name="pid" id="pid" class="form-control" required="">
							<option disabled="" selected>Select Project To See All Labour</option>
							@foreach($projects as $project)
							<option value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div><br>
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-block hor-grd btn-grd-success"><span style="font-size: 15px;">See List</span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="card comp-card">
			<div class="card-body">
				<form action="{{route('labours.attendence')}}" method="post" id="labAttendence">
					@csrf
					<div class="form-group">
						<label class="label label-inverse-info">Take Attendence</label>
						<select name="pid" id="pid1" class="form-control" required="">
							<option disabled="" selected>Select Project To Take Attendence</option>
							@foreach($projects as $project)
							<option value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div><br>
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-block hor-grd btn-grd-primary"><span style="font-size: 15px;">Take Attendence</span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br>
<div id="ajaxResult">
	<div class="row" align="center">
		<div class="col-md-12">
			<div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center m-b-30">
                        <div class="col-auto">
                            <i class="fas fa-search text-c-red f-30"></i>
                        </div>
                        <div class="col p-l-0">
                            <h2 class="m-b-5">Your Search Result Will Appear Here!</h2>
                            <h6 class="m-b-0 text-c-red">Live Update</h6>
                        </div>
                    </div>
                    <div class="row align-items-center text-center">
                        <div class="col">
                            <h4 class="m-b-0"><label class="label label-primary">{{$count}} Projects</label> </h4></div>
                        <div class="col"><i class="fas fa-exchange-alt text-c-red f-18"></i></div>
                        <div class="col">
                            <h4 class="m-b-0"><label class="label label-primary">{{$manCount}} workers </label></h4></div>
                    </div>
                    <h6 class="pt-badge bg-c-red"><i class="fas fa-users"></i></h6>
                </div>
            </div>
		</div>
	</div>
</div>



@else


<div class="row">
	<div class="col-md-4">
		<div class="card comp-card">
			<div class="card-body">
				<form action="{{route('labours.search')}}" method="post" id="labSearch">
					@csrf
					<div class="form-group">
						<label class="label label-inverse-success">See Labour List</label>
						<select name="pid" id="pid" class="form-control" required="">
							<option disabled="" selected>Select Project To See All Labour</option>
						
							<option value="{{$project->id}}">{{$project->name}}</option>
						</select>
					</div><br>
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-block hor-grd btn-grd-success"><span style="font-size: 15px;">See List</span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="card comp-card">
			<div class="card-body">
				<form action="{{route('labours.attendence')}}" method="post" id="labAttendence">
					@csrf
					<div class="form-group">
						<label class="label label-inverse-info">Take Attendence</label>
						<select name="pid" id="pid1" class="form-control" required="">
							<option disabled="" selected>Select Project To Take Attendence</option>
							<option value="{{$project->id}}">{{$project->name}}</option>
						</select>
					</div><br>
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-block hor-grd btn-grd-primary"><span style="font-size: 15px;">Take Attendence</span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<br>
<div id="ajaxResult">
</div>


@endif


@endsection


@section('script')

<script type="text/javascript">
$(document).ready(function() {

  $("#labSearch").submit(function(e) {
  	e.preventDefault();
    var pid=$("#pid").val();
    console.log(pid);
    $.ajax({
    	  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	      url  : "{{route('labours.search')}}",
	      type : "POST",
	      data : {pid:pid},
	      success : function(response){
	          $("#ajaxResult").html(response);

	      },

	      error : function(xhr, status){
	      }
  });
});
});


// ajax request for attendence

$(document).ready(function() {

  $("#labAttendence").submit(function(e) {
  	e.preventDefault();
    var pid=$("#pid1").val();
    console.log(pid);
    $.ajax({
    	  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	      url  : "{{route('labours.attendence')}}",
	      type : "POST",
	      data : {pid:pid},
	      success : function(response){
	          $("#ajaxResult").html(response);
	          // alert(response);
	          // console.log(response);
	      },

	      error : function(xhr, status){
	          // alert('There is some error.Try after some time.');
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
$('#allProjects').DataTable( {
responsive: true,
dom: 'Bfrtip',
buttons: [
'csv', 'pdf', 'print'
]
} );
$('.buttons-csv, .buttons-print, .buttons-pdf').addClass('btn btn-success mr-1');
</script>


@endsection