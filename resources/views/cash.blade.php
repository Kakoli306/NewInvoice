@extends('master')

@section('title')
    View Product
@endsection

@section('content')
    <section class="card">
        <div class="container">
            <!-- Important to work AJAX CSRF -->
            <meta name="_token" content="{!! csrf_token() !!}" />
            <body>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 margin-tb">
                        <div class="pull-right">
                            <button id="btn_add" name="btn_add" class="btn btn-primary">Add New </button>
                        </div>
                    </div>
                </div>
                <br/>
                <br/>

            </div>


            <div class="container">

                <section role="main" class="content-body">

                    <!-- start: page -->

                    <section class="card">
                        <div class="card-body">
                            <div class="invoice">
                                <header class="clearfix">
                                    <div class="row">
                                        <div class="col-sm-6 mt-3">
                                            @foreach ($cash as $new )
                                                <tr>
                                                    <td></td>
                                                    <?php
                                                    $new = DB::table('cashes')->latest('id')->first()?>
                                                </tr>
                                            @endforeach

                                            <h2 class="h2 mt-0 mb-1 text-dark font-weight-bold">{{ $new->name }}</h2>
                                            <h4 class="h4 m-0 text-dark font-weight-bold">{{ $new->id }}</h4>
                                                <h4 class="h4 m-0 text-dark font-weight-bold">{{ $new->created_at }}</h4>
                                        </div>
                                          </div>
                                </header>

                                <table class="table table-responsive-md invoice-items">
                                    <thead>
                                    <tr class="text-dark">
                                        <th id="cell-id"     class="font-weight-semibold">Product Code</th>
                                        <th id="cell-item"   class="font-weight-semibold">Product Name</th>
                                        <th id="cell-desc"   class="font-weight-semibold">Quantity</th>
                                        <th id="cell-price"  class="text-center font-weight-semibold">Price</th>
                                        <th id="cell-qty"    class="text-center font-weight-semibold">Discount</th>
                                        <th id="cell-total"  class="text-center font-weight-semibold">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    @foreach ($cash as $route )

                                            <?php
                                            $route = DB::table('cashes')
                                                ->join('products', 'cashes.product_id', '=', 'products.id')
                                                ->join('sales', 'sales.product_id', '=', 'products.id')
                                                ->select('products.brand_name','products.generic_name','products.selling_price', 'cashes.*','sales.number')
                                                ->orderBy('id', 'DESC')->first();
                                            ?>
                                        @endforeach                                            <td>{{ $route->brand_name }}</td>
                                        <td class="font-weight-semibold text-dark">{{ $route->generic_name }}</td>
                                        <td>{{ $route->number }}</td>
                                        <td class="text-center">{{ $route->selling_price }}</td>
                                        <td class="text-center">0.00</td>
                                        <td class="text-center">{{ $route->selling_price }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="invoice-summary">
                                    <div class="row justify-content-end">
                                        <div class="col-sm-4">
                                            <table class="table h6 text-dark">
                                                <tbody>
                                                <tr class="b-top-0">
                                                    <td colspan="2">Total</td>
                                                    <td class="text-left">{{ $route->selling_price }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Cash tendered</td>
                                                    <td class="text-left">{{ $route->amount }}</td>
                                                </tr>
                                                <tr class="h4">
                                                    <td colspan="2">Grand Total</td>
                                                    <?php $sub = $route->amount - $route->selling_price ?>
                                                    <td class="text-left">{{$sub}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mr-4">
                                        </div>
                        </div>
                    </section>


                    <br/>
                <a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a>
                </section>
            </div>



            <!-- Passing BASE URL to AJAX -->
            <input id="url" type="hidden" value="{{ \Request::url() }}">

            <!-- MODAL SECTION -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cash</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmCash" name="frmCash" class="form-horizontal" novalidate="">
                                <div class="form-group error">
                                    <label for="inputName" class="col-sm-3 control-label"> Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" value="">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="inputamount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="amount" class="form-control" id="amount" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Select a product</label>
                                <select id="product_id" type="product_id"
                                        name="product_id">
                                    @foreach ($products as $value)
                                        <option value="{{$value->id}}" > {{$value->brand_name}} {{$value->generic_name}} {{$value->expiry_date}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>
                            <input type="hidden" id="cash_id" name="cash_id" value="0">
                        </div>

                    </div>
                </div>
            </div>


            <!-- Scripts -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

            <script src="{{asset('js/cashscript.js')}}"></script>
            </body>
        </div>
    </section>
@endsection