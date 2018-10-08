@extends('master')

@section('content')

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$customers}}</h3>

                <p>Number of Customerss</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('customers') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$products}}<sup style="font-size: 20px"></sup></h3>

                <p>Number of Products</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ url('/product') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

        <thead>
        <tr>
<th></th>
                     <th>Number of Product</th>
            <th>Total Sale</th>
        </tr>
        </thead>
        <tbody>


            <tr>
              <td></td>
                <td>{{ $products }}</td>
                <td>{{ $incomes }}</td>
        </tbody>


    </table>

@endsection
