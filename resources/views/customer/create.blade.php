@extends('master')

@section('title')
    Create Customer
@endsection
@section('content')


    <div class="card">
        <div class="view overlay">
            <div class="card-body">

                <form role="form" enctype="multipart/form-data" method="post" action="{{ route('customers.index')}}">
                    {{ csrf_field() }}
                    <div class="row" style="padding:10px; font-size: 12px;">

                        <div class="col-md-6 col-md-offset-1">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Customer Name</label>
                                <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" placeholder="Full Name" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Position</label>
                                <select name="position" class="form-control" style="margin-bottom: 5px;">
                                    <option value="">Position</option>
                                    <option value="admin">admin</option>
                                    <option value="cashier">cashier</option>
                                    <option value="Developer">Developer</option>
                                    </select>
                            </div>


                            <div class="box-body">
                                <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


@endsection