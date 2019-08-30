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


@if(Auth::user()->role==1)


<div class="row">
	<div class="col-md-4">
		
		<button class="btn waves-effect waves-light btn-warning" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-plus"></i>Create Project</button>
		
	</div>
  
	
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <div class="card comp-card">
          <div class="card-body">
            <h3 style="text-align: center;">All Projects</h3>
              <div class="table-responsive">
                <table class="table" id="allProjects">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Project Name</th>
                      <th scope="col">Location</th>
                      <th scope="col">Client Name</th>
                      <th scope="col">Est Total</th>
                      <th scope="col">Status</th>
                      <th scope="col">Starting Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($projects as $index => $project)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td><a href="{{route('projects.show',$project->id)}}">{{$project->name}}</a></td>
                      <td>{{$project->location}}</td>
                      <td>{{$project->client_name}}</td>
                      <td>{{$project->price}}</td>
                      <td>{{$project->status}}</td>
                      <td>{{$project->created_at->format('d M, Y')}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>



{{-- modal --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('projects.store')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="recipient-name" name="name" required="" value="{{old('name')}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Location</label>
            <input type="text" class="form-control" id="recipient-name" name="location" required="" value="{{old('location')}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Client Name</label>
            <input type="text" class="form-control" id="recipient-name" name="client_name" required="" value="{{old('client_name')}}">
          </div>
          <div class="form-group">
            <label for="recipient-name1" class="col-form-label">Project Estimated Total</label>
            <input type="text" class="form-control" id="recipient-name1" name="price" required="" value="{{old('price')}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Status</label>
      			<select name="status" id="" class="form-control" required="">
      				<option selected value="ACTIVE">Active</option>
      				<option value="HOLD">Hold</option>
      				<option value="COMPLETE">Complete</option>
      				<option value="CANCLE">Cancled</option>
      			</select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" id="message-text" name="description">{!! old('description') !!}</textarea>
          </div>
         
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
      </form>
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
  $('#allProjects').DataTable( {
    responsive: true,
    dom: 'Bfrtip',
    buttons: [
        'csv', 'pdf', 'print'
    ]
} );
  $('.buttons-csv, .buttons-print, .buttons-pdf').addClass('btn btn-success mr-1');
</script>




@else


<br>
<div class="row">
  <div class="col-md-12">
    <div class="card comp-card">
          <div class="card-body">
            <h3 style="text-align: center;">Your Projects</h3>
              <div class="table-responsive">
                <table class="table" id="allProjects">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Project Name</th>
                      <th scope="col">Location</th>
                      <th scope="col">Client Name</th>
                      <th scope="col">Est Total</th>
                      <th scope="col">Status</th>
                      <th scope="col">Starting Date</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>
                      <th scope="row">{{1}}</th>
                      <td>{{$projects->name}}</td>
                      <td>{{$projects->location}}</td>
                      <td>{{$projects->client_name}}</td>
                      <td>{{$projects->price}}</td>
                      <td>{{$projects->status}}</td>
                      <td>{{$projects->created_at->format('d M, Y')}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>



{{-- modal --}}



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
  $('#allProjects').DataTable( {
    responsive: true,
    dom: 'Bfrtip',
    buttons: [
        'csv', 'pdf', 'print'
    ]
} );
  $('.buttons-csv, .buttons-print, .buttons-pdf').addClass('btn btn-success mr-1');
</script>


@endif
@endsection