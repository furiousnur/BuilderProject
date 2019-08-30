
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
<h3 class="text-center">Transection Details of {{$manager->name}}</h3>

<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h6 class="text-center"><p style="color: red;" class="text-center">Start : {{$start}} || End : {{$end}}</p></h6>
				<div class="table-responsive">
					<table class="table table-hover">
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

@endsection
@section('script')
@endsection