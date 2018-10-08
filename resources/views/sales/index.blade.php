@extends('master')

@section('title')
    Show Sale
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ url('/product') }}"> Back</a>
            </div>
        </div>
    </div>
    <br/>
    <br/>

    <form role="form" enctype="multipart/form-data" method="post" action="{{url('/sale/add/')}}">
        {{ csrf_field() }}

        <div class="col-lg-12">
        <label for="exampleInputEmail1">Select a product</label>
        <select id="product_id" type="product_id"
                name="product_id">
            @foreach ($products as $value)
                <option value="{{$value->id}}" > {{$value->brand_name}} {{$value->generic_name}} {{$value->expiry_date}}</option>
            @endforeach
        </select>

         <div class="col-sm-4">
                <input type="number" class="form-control has-error" id="number" name="number" value="">
            </div>

        <div class="col-sm-8">
            <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

    </div>
    </form>

    <div class="card-body">
        <div class="row">

        </div>

        <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Generic Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Profit</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($sales as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->brand_name }}</td>
                    <td>{{ $value->generic_name }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->number }}</td>
                    <td>{{$value->selling_price}}</td>
                    <td>{{$value->profit}}</td>


                        </tr>

            @endforeach
            </tbody>
        </table>

        <section class="card">
            <div class="container">
                <!-- Important to work AJAX CSRF -->
                <meta name="_token" content="{!! csrf_token() !!}" />
                <body>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 margin-tb">
                            <div class="pull-right">

                                    <a class="btn btn-primary" href="{{ url('/cash') }}"> Cash</a>

                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>

                </div>
                </body>
            </div>
        </section>
    </div>
@endsection
