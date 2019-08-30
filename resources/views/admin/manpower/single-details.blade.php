@extends('admin.layouts.master')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<style>
	.form-group {
		margin-bottom: unset;
	}
	.form-group {
		margin-bottom: unset;
	}
	.search-form{
	  position: relative;
	  width: 250px;

	}
	.dataTables_wrapper .dataTables_filter input {
    margin-left: 0.5em;
    border-radius: 5px;
    /* box-shadow: inset -5px 20px 8px 0px; */
    border: 1px solid orange;
}
select {
    text-transform: none;
    padding: 4px;
    background: orange;
    border: orange;
    margin-bottom: 5px;
}
</style>
@endsection
@section('content')
<h2 style="text-align: center;">Profile of {{$labour->name}}</h2><br>
<div class="row">
	<div class="col-md-4">
		<div class="card comp-card">
			<div class="card-body">
				<div class="image-responsive" align="center">
					@if($labour->image=="" || !isset($labour->image) || $labour->image==NULL)
					<img height="120" width="120" src="{{asset('images/labour-image/man.png')}}" alt="">
					@else
					<img height="120" width="120" src="{{asset('images/labour-image/'.$labour->image)}}" alt="">
					@endif
				</div><hr>
				<div class="row">
					<div class="col-md-12" align="center">
						<h6>Name : {{$labour->name}}</h6>
						<h6>Project : {{$labour->project->name}}</h6>
						<p>Father Name : {{$labour->father_name}}</p>
						<p>Address : {{$labour->address}}</p>
						<p>Phone : {{$labour->phone}}</p>
						<p>Section : {{$labour->section}}</p>
						<h5 style="color: red;">Wages : {{$labour->wages}}</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card prod-p-card card-red">
			<div class="card-body">
				<div class="row align-items-center m-b-30">
					<div class="col">
						<h6 class="m-b-5 text-white">Total Payable Money</h6>
						<h3 class="m-b-0 f-w-700 text-white">৳ {{$payableMoney}}</h3>
					</div>
					<div class="col-auto">
						<i class="fas fa-money-bill-alt text-c-red f-18"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="card prod-p-card card-green">
			<div class="card-body">
				<div class="row align-items-center m-b-30">
					<div class="col">
						<h6 class="m-b-5 text-white">Total Paid</h6>
						<h3 class="m-b-0 f-w-700 text-white">৳ {{$paid}}</h3>
					</div>
					<div class="col-auto">
						<i class="fas fa-money-bill-alt text-c-red f-18"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="card prod-p-card card-yellow">
			<div class="card-body">
				<div class="row align-items-center m-b-30">
					<div class="col">
						<h6 class="m-b-5 text-white">Due</h6>
						<h3 class="m-b-0 f-w-700 text-white">৳ {{$due}}</h3>
					</div>
					<div class="col-auto">
						<i class="fas fa-money-bill-alt text-c-red f-18"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card comp-card">
			<div class="card-body">
				<form action="{{route('labours.transection')}}" method="post">
					@csrf
					<h3 style="text-align: center;">Pay Money</h3 >
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Date :<span class="red">*</span></label>
		            	<input type="date" class="form-control" id="recipient-name" name="date" required="" >
		            </div>
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Amount: <span class="red">*</span></label>
		            	<input name="project_id" type="hidden" value="{{$labour->project->id}}">
		            	<input name="labour_id" type="hidden" value="{{$labour->id}}">
		            	<input name="given_by" type="hidden" value="{{Auth::user()->id}}">
		            	<input type="text" class="form-control" id="recipient-name" name="amount">
		            </div>
		            
		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Note :</label>
		            	<textarea name="note" class="form-control" id="" cols="30" rows="4"></textarea>
		            </div>
					<br>
					<div class="form-group" align="center">
						<button type="submit" class="btn btn-mat btn-info btn-block"> Pay</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-header">
				<h3>Transection History</h3>
			</div>
			<div class="card-body">

				<div class="table-responsive-sm">
					<table class="table table-hover" id="tranTable">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Date</th>
					      <th scope="col">Amount</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($transections as $index => $transection)
					    <tr>
					      <th scope="row">1</th>
					      <td>{{date("d M, Y", strtotime($transection->date))}}</td>
					      <td>{{$transection->amount}} tk</td>
					    </tr>
						@endforeach
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row" align="center">
	<div class="col-md-8" id='calendar'>
		<div class="card comp-card">
			<div class="card-body">
				{!! $calendar->calendar() !!}
			</div>
		</div>
		
	</div>
	<div class="col-md-4">

		<div class="card comp-card">
			<div class="card-body">
				<form action="{{route('manpower.monthlypdf',$labour->id)}}" method="get">
					@csrf
					<h3 style="text-align: center;">Monthly working Report</h3 >
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Start Date :<span class="red">*</span></label>
		            	<input type="date" class="form-control" id="recipient-name" name="start" required="" >
		            </div>

		            <div class="form-group">
		            	<label for="recipient-name" class="col-form-label">End Date :<span class="red">*</span></label>
		            	<input type="date" class="form-control" id="recipient-name" name="end" required="" >
		            </div>
		            
					<br>
					<div class="form-group" align="center">
						<button type="submit" class="btn btn-mat btn-info btn-block"> Print</button>
					</div>
				</form>
			</div>
		</div>



		{{-- <a href="{{}}" class="btn btn-info">Last Month Report</a> --}}
	</div>
</div>
@endsection


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}

<script>
	$('#tranTable').DataTable();
</script>
@endsection