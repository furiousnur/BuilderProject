@extends('admin.layouts.master')
{{-- testing line.. deleteabla --}}
@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="card comp-card">
			<div class="card-body">
			    <div class="row align-items-center">
			        <div class="col">
			            <h6 class="m-b-25">IIImpressions</h6>
			            <h3 class="f-w-700 text-c-blue">1,563</h3>
			            <p class="m-b-0">May 23 - June 01 (2017)</p>
			        </div>
			        <div class="col-auto">
			            <i class="fas fa-eye bg-c-blue"></i>
			        </div>
			    </div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card comp-card">
	        <div class="card-body">
	            <div class="row align-items-center">
	                <div class="col">
	                    <h6 class="m-b-25">Goal</h6>
	                    <h3 class="f-w-700 text-c-green">30,564</h3>
	                    <p class="m-b-0">May 23 - June 01 (2017)</p>
	                </div>
	                <div class="col-auto">
	                    <i class="fas fa-bullseye bg-c-green"></i>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="col-md-4">
		<div class="card comp-card">
	        <div class="card-body">
	            <div class="row align-items-center">
	                <div class="col">
	                    <h6 class="m-b-25">Bingo</h6>
	                    <h3 class="f-w-700 text-c-yellow">42.6%</h3>
	                    <p class="m-b-0">May 23 - June 01 (2017)</p>
	                </div>
	                <div class="col-auto">
	                    <i class="fas fa-hand-paper bg-c-yellow"></i>
	                </div>
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