@php
$total=0;
$paid=0;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .col-md-1 {width:8%;  float:left;}
    .col-md-2 {width:16%; float:left;}
    .col-md-3 {width:25%; float:left;}
    .col-md-4 {width:33%; float:left;}
    .col-md-5 {width:42%; float:left;}
    .col-md-6 {width:50%; float:left;}
    .col-md-7 {width:58%; float:left;}
    .col-md-8 {width:66%; float:left;}
    .col-md-9 {width:75%; float:left;}
    .col-md-10{width:83%; float:left;}
    .col-md-11{width:92%; float:left;}
    .col-md-12{width:100%; float:left;}
    .clearfix {
      overflow: auto;
    }
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }
  </style>
</head>
<body>
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center">The World Constraction</h3>
      <h5 class="text-center">Name: {{$data->name}}</h5>
      <h6 class="text-center">Project: {{$data->project->name}}</h6>
      <h6 class="text-center">Phone: {{$data->phone}}</h6>
      <h6 class="text-center">Address: {{$data->address}}</h6>
      <h6 class="text-center">Report Duration: <span style="color: red;">{{$data->start}}</span>- <span style="color: red;">{{$data->end}}</span></h6>
    </div>
    <div class="col-md-6">
      
    </div>
  </div>

  <div class="clearfix"></div>

  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Shift</th>
      <th scope="col">PaybleAmount</th>
      <th scope="col">Food</th>
    </tr>
  </thead>
  <tbody>
    @foreach($att as $index => $att)
    <tr>
      <th scope="row">{{$index+1}}</th>
      <th scope="row">{{$att->date}}</th>
      <td>{{$shift=$att->first+$att->secound+$att->third+ $att->fourth}}</td>
      <td>{{($total+=$shift*$data->wages)/2}}</td>
      <td>
        @php
        $transection=App\LabourTransection::where('labour_id',$data->id)->where('date',$att->date)->get();
        if ($transection) {
          foreach ($transection as $key => $transection) {
            echo " ".$transection->amount.'/-,';
            $paid+=$transection->amount;
          }
        }
        @endphp
      </td>
    </tr>
    
    @endforeach
    <tr>
      <th></th>
      <th></th>
      <th>Total</th>
      <th>{{$total}}</th>
      <th><b style="color: green;">Paid : {{$paid}}</b> </th>
    </tr>
  </tbody>
</table>
</body>
</html>