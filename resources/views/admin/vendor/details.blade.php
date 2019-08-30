@php
$v=$vendor;

$paid=App\BankRecharge::where('vendor_id',$vendor->id)->where('type','DEBIT')->sum('amount')+App\ItemTransection::where('vendor_id',$vendor->id)->where('bank_id',0)->sum('paid');

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
<h1 class="text-center">Vendor Details</h1>
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
				<h5 class="text-center text-success">Name : {{$vendor->name}}</h5>
				<h6 class="text-center">Phone : {{$vendor->phone}}</h6>
				
				<h6 class="text-center">Address : {{$vendor->address}}</h6>
				
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
						<h6 class="m-b-5 text-white">Total Payable Money</h6>
						<h3 class="m-b-0 f-w-700 text-white">৳ {{$vendor->items->sum('cost')}}</h3>
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
						<h3 class="m-b-0 f-w-700 text-white">৳ {{$vendor->items->sum('cost')-$paid}}</h3>
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
				<form action="{{route('transection.store')}}" method="post">
					@csrf
					<h3 style="text-align: center;">Pay Money</h3 >
					<input type="hidden" name="vendor_id" value="{{$vendor->id}}">
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Date :<span class="red">*</span></label>
						<input type="date" class="form-control" id="recipient-name" name="date" required="">
					</div>
					@if(Auth::user()->role==1)
					<div class="form-group">
						<label for="" class="col-form-label">Account <span class="red">*</span></label>
						<select name="bank_id" id="" class="form-control" required>
							<option selected disabled>Select a bank account</option>
							@foreach($banks as $bank)
							<option value="{{$bank->id}}">{{$bank->name}}</option>
							@endforeach
						</select>
					</div>
					@endif
					<div class="form-group">
						<label for="" class="col-form-label">Item for <span class="red">*</span></label>
						<select name="item_id" id="" class="form-control" required>
							<option selected disabled>Select Item</option>
							@foreach($v->items as $item)
							<option value="{{$item->id}}">{{$item->itemName->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Amount to pay: <span class="red">*</span></label>
						<input type="text" class="form-control" id="recipient-name" name="paid" required="">
					</div>
					
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Note :</label>
						<textarea name="note" class="form-control" id="" cols="30" rows="3"></textarea>
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
<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h6 class="text-center"> Transection List</h6>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Date</th>
								<th scope="col">Amount</th>
								<th scope="col">Method</th>
								<th scope="col">Item</th>

							</tr>
						</thead>
						<tbody>
							@foreach($vendor->itemTransections as $index => $transection)
							<tr>
								<td>{{$index+1}}</td>
								<td>{{$transection->date}}</td>
								<td>{{$transection->paid}}</td>
								@if($transection->bank_id==0)
								<td><span class="label label-info">From manager : {{$transection->user->name}}</span></td>
								@else
								<td><span class="label label-warning">From Admin : {{$transection->bank->name}}</span></td>
								@endif
								
								<td>{{$transection->item->itemName->name}}</td>
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

<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h4 class="text-center"> Item List of this Vendor</h4>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Item Name</th>
								<th scope="col">Project Name</th>
								<th scope="col">Quentity</th>
								<th scope="col">Price</th>

							</tr>
						</thead>
						<tbody>
							@foreach($vendor->items as $index => $item)
							<tr>
								<td>{{$index+1}}</td>
								<td>{{$item->itemName->name}}</td>
								<td>{{$item->itemLog->project->name}}</td>
								<td>{{$item->itemLog->quentity}}</td>
								
								<td>{{$item->cost}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')
@endsection