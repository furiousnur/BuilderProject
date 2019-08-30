@php
$totalRecive=App\BankRecharge::where('coustomer_id',$coustomer->id)->sum('amount');
$transections=App\BankRecharge::where('coustomer_id',$coustomer->id)->get();
@endphp
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
<h1 class="text-center">Coustomer Details</h1>
<hr>
<div class="row">
	<div class="col-md-4">
		<div class="card comp-card" style="    min-height: 310px;">
			<div class="card-body">
				<div class="row">
					<div style="margin: 0 auto;">
						<img  height="80" width="80" src="{{asset('images/labour-image/man.png')}}" alt="">
					</div>
				</div>
				<br>
				<h5 class="text-center text-success">Name : {{$coustomer->name}}</h5>
				<h6 class="text-center">Phone : {{$coustomer->phone}}</h6>
				
				<h6 class="text-center">address : {{$coustomer->address}}</h6>
				@php
			      if (!empty($coustomer->project_id)) {
			      	$projectName=App\Project::findOrFail($coustomer->project_id)->value('name');
			      }else{
			      	$projectName='';
			      }
			      
			     @endphp
				<h6 class="text-center">Project : {{$projectName}}</h6>
				
			</div>
		</div>
	</div>
	@php
	@endphp
	<div class="col-md-4">
		<div class="card prod-p-card card-blue">
			<div class="card-body">
				<div class="row align-items-center m-b-30">
					<div class="col">
						<h6 class="m-b-5 text-white">Recived</h6>
						<h3 class="m-b-0 f-w-700 text-white">৳ {{$totalRecive}}</h3>
					</div>
					<div class="col-auto">
						<i class="fas fa-money-bill-alt text-c-red f-18"></i>
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="card prod-p-card card-green">
			<div class="card-body">
				<div class="row align-items-center m-b-30">
					<div class="col">
						<h6 class="m-b-5 text-white">Remaining Balance</h6>
						<h3 class="m-b-0 f-w-700 text-white">৳ </h3>
					</div>
					<div class="col-auto">
						<i class="fas fa-money-bill-alt text-c-red f-18"></i>
					</div>
				</div>
			</div>
		</div> --}}

	</div>
{{-- 	<div class="col-md-4">
		<div class="card comp-card">
			<div class="card-body">
				<form action="{{route('manager.transection.search')}}" method="post">
					@csrf
					<h3 style="text-align: center;">Search</h3 >
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">Start :<span class="red">*</span></label>
		            	<input type="date" class="form-control" id="recipient-name" name="start" required="" >
		            </div>
					<div class="form-group">
		            	<label for="recipient-name" class="col-form-label">End: <span class="red">*</span></label>
		            	<input name="manager_id" type="hidden" value="{{$manager->user->id}}">
		            	<input type="date" class="form-control" id="recipient-name" name="end">
		            </div>
					<br>
					<div class="form-group" align="center">
						<button type="submit" class="btn btn-mat btn-info btn-block"> Search</button>
					</div>
				</form>
			</div>
		</div>
	</div> --}}
</div>
<div id="ajaxResult">
<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h6 class="text-center">Transection History</h6>
				<div class="table-responsive">
					<table id="table1" class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Bank Name</th>
								<th scope="col">Description</th>
								<th scope="col">Recived Date</th>
								<th scope="col">Recived Amount</th>
							</tr>
						</thead>
						<tbody>
							@foreach($transections as $index => $transection)
							<tr>
								<td>{{$index+1}}</td>
								<td>{{$transection->bank->name}}</td>
								<td>{{$transection->note}}</td>
								
								<td>{{$transection->created_at->format('d M, Y')}}</td>
								<td>{{$transection->amount}}</td>
								
							</tr>
							@endforeach
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th> <span style="color: red;">Total</span></th>
								<th> <span style="color: red;">{{$transections->sum('amount')}}</span>
								
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<br>

	
</div>
@endsection
@section('script')
<script>
	$('#table1').DataTable( {
	    responsive: true,
	    dom: 'Bfrtip',
	    buttons: [
	        'csv', 'pdf', 'print'
	    ]
	});

	$('#table2').DataTable( {
	    responsive: true,
	    dom: 'Bfrtip',
	    buttons: [
	        'csv', 'pdf', 'print'
	    ]
	} );
</script>
@endsection