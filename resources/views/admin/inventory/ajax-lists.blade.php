<br>
<div class="row">
<div class="col-md-12">
	<div class="card comp-card">
		<div class="card-body">
			<h3 style="text-align: center;">All Items of <span style="color: #f91484;">{{$project->name}}</span> Project</h3>
			<div class="table-responsive">
				<table class="table" id="allProjects">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Item Name</th>
							<th scope="col">Quentity</th>
							<th scope="col">Unit Name</th>
							<th scope="col">Vandor</th>
							<th scope="col">Reusable</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $index => $inv)
						<tr>
							<th scope="row">{{$index+1}}</th>
							<td><a href="{{url('admin/inventory/'.$inv->item->id.'/'.$inv->id)}}">{!!$inv->transfer_from > 0 ? '<span class="label label-info">< ></span>':""!!}
							@php
								$name=App\ItemName::where('id',$inv->item->item_name_id)->value('name');
							@endphp

								{{$name}}</a></td>
						
							<td>{{$inv->quentity}}</td>
							<td>
								{{$inv->item->unit}}
							</td>
							<td>
								{{$inv->item->vendor->name}}
							</td>
							<td>
								@if($inv->item->reusable)
									<span class="label label-success">Yes</span>
								@else
									<span class="label label-danger">No</span>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
{{-- <script>
	$('#allProjects').DataTable( {
		responsive: true,
		} );
</script> --}}
</div>
