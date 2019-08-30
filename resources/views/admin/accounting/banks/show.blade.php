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
				<h4 class="text-center">{{$bank->name}} Ledger</h4>
			    <div class="table-responsive">
				  <table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col" style="width: 10%">#</th>
					      <th scope="col" style="width: 10%">Perpose</th>
                <th scope="col" style="width: 30%">Description</th>
                <th scope="col" style="width: 10%">Date</th>
                <th scope="col" style="width: 10%">Credit</th>
					      <th scope="col" style="width: 10%">Debit</th>
                
                <th scope="col" style="width: 20%">Balance</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($bank->recharges as $index => $transection)
					    <tr>
					    	<td>{{$index+1}}</td>

					    	<td>
                  @if(!empty($transection->vendor_id))
                    <a href="{{route('vendor.show',$transection->vendor_id)}}"><span class="label label-info">Vendor</span></a>
                  @elseif(!empty($transection->manager_id))
                    <a href="{{route('manager.show',$transection->manager_id)}}"><span class="label label-warning">To Manager</span></a>
                  @elseif(empty($transection->manager_id) && empty($transection->vendor))
                    <span class="label label-success">Invest</span>
                  @endif
                </td>
                <td>{{$transection->note}}</td>

                <td>{{$transection->created_at->format('d M, Y')}}</td>
                @if($transection->type=="CREDIT")
                `@php
                  $balance+=$transection->amount;
                  @endphp
                  
                  <td>{{$transection->amount}}</td>
                  <td></td>
                @else

                @php
                  $balance-=$transection->amount;
                  @endphp
                  <td></td>
                  <td>{{$transection->amount}}</td>
                  
                  
                @endif

                <td>{{$balance}}</td>
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
<script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection