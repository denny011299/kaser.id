@extends('Backoffice.Layout')
@section('custom_css')
    <style>
        .row-type li .active{
            border-radius: 200px;
            background-color: rgba(16, 141, 255, 0.1)!important;
            color:var(--bs-sidebar-item-active)!important;
        }
        .row-type li {
           width: 100px;
           text-align: center;
        }
    </style>
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Manage Product</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                    <li class="breadcrumb-item active">Manage Product</li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h6>Insert Data</h6>
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-3">
                        <label for="input_barcode">Barcode Number</label>
                        <input type="text" id="input_barcode" class="form-control" aria-describedby="emailHelp" placeholder="Barcode Number">
                    </div>
                    <div class="col-2">
                        <label for="input_sku">Qty</label>
                        <input type="text" id="input_qty" class="form-control number-only" id="input_qty" aria-describedby="emailHelp" placeholder="Qty" value="1">
                    </div>
                    <div class="col-2">
                        <label for="input_sku">Type</label>
                        <select name="" id="input-type" class="form-select">
                            <option value="1">Product In</option>
                            <option value="2">Product Out</option>
                        </select>
                    </div>
                    <div class="col-5 text-end pt-3">
                         <div class="btn-group" role="group" aria-label="Basic radio toggle button group" >
                            <input type="radio" class="btn-check btn_scan" name="btnradio" id="btn_scan" value="1" autocomplete="off" checked="" style="border-radius: 100px;">
                            <label class="btn btn-outline-primary" for="btn_scan">Auto Scan</label>

                            <input type="radio" class="btn-check btn_scan " name="btnradio" id="btn_manual" value="2" autocomplete="off" style="border-radius: 100px;">
                            <label class="btn btn-outline-primary" for="btn_manual">Manual Entry</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="date" class="form-control" id="filter_start_date" aria-describedby="emailHelp">
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" id="filter_end_date" aria-describedby="emailHelp">
                    </div>
                    <div class="col-6 text-end">
                        <ul class="nav nav-pills  justify-content-end d-flex row-type" role="tablist">
                            <li class="nav-item nav-jenis" tipe="1" role="presentation">
                                <a class="nav-link nav-jenis active"  tipe="1" data-bs-toggle="tab" href="#navpills-home" role="tab" aria-selected="false" tabindex="-1">
                                    <span class="d-none d-sm-block"><span class="mdi mdi-archive-check-outline me-1"></span> All</span> 
                                </a>
                            </li>
                            <li class="nav-item nav-jenis" tipe="2" role="presentation">
                                <a class="nav-link nav-jenis" tipe="2" data-bs-toggle="tab" href="#navpills-profile" role="tab" aria-selected="false" tabindex="-1">
                                    <span class="d-none d-sm-block"><span class="mdi mdi-archive-plus-outline me-1"></span> In</span> 
                                </a>
                            </li>
                            <li class="nav-item nav-jenis" tipe="3" role="presentation">
                                <a class="nav-link nav-jenis " tipe="3" data-bs-toggle="tab" href="#navpills-messages" role="tab" aria-selected="true">
                                   
                                    <span class="d-none d-sm-block"><span class="mdi mdi-archive-minus-outline me-1"></span> Out</span>   
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active show" id="navpills-home" role="tabpanel">
                       <table class="table mt-3" id="tableProductAll">
                            <thead>
                                <tr>
                                    <td>SKU</td>
                                    <td>Product Name</td>
                                    <td>Qty In</td>
                                    <td>Qty Out</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div><!-- end tab pane -->
                    <div class="tab-pane  " id="navpills-profile" role="tabpanel">
                       <table class="table mt-3" id="tableProductIn">
                            <thead>
                                <tr>
                                    <td>SKU</td>
                                    <td>Product Name</td>
                                    <td>Qty</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div><!-- end tab pane -->
                    <div class="tab-pane" id="navpills-messages" role="tabpanel">
                       <table class="table mt-3" id="tableProductOut">
                            <thead>
                                <tr>
                                    <td>SKU</td>
                                    <td>Product Name</td>
                                    <td>Qty</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div><!-- end tab pane -->
                </div>
               
            </div>
        </div>

       
    </div>

    
        
@endsection

@section('Custom_js')
    <script src="{{asset('custom_js/Inventory/Manage_Product.js')}}"></script>
@endsection