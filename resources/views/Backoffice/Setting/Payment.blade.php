@extends('Backoffice.Layout')
@section('custom_css')
    <style>
        .logo{
            height: 10vh;
            width: 10vh;
        }
        hr{
            margin: 1vh 0;
        }
        h4, h6, p{
            margin: 0;
        }
        .body>table{
            border-collapse: separate;
        }
        .menu>td {
            padding-bottom: 1vh;
        }
        .mdi{
            cursor: pointer;
        }
        #text-delete{
            margin: auto;
            font-size: 16px !important;
        }
    </style>
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Payment</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>
                    <li class="breadcrumb-item active">Payment</li>
                </ol>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-2">
                            <h5 class="fs-15 fw-semibold m-0 p-2 col-5">Tax Variant</h5>
                            <div class="col-2"></div>
                            <div class="col-5 d-flex justify-content-end">
                                <button class="btn bg-success-subtle btn-add-variant rounded-pill">+ Add</button>
                            </div>
                        </div>
                        <div class="container p-2">
                            <div class="row pt-3" id="tax-container">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="fs-15 fw-semibold m-0 p-2">Payment Method</h5>
                        <div class="row px-2 pt-2">
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="col-8 text">QRIS</div>
                                            <div class="form-check form-switch text-end col-4 offset-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="pm_qris">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="col-8 text">Credit Card</div>
                                            <div class="form-check form-switch text-end col-4 offset-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="pm_card">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="col-8 text">Transfer</div>
                                            <div class="form-check form-switch text-end col-4 offset-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="pm_transfer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="col-8 text">Cash</div>
                                            <div class="form-check form-switch text-end col-4 offset-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="pm_cash" checked>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="fs-15 fw-semibold m-0 p-2">Order Method</h5>
                        <div class="row px-2 pt-2">
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="col-8 text">Online</div>
                                            <div class="form-check form-switch text-end col-4 offset-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="om_online">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="col-8 text">Dine-In</div>
                                            <div class="form-check form-switch text-end col-4 offset-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="om_dine_in">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="col-8 text">Unpaid Bill</div>
                                            <div class="form-check form-switch text-end col-4 offset-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="om_unpaid_bill">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="col-8 text">Take-Away</div>
                                            <div class="form-check form-switch text-end col-4 offset-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="om_take_away">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-lg-6 col-12 offset-1" style="width: fit-content; height: fit-content">
                <div class="card-body">
                    <label for="">Preview</label>
                    <div class="container px-4 py-2">
                        <div class="text-center nota">
                            <div class="header">
                                <img id="rp_logo" class="logo mb-2" src="{{ asset('upload/setting/logo-dummy.jpg') }}" alt="">
                                <h4 id="rp_name"></h4>
                                <h6 id="rp_address"></h6>
                                <h6 id="rp_phone_number" class="mb-2"></h6>
                            </div>
                            <hr>
                            <div class="detail row" style="text-align: left">
                                <div class="col-6">
                                    <table>
                                        <tr>
                                            <td>Inv No</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>INV0001</td>
                                        </tr>
                                        <tr>
                                            <td>Customer</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td><p><span id="rp_customer_name"></span></p></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6 text-left">
                                    <table>
                                        <tr id="rp_table_number">
                                            <td>Table</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td><p>01</p></td>
                                        </tr>
                                        <tr id="rp_cashier_name">
                                            <td>Cashier</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>Indah</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="body">
                                <table class="w-100">
                                    <tr>
                                        <th style="text-align: left">ITEM</th>
                                        <th>QTY</th>
                                        <th style="text-align: right">PRICE</th>
                                        <th style="text-align: right">AMOUNT</th>
                                    </tr>
                                    <tr class="menu">
                                        <td style="text-align: left">Nasi Goreng</td>
                                        <td>1</td>
                                        <td style="text-align: right">Rp 20.000</td>
                                        <td style="text-align: right">Rp 20.000</td>
                                    </tr>
                                    <tr class="menu">
                                        <td style="text-align: left">Mie Goreng</td>
                                        <td>2</td>
                                        <td style="text-align: right">Rp 22.000</td>
                                        <td style="text-align: right">Rp 44.000</td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <div class="total">
                                <div class="d-flex justify-content-between">
                                    <p>TOTAL AMOUNT</p>
                                    <p id="total">Rp 64.000</p>
                                </div>
                                <div class="" id="preview_tax">
                                    
                                    
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw-bold">GRAND TOTAL</p>
                                    <p class="fw-bold" id="grand">Rp 70.400</p>
                                </div>
                            </div>
                            <hr>
                            <div class="payment">
                                <div class="d-flex justify-content-between">
                                    <p>CASH</p>
                                    <p>Rp 100.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>CHANGE</p>
                                    <p id="change">Rp 29.600</p>
                                </div>
                            </div>
                            <hr>
                            <div class="foot">
                                <p id="rp_footer"></p>
                            </div>
                            <div class="barcode text-center">
                                <svg id="barcode">
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     {{-- Modal Insert--}}
    <div class="modal fade bs-example-modal-center show" id="modalInsert"    tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md" id="modalInsert">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tax Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label for="">Tax Name*</label>
                        <input type="text" class="form-control fill " name="" id="tx_name" placeholder="Ex PPN">
                        <label for="">Tax Percent</label>
                        <div class="input-group fix-nominal">
                            <input type="text" class="form-control number-only" name="" id="tx_percent" placeholder="Ex 10">
                            <span class="input-group-text">%</span>
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
    <script>
        var public = "{{ asset('') }}";
        var data=@json($data);
        var tax=@json($tax);
        var dummyLogo = "{{ asset('upload/setting/logo-dummy.jpg') }}";
    </script>
    <script src="{{asset('custom_js/Setting/Payment.js')}}"></script>
@endsection