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
		<div class="card comp-card" style="    min-height: 310px;">
			<div class="card-body">
				@php
					$name=App\ItemName::where('id',$log->item->id)->value('name');
				@endphp
				<h5>Name : {{$name}}</h5>
				<h6>Quentity : {{$log->quentity}} {{$item->unit}}</h6>
				
				<h6>project : {{$log->project->name}}</h6>
				<p>Vendor Name: <a href="{{route('vendor.show',$item->vendor->id)}}">{{$item->vendor->name}}</a></p>
				
				@if($log->transfer_from > 0)
				<span class="label label-info">Transfered from {{$log->transferFrom->name}}</span>
				@else
					<h6>Price : {{$item->cost}}</h6>
					<p>Reusable : {!!$item->reusable ? "<span class='badge badge-success'>Yes</span>" :"<span class='badge badge-danger'>No</span>" !!}</p>
				@endif
			</div>
		</div>
	</div>
	@php

	@endphp
	<div class="col-md-4">
		<div class="card comp-card" style="pointer-events: {{$item->reusable ? '' : 'none'}};">
			<div class="card-body">
				<h3 style="text-align: center;">Transfer This Item</h3><br>
				<form action="{{route('inventory.transfer')}}" method="post">
					@csrf
					<input type="hidden" name="avilable_quentity" value="{{$log->quentity}}">
					<input type="hidden" name="item_id" value="{{$log->item_id}}">
					<input type="hidden" name="old_project_id" value="{{$log->project->id}}">
					<div class="form-group">
						<div class="form-group">
			            	<label for="recipient-name" class="col-form-label">Quentity : </label>
			            	<input type="text" class="form-control" id="recipient-name" name="quentity" value="{{ old('quentity') }}" required="">
			            </div>
			            <br>
						<select name="project_id" id="pid" class="form-control" required="">
							<option disabled selected>Select Project To See Item List</option>
							@foreach($projects as $project)
							<option value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div><br>
					<br>
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-block btn-primary {{$item->reusable ? '' : 'btn-disabled disabled'}}"><span style="font-size: 15px;">Transfer</span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	{{-- <div class="col-md-4">
		<div class="card comp-card" style="pointer-events: {{$item->reusable ? '' : 'none'}};">
			<div class="card-body">
				<h3 style="text-align: center;">Refound Item</h3><br>
				<form action="{{route('inventory.transfer')}}" method="post">
					@csrf
					<input type="hidden" name="avilable_quentity" value="{{$log->quentity}}">
					<input type="hidden" name="item_id" value="{{$log->item_id}}">
					<input type="hidden" name="old_project_id" value="{{$log->project->id}}">
					<div class="form-group">
						<div class="form-group">
			            	<label for="recipient-name" class="col-form-label">Quentity : </label>
			            	<input type="text" class="form-control" id="recipient-name" name="quentity" value="{{ old('quentity') }}" required="">
			            </div>
			            <br>
						<select name="project_id" id="pid" class="form-control" required="">
							<option disabled selected>Select Project To See Item List</option>
							@foreach($projects as $project)
							<option value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div><br>
					<br>
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-block btn-primary {{$item->reusable ? '' : 'btn-disabled disabled'}}"><span style="font-size: 15px;">Refound</span></button>
					</div>
				</form>
			</div>
		</div>
	</div> --}}
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card comp-card">
			<div class="card-body">

			</div>
		</div>
	</div>
</div>


<br>
<div id="ajaxResult">
	
</div>

@endsection






@section('script')

@endsection