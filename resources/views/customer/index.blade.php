@extends('master')

@section('title')
    Customer Info
@endsection

@section('content')

    <section class="card">
        <div class="container">

            <header class="card-header">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <h2 class="card-title">View Customer Information</h2>
            </header>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                        </div>
                    </div>
                     </div>

                <div class="row no-print">
                    <div class="col-xs-12">
                        <button type="button"> <a href="{{route('customers.create')}}">
                                <i class="fa fa-dashboard"></i> <span>Add User</span>
                            </a>
                        </button>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Position</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($customers as $customer)
                        <tr>
                            <td></td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->position }}</td>
                    </tbody>
                        @endforeach


                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->
@endsection
