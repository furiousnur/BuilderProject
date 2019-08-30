@extends('admin.layouts.master')

@section('style')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card comp-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-25">Total Expence To Manager</h6>
                            <h3 class="f-w-700 text-c-blue">{{$projectExpManpower->sum ('amount')}}</h3>
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
                            <h6 class="m-b-25">Total Expence on purchase</h6>
                            <h3 class="f-w-700 text-c-green">{{$projectExpItem->sum ('paid')}}</h3>
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
                            <h6 class="m-b-25">Income from coustomer</h6>
                            <h3 class="f-w-700 text-c-yellow">{{$income->sum ('amount')}}</h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-paper bg-c-yellow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card comp-card">
                <div class="card-body">
                    <h5 style="text-align: center;">Item purchase Transection List</h5>
                    <div class="table-responsive">
                        <table class="table table-hover" id="table1">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projectExpItem as $index => $transection)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$transection->created_at->format ('d M, Y')}}</td>
                                    <td>{{$transection->paid}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card comp-card">
                    <div class="card-body">
                        <h5 style="text-align: center;">Manager Transection List</h5>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table2">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projectExpManpower as $index => $transection)
                                    <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>{{$transection->created_at->format ('d M, Y')}}</td>
                                        <td>{{$transection->amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card comp-card">
                <div class="card-body">
                    <h5 style="text-align: center;">Income from Coustomer</h5>
                    <div class="table-responsive">
                        <table class="table table-hover" id="table2">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($income as $index => $transection)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$transection->created_at->format ('d M, Y')}}</td>
                                    <td>{{$transection->amount}}</td>
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
    <script>
        $('#table1').DataTable( {
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'pdf', 'print'
            ]
        });
        $('#table2').DataTable( {
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'pdf', 'print'
            ]
        });
    </script>
@endsection
