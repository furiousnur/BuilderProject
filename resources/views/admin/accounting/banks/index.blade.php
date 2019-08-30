@extends('admin.layouts.master')
{{-- testing line.. deleteabla --}}
@section('content')

@php
$b=$banks;


@endphp

<!-- Button trigger modal -->
<style>
	.required{
		color:red;
	}
</style>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Create Account
</button>
<button style="background: rgba(46,143,255,1);" type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal1">
  Invest
</button>
{{-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2">
  Transfer To Another Account
</button> --}}
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal3">
  Transfer To Manager
</button>

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal4">
  From Coustomer
</button>
<br><br>

<!-- Modal -->

<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Income From Coustomer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('coustomer.recharge.store')}}" method="post">
        @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Select Coustomer <span class="required">*</span></label>
            <select name="coustomer_id" id="" class="form-control" required="">
              @foreach($coustomers as $coustomer)
              <option value="{{$coustomer->id}}">{{$coustomer->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Account <span class="required">*</span></label>
            <select name="bank_id" id="" class="form-control" required="">
              @foreach($banks as $bank)
              <option value="{{$bank->id}}">{{$bank->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount: <span class="required">*</span></label>
            <input type="text" class="form-control" id="recipient-name" name="amount" required="">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date: <span class="required">*</span></label>
            <input type="date" class="form-control" id="recipient-name" name="date" required="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">note:</label>
            <textarea class="form-control" id="message-text" name="note"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Recharge</button>
      </form>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Transfer money to manager</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('manager.recharge.store')}}" method="post">
        @csrf
          <input type="hidden" name="type" value="CREDIT">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Select Manager <span class="required">*</span></label>
            <select name="manager_id" id="" class="form-control" required="">
              @foreach($managers as $manager)
              <option value="{{$manager->id}}">{{$manager->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Account From :<span class="required">*</span></label>
            <select name="bank_id" id="" class="form-control" required="">
              @foreach($banks as $bank)
              <option value="{{$bank->id}}">{{$bank->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount: <span class="required">*</span></label>
            <input type="text" class="form-control" id="recipient-name" name="amount" required="">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date: <span class="required">*</span></label>
            <input type="date" class="form-control" id="recipient-name" name="date" required="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">note:</label>
            <textarea class="form-control" id="message-text" name="note"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Recharge</button>
      </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Transfer money to another account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="{{route('bank.recharge.store')}}" method="post">
        @csrf
          <input type="hidden" name="type" value="CREDIT">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Account From : <span class="required">*</span></label>
      			<select name="bank_id" id="" class="form-control" required="">
      				@foreach($banks as $bank)
      				<option value="{{$bank->id}}">{{$bank->name}}</option>
      				@endforeach
      			</select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Account To<span class="required">*</span></label>
            <select name="bank_id" id="" class="form-control" required="">
              <option selected disabled>Select a bank account</option>
              @foreach($banks as $bank)
              <option value="{{$bank->id}}">{{$bank->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount: <span class="required">*</span></label>
            <input type="text" class="form-control" id="recipient-name" name="amount" required="">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date: <span class="required">*</span></label>
            <input type="date" class="form-control" id="recipient-name" name="date" required="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">note:</label>
            <textarea class="form-control" id="message-text" name="note"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Recharge</button>
    	</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recharge</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('bank.recharge.store')}}" method="post">
        @csrf
          <input type="hidden" name="type" value="CREDIT">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Account <span class="required">*</span></label>
            <select name="bank_id" id="" class="form-control" required="">
              @foreach($banks as $bank)
              <option value="{{$bank->id}}">{{$bank->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount: <span class="required">*</span></label>
            <input type="text" class="form-control" id="recipient-name" name="amount" required="">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date: <span class="required">*</span></label>
            <input type="date" class="form-control" id="recipient-name" name="date" required="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">note:</label>
            <textarea class="form-control" id="message-text" name="note"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Recharge</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="{{route('bank.store')}}" method="post">
        @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="recipient-name" name="name" required="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">note:</label>
            <textarea class="form-control" id="message-text" name="note"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
    	</form>
      </div>
    </div>
  </div>
</div>

<div class="row">

	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">
				<h4 class="text-center">All Banks List</h4>
			    <div class="table-responsive">
				  <table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">Available Amount</th>
					      <th scope="col">Note</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($b as $index => $bank)
					    <tr>
					    	<td>{{$index+1}}</td>
					    	<td><a href="{{route('bank.show',$bank->id)}}">{{$bank->name}}</a></td>
					    	<td>{{$bank->recharges->where('type','CREDIT')->sum('amount')-$bank->recharges->where('type','DEBIT')->sum('amount')}}</td>
					    	<td>{{$bank->note}}</td>
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