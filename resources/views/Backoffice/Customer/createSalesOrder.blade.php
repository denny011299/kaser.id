@extends('Backoffice.Layout')
@section('custom_css')

    <link rel="stylesheet" href="{{asset('custom_css/vc-toggle-switch.css')}}">
    <link rel="stylesheet" href="{{asset('custom_css/createPurchaseOrder.css')}}">
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
          <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Create Sales Order</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
                    <li class="breadcrumb-item">Sales Order</li>
                    <li class="breadcrumb-item active">Create Sales Order</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body pe-0 ps-2 pe-2" >
                        <div class="row">
                            <div class="col-12">
                                <div class="pe-2">
                                    <input type="text" name="" class="form-control " id="search" placeholder="SKU / Product Name / Barcode" style="border-radius: 100px;height:35px ">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 row-product pe-2 ps-3 pt-3" style="" >
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Customer</label>
                            <select name="" id="cus_id" class="form-select fill"></select>
                        </div>
                        <div class="col-3">
                            <label for="">Order Date</label>
                            <input type="date" name="" id="order_date" class="form-control fill">
                        </div>
                        <div class="col-4">
                            <label for="">Sign By</label>
                            <input type="text" name="" id="sign_by" class="form-control fill">
                        </div>
                    </div>
                    <hr>
                    <div class="body-form p-3 pt-1">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="fw-bold">From</h6>
                                <label for="">{{$company_name}}</label><br>
                                <label for="">{{$company_address}}</label><br>
                                <label for="">{{$company_nomor}}</label>
                            </div>
                            <div class="col-6">
                                <h6 class="fw-bold">To</h6>
                                <label id="text_to_name">-</label><br>
                                <label id="text_to_address">-</label><br>
                                <label id="text_to_nomor">-</label>
                            </div>
                        </div>
                        <hr>
                        <h6  class="fw-bold">List Product</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td class="text-center">Qty</td>
                                    <td>Description</td>
                                    <td class="text-end">Unit Price</td>
                                    <td class="text-end">Subtotal</td>
                                </tr>
                            </thead>
                            <tbody id="tbDetail">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="3">Total</td>
                                    <td class="text-end" id="total_value">0</td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="3">PPN (11%)</td>
                                    <td class="text-end" id="ppn_value">0</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td class="text-end" colspan="3">Grand Total</td>
                                    <td class="text-end" id="grandTotal_value">0</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="col-9"></div>
                            <div class="col-3 text-end">
                                <div style="height: 50px;border-bottom:1.5px solid gray"></div>
                                <p class="mt-2" id="text_sign_by">-</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-success" id="btn-save" style="border-radius: 100px"><span class="mdi mdi-plus"></span> Insert Data</button>
                </div>
            </div>
        </div>
       
    </div>
    <div class="modal fade bs-example-modal-lg" id="modalVariant" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                   <div class="container-fluid">
                        <img src="{{asset('assets/images/gallery/3.jpg')}}" alt="" id="modal-img" class="w-100" style="border-radius: 20px">
                        <h5 class="mt-2 fw-bold" id="modal-item-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, et.</h5>
                        <p class="text-muted" id="modal-item-desc">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In assumenda minima dolorum ipsam nisi reiciendis illum vitae sit possimus quod.</p>
                   
                        <div class="row" id="container-variant">
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-item">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
   
@endsection

@section('Custom_js')
    <script>
        var public= "{{ asset('') }}";    
        var uploadImageUrl = "{{ asset('assets/image-cards.png') }}";
    </script>
    <script src="{{asset('custom_js/Customer/CreateSalesOrder.js')}}"></script>
@endsection