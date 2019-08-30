@php
$totalExpence=(App\LabourTransection::where('given_by',$manager->user->id)->sum('amount'))+App\ItemTransection::where('given_by',$manager->user->id)->where('bank_id',0)->sum('paid');
$remainBalance=(App\ManagerTransection::where('manager_id',$manager->user->id)->where('type','CREDIT')->sum('amount'))-($totalExpence);
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
<h1 class="text-center">Manager Details</h1>
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
				<h5 class="text-center text-success">Name : {{$manager->user->name}}</h5>
				<h6 class="text-center">Phone : {{$manager->user->phone}}</h6>
				
				<h6 class="text-center">Email : {{$manager->user->email}}</h6>
				<h6 class="text-center">Project : {{$manager->project->name}}</h6>
				
			</div>
		</div>
	</div>
	@php
	@endphp
	<div class="col-md-4">
		<div class="card prod-p-card card-red">
			<div class="card-body">
				<div class="row align-items-center m-b-30">
					<div class="col">
						<h6 class="m-b-5 text-white">Total Expence 	</h6>
						<h3 class="m-b-0 f-w-700 text-white">৳ {{$totalExpence}}</h3>
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
						<h6 class="m-b-5 text-white">Remaining Balance</h6>
						<h3 class="m-b-0 f-w-700 text-white">৳ {{$remainBalance}}</h3>
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
	</div>
</div>
<div id="ajaxResult">
<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h6 class="text-center">Last 7 Days Transection List (Manpower)</h6>
				<div class="table-responsive">
					<table id="table1" class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Labour/Massion/Engineer Name</th>
								
								<th scope="col">Date</th>
								<th scope="col">Amount</th>

							</tr>
						</thead>
						<tbody>
							@foreach($transections as $index => $transection)
							<tr>
								<td>{{$index+1}}</td>
								<td><a href="{{route('labours.show',$transection->labour->id)}}">{{$transection->labour->name}} | ID={{$transection->labour->id}}</a></td>
								
								<td>{{$transection->created_at->format('d M, Y')}}</td>
								<td>{{$transection->amount}}</td>
							</tr>
							@endforeach
							<tr>
								<th></th>
								<th></th>
								<th>Total</th>
								<th>{{$transections->sum('amount')}}</th>
								
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<br>


<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h6 class="text-center">Last 7 Days Transection List (Vendor)</h6>
				<div class="table-responsive">
					<table id="table3" class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Vendor Name</th>
								
								<th scope="col">Date</th>
								<th scope="col">Amount</th>

							</tr>
						</thead>
						<tbody>
							@foreach($vendorTransection as $index => $vtransection)
							<tr>
								<td>{{$index+1}}</td>
								<td>
									@php
									$vendor=App\Vendor::find($vtransection->vendor_id);
									@endphp
									<a href="{{route('vendor.show',$vendor->id)}}">{{$vendor->name}} | ID={{$vendor->id}}</a></td>
								
								<td>{{$transection->created_at->format('d M, Y')}}</td>
								<td>{{$transection->amount}}</td>
							</tr>
							@endforeach
							<tr>
								<th></th>
								<th></th>
								<th>Total</th>
								<th>{{$transections->sum('amount')}}</th>
								
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<br>


<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h6 class="text-center">Cash Recived from admin</h6>
				<div class="table-responsive">
					<table id="table2" class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>						
								<th scope="col">Method</th>						
								<th scope="col">Date</th>
								<th scope="col">Amount</th>

							</tr>
						</thead>
						<tbody>
							@foreach($recive as $index => $money)
							<tr>
								<td>{{$index+1}}</td>
								<td>{{$money->bank->name}}</td>
								<td>{{$money->created_at->format('d M, Y')}}</td>
								<td>{{$money->amount}}</td>
							</tr>
							@endforeach
							<tr>
								<th></th>
								<th></th>
								<th>Total</th>
								<th>{{$recive->sum('amount')}}</th>
								
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

	
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

	('#table3').DataTable( {
	    responsive: true,
	    dom: 'Bfrtip',
	    buttons: [
	        'csv', 'pdf', 'print'
	    ]
	} );
</script>
@endsection