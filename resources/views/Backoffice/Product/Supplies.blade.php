@extends('Backoffice.Layout')
@section('custom_css')
    <style>
        .icon{
            width: 50px;
            height: 50px;
        }
        .icon:hover{
            color:#108dff;
            cursor: pointer;
        }
        .icons-active{
            color:#108dff;
        }
        .icons{
            cursor: pointer;
            width: 60px;
        }
    </style>
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Supplies</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Supplies</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" class="form-control" id="filter_sup_name" aria-describedby="emailHelp" placeholder="Filter  Supply Name ">
                    </div>
                    <div class="col-9 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Supplies</button>
                    </div>
                </div>
                <table class="table mt-3" id="tableSupplies">
                    <thead>
                        <tr>
                            <td>SKU</td>
                            <td>Supplies Name</td>
                            <td>Stock</td>
                            <td>Alert Stock</td>
                            <td class="text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

       
    </div>

     {{-- Modal Insert--}}
    <div class="modal fade bs-example-modal-center show" id="modalInsert"    tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" id="modalInsert">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supplies</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <label for="">Supplies SKU*</label>
                                <input type="text" class="form-control fill" id="sup_sku" placeholder="Enter Supplies SKU">
                            </div>
                            <div class="col-6">
                                <label for="">Supplies Name*</label>
                                <input type="text" class="form-control fill" id="sup_name" placeholder="Enter Supplies Name">
                            </div>
                           
                        </div>
                      
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="">Supplies Unit*</label>
                                <input type="text" class="form-control fill" id="sup_unit" placeholder="Enter Supplies Unit">
                            </div>
                            <div class="col-6">
                                <label for="">Supplies Stock*</label>
                                <input type="text" class="form-control fill number-only" id="sup_stock" value="0">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Supplies Buy Price*</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control fill nominal_only" name="sup_buy_price" id="sup_buy_price" value="0" placeholder="10.000">
                                </div>
                            </div>
                             <div class="col-6 mt-2">
                                <label for="">Alert Min Stock*</label>
                                <input type="text" class="form-control fill number-only" id="sup_min_stock" value="1">
                            </div>
                        </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
        
@endsection

@section('Custom_js')
    <script src="{{asset('custom_js/Product/Supplies.js')}}"></script>
@endsection