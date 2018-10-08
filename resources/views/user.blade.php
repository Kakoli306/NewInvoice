@extends('master')

@section('title')
    Customer Info
@endsection

@section('content')

    <section class="card">
        <div class="container">

            <header class="card-header">


                <h2 class="card-title">View User Information</h2>
            </header>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary"><a href=""></a>Back <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

                    <thead>
                    <tr>
                        <th>No</th>
                        <th>User Name</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $customer)
                        <tr>
                            <td></td>
                            <td>{{ $customer->username }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                    </tbody>
                    @endforeach


                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->
@endsection
