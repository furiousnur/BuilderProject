@php
$balance=0;
@endphp
@extends('admin.layouts.master')
{{-- testing line.. deleteabla --}}
@section('content')


<div class="row">

	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h4 class="text-center"> Incomes</h4>
			    <div class="table-responsive">
				  <table id="example" class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col" style="width: 10%">#</th>
                <th scope="col" style="width: 10%">Bank</th>
                <th scope="col" style="width: 30%">Description</th>
                <th scope="col" style="width: 10%">Date</th>
                <th scope="col" style="width: 10%">Credit</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($transections as $index => $transection)
					    <tr>
					    	<td>{{$index+1}}</td>
                <td>{{$transection->bank->name}}</td>
                <td>{{$transection->note}}</td>
                <td>{{$transection->created_at->format('d M, Y')}}</td>
                @if($transection->type=="CREDIT")
                `@php
                  $balance+=$transection->amount;
                  @endphp
                  
                  <td>{{$transection->amount}}</td>
                @endif
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
{{-- <script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script> --}}
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection