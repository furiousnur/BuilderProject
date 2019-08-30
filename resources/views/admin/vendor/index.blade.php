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
		
		<a class="btn waves-effect waves-light btn-warning" href="{{route('vendor.create')}}">
      <i class="fas fa-plus"></i>Create Vendor</a>
	</div>
  
	
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <div class="card comp-card">
          <div class="card-body">
            <h3 style="text-align: center;">All Projects</h3>
              <div class="table-responsive">
                <table class="table" id="vendors">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Project Name</th>
                      <th scope="col">Address</th>
                      <th scope="col">Phone</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($vendors as $index => $vendor)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td><a href="{{route('vendor.show',$vendor->id)}}">{{$vendor->name}}</a></td>
                      <td>{{$vendor->address}}</td>
                      <td>{{$vendor->phone}}</td>
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
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script>  
  $('#vendors').DataTable( {
    responsive: true,
    dom: 'Bfrtip',
    buttons: [
        'csv', 'pdf', 'print'
    ]
} );
  $('.buttons-csv, .buttons-print, .buttons-pdf').addClass('btn btn-success mr-1');
</script>
@endsection