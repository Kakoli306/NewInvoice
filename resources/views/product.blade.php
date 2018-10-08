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

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr class="info">
                                <th>ID </th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Category/Description</th>
                                <th>Date Arrival</th>
                                <th>Expiry Date</th>
                                <th>Original Price</th>
                                <th>Selling Price</th>
                                <th>Quantity</th>
                                <th>Quantity Left</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="products-list" name="products-list">
                            @foreach ($products as $product)
                                <tr id="product{{$product->id}}" class="active">
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->brand_name}}</td>
                                    <td>{{$product->generic_name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->date_arrival}}</td>
                                    <td>{{$product->expiry_date}}</td>
                                    <td>{{$product->original_price}}</td>
                                    <td>{{$product->selling_price}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>
                                        <?php
                                            $sub = $product->quantity_left - $product->number
                                        ?>{{$sub}}</td>
                                    <?php
                                    $result = $product->selling_price * $sub
                                    ?>
                                    <td>{{$result}}</td>
                                    <td width="35%">
                                        <button class="btn btn-warning btn-detail open_modal" value="{{$product->id}}">Edit</button>
                                        <button class="btn btn-danger btn-delete delete-product" value="{{$product->id}}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

            <!-- Passing BASE URL to AJAX -->
            <input id="url" type="hidden" value="{{ \Request::url() }}">

            <!-- MODAL SECTION -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Product Form</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                <div class="form-group error">
                                    <label for="inputBrandName" class="col-sm-3 control-label">Brand Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="brand_name" name="brand_name" value="">
                                    </div>
                                </div>

                                <div class="form-group error">
                                    <label for="inputGenericName" class="col-sm-3 control-label">Generic Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="generic_name" name="generic_name" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputDetail" class="col-sm-3 control-label">Details</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="description" name="description" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputarrival" class="col-sm-3 control-label">Date Arrival</label>
                                    <div class="col-sm-9">
                                    <input type="date" name="date_arrival" class="form-control" id="date_arrival" value="">
                                    </div>
                                </div>

                                    <div class="form-group">
                                        <label for="inputexpiry" class="col-sm-3 control-label">Expiry Date</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="expiry_date" class="form-control" id="expiry_date" value="">
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <label for="inputselling" class="col-sm-3 control-label">Selling Price</label>
                                    <div class="col-sm-9">
                                        <input type="float" name="selling_price" class="form-control" id="selling_price" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputoriginal" class="col-sm-3 control-label">Original Price</label>
                                    <div class="col-sm-9">
                                        <input type="float" name="original_price" class="form-control" id="original_price" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputquantity" class="col-sm-3 control-label">Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="quantity" class="form-control" id="quantity" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputquantityleft" class="col-sm-3 control-label">Quantity Left</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="quantity_left" class="form-control" id="quantity_left" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputprofit" class="col-sm-3 control-label">Profit</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="profit" class="form-control" id="profit" value="">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>
                            <input type="hidden" id="product_id" name="product_id" value="0">
                        </div>

                    </div>
                </div>
            </div>


            <!-- Scripts -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="{{asset('js/ajaxscript.js')}}"></script>
            </body>
        </div>
    </section>
@endsection