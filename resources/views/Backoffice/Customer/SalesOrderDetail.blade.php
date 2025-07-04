@extends('Backoffice.Layout')
@section('custom_css')
    <style>
    </style>
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Sales OrderDetail</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
                    <li class="breadcrumb-item">Purchase Order</li>
                    <li class="breadcrumb-item active">Sales OrderDetail</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-2 pt-2">
                                <img src="{{asset($data["cus_img"])}}" alt="" style="width: 100px">
                            </div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-6 pt-1">
                                        <h5>{{$data["cus_name"]}}</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                         <span id="label_spo_status"></span>
                                         <label for="" class="bg-primary-subtle text-primary px-3 py-1 mb-2" style="border-radius: 100px;font-size:8pt">{{$data["city_name"]}}</label>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        <p class="mb-0">Telphone : {{$data["cus_nomer"]}}</p>
                                        <p>Address : {{$data["cus_address"]}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#E7366B" fill-rule="evenodd" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10m.75-16a.75.75 0 0 0-1.5 0v.317c-1.63.292-3 1.517-3 3.183c0 1.917 1.813 3.25 3.75 3.25c1.377 0 2.25.906 2.25 1.75s-.873 1.75-2.25 1.75c-1.376 0-2.25-.906-2.25-1.75a.75.75 0 0 0-1.5 0c0 1.666 1.37 2.891 3 3.183V18a.75.75 0 0 0 1.5 0v-.317c1.63-.292 3-1.517 3-3.183c0-1.917-1.813-3.25-3.75-3.25c-1.376 0-2.25-.906-2.25-1.75s.874-1.75 2.25-1.75c1.377 0 2.25.906 2.25 1.75a.75.75 0 0 0 1.5 0c0-1.666-1.37-2.891-3-3.183z" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="fs-16 mb-1">Conversion Rate</div>
                        </div>
                        <div class="d-flex align-items-baseline mb-2">
                            <div class="fs-22 mb-0 me-2 fw-semibold text-dark">15%</div>
                            <div class="me-auto">
                                <span class="text-danger d-inline-flex align-items-center">
                                    10%
                                    <i data-feather="trending-down" class="ms-1" style="height: 20px; width: 20px;"></i>
                                </span>
                            </div>
                        </div>
                        <div id="conversion-visitors" class="apex-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                 <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#108dff" fill-rule="evenodd" d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991zM14 9a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8c4 0 4-.895 4-2s-1.79-2-4-2s-4 .895-4 2s0 2 4 2" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="fs-16 mb-1">Active Users</div>
                        </div>
                        <div class="d-flex align-items-baseline mb-2">
                            <div class="fs-22 mb-0 me-2 fw-semibold text-dark">2,986</div>
                            <div class="me-auto">
                                <span class="text-primary d-inline-flex align-items-center">
                                    4%
                                    <i data-feather="trending-up" class="ms-1" style="height: 20px; width: 20px;"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div id="active-users" class="apex-charts"></div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-underline border-bottom" role="tablist">
                    <li class="nav-item menu" role="presentation" menu="1">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none"><i class="mdi mdi-home-account"></i></span>
                            <span class="d-none d-sm-block">Summary</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation"  menu="2">
                        <a class="nav-link " data-bs-toggle="tab" href="#delivery_notes" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                            <span class="d-none d-sm-block">Delivery Notes</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation"  menu="2">
                        <a class="nav-link " data-bs-toggle="tab" href="#messages" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                            <span class="d-none d-sm-block">Invoice</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation"  menu="3">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab" aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline"></i></span>
                            <span class="d-none d-sm-block">Payment</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="row mt-4">
                            <div class="col-6">
                                <h6 class="fw-bold">From</h6>
                                <label for="">{{$dataPo["so_from_company"]}}</label><br>
                                <label for="">{{$dataPo["so_from_address"]}}</label><br>
                                <label for="">{{$dataPo["so_from_nomer"]}}</label>
                            </div>
                            <div class="col-6">
                                <h6 class="fw-bold">To</h6>
                                <label id="text_to_name">{{$dataPo["so_to_company"]}}</label><br>
                                <label id="text_to_address">{{$dataPo["so_to_address"]}}</label><br>
                                <label id="text_to_nomor">{{$dataPo["so_nomer"]}}</label>
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
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach ($dataPo["items"] as $item)
                                    <tr>
                                        <td class="text-center">{{$item->sod_qty}}</td>
                                        <td class="text-start">{!!$item->sod_nama!!}</td>
                                        <td class="text-end">Rp.{{number_format($item->sod_harga,0,",",".")}}</td>
                                        <td class="text-end">Rp.{{number_format($item->sod_subtotal,0,",",".")}}</td>
                                    </tr>
                                    @php
                                        $subtotal += $item->sod_subtotal;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="3">Total</td>
                                    <td class="text-end" id="total_value">Rp.{{number_format($subtotal,0,",",".")}}</td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="3">PPN (11%)</td>
                                    <td class="text-end" id="ppn_value">Rp.{{number_format($dataPo["so_total_ppn"],0,",",".")}}</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td class="text-end" colspan="3">Grand Total</td>
                                    <td class="text-end" id="grandTotal_value">Rp. {{number_format($dataPo["so_total"],0,",",".")}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="col-9"></div>
                            <div class="col-3 text-end">
                                <div style="height: 50px;border-bottom:1.5px solid gray"></div>
                                <p class="mt-2" id="text_sign_by">{{$dataPo["so_sign_by"]}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="delivery_notes" role="tabpanel">
                         <div class="row mb-2">
                            <div class="col-6"></div>
                            <div class="col-6 text-end">
                                @if($dataPo["spo_status"]!="Done")
                                    <button class="btn btn-success  btn-add-delivery" style="border-radius:100px">+ Add Delivery Note</button>
                                @endif
                            </div>
                        </div>
                         <table class="table" id="tableDO">
                            <thead>
                                <tr>
                                    <td class="text-center">Date</td>
                                    <td>DO No.</td>
                                    <td class="text-end">Total Items</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody id="">
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel">
                         <div class="row mb-2">
                            <div class="col-6"></div>
                            <div class="col-6 text-end">
                                @if($dataPo["spo_status"]!="Done")
                                    <button class="btn btn-success  btn-add-invoice" style="border-radius:100px">+ Add Invoice</button>
                                @endif
                            </div>
                        </div>
                         <table class="table" id="tablePoInvoice">
                            <thead>
                                <tr>
                                    <td class="text-center">Date</td>
                                    <td>Inv No.</td>
                                    <td class="text-end">Total</td>
                                    <td class="text-center">Status</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody id="">
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                         <div class="row mb-2">
                            <div class="col-6"></div>
                            <div class="col-6 text-end">
                                @if($dataPo["spo_status"]!="Done")
                                    <button class="btn btn-success  btn-add-payment" style="border-radius:100px">+ Add Payment</button>
                                @endif
                            </div>
                        </div>
                        <table class="table" id="tablePaymentPo">
                            <thead>
                                <tr>
                                    <td class="" style="width: 10%">No. Invoice</td>
                                    <td class="text-center">Date</td>
                                    <td class="text-center">Method</td>
                                    <td class="text-end">Total</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody id="">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
 {{-- Modal Insert--}}
    <div class="modal fade bs-example-modal-center show" id="modalInsert"    tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" id="modalInsert">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                      <label  for="">Invoice Date*</label>
                      <input type="date" class="form-control fill" name="category_name" id="soi_date">
                       <label class="mt-2" for="">Invoice Due Date*</label>
                       <input type="date" class="form-control fill" name="category_name" id="soi_due_date" placeholder="Ex INV2201">
                       <label class="mt-2" for="">Invoice Total*</label>
                        <div class="input-group mb-3 fix-nominal">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control  nominal_only" name="vc_nominal" id="soi_total" placeholder="25.000">
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

    <div class="modal fade bs-example-modal-center show" id="modalInsertPayment"    tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" id="modalInsert">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                       <label for="">Invoice No.*</label>
                       <select name="" id="soi_id" class="fillPayment form-select"></select>

                       <label class="mt-2" for="">Payment Date*</label>
                       <input type="date" class="fillPayment form-control" id="sop_date">

                       <label for="">Payment Method*</label>
                       <select name="" id="sop_type" class="fillPayment form-select">
                            <option value="Cash">Cash</option>
                            <option value="Transfer">Transfer</option>
                       </select>

                       <label class="mt-2" for="">Invoice Total*</label>
                        <div class="input-group mb-3 fix-nominal">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control  nominal_only fillPayment" id="sop_total" placeholder="25.000">
                        </div>

                         <div class="col-2">
                            <label for="">Proof Of Transfer</label>
                            <label class="float-start cursor mt-2">
                                <img src="{{ asset('assets/image-cards.png') }}"  class="w-100 preview_gallery">
                                <input type="file" accept="image/png, image/jpeg"  name="file" id="input_file_img" class="input-gambar input-gallery" hidden>
                                <input type="hidden" class="gallery_id" id="gallery_id">
                            </label>
                        </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save-payment">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    
    <div class="modal fade bs-example-modal-center show" id="modalInsertDO" tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" id="modalInsert">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delivery Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                        <div class="row">
                            <div class="col-4">
                                <label class="mt-2" for="">Delivery Date*</label>
                                <input type="date" class="fillDo form-control" id="do_date">
                            </div>
                            <div class="col-4">
                                <label class="mt-2" for="">Sender Name*</label>
                                <input type="text" class="fillDo form-control" id="do_sender_name">
                            </div>
                            <div class="col-4">
                                <label class="mt-2" for="">Receiver Name*</label>
                                <input type="text" class="fillDo form-control" id="do_receiver_name">
                            </div>
                        </div>
                        <label class="mt-2" for="">Notes</label>
                       <textarea name="" id="do_note" cols="30" rows="5"  class="form-control"></textarea>
                       <label class="mt-2" for="">List Product*</label>
                       <div class="row row-product">
                            
                       </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save-do">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <div class="modal fade bs-example-modal-center show" id="modalViewPayment"    tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <label class="fw-bold mb-2">Invoice No.*</label><br>
                                <label id="view_soi_nomer">-</label>
                            </div>
                            <div class="col-6">
                                <label class="fw-bold mb-2" for="">Payment Date*</label><br>
                                <label id="view_sop_date">-</label>
                            </div>
                        </div>
                       
                        <div class="row mt-3">
                            <div class="col-6">
                                <label  class="fw-bold mb-2">Payment Method*</label><br>
                                <label id="view_sop_type">-</label>
                            </div>
                            <div class="col-6">
                                <label class="fw-bold mb-2">Invoice Total*</label><br>
                                <label id="view_sop_total">-</label>
                            </div>
                        </div>
                       
                        <div class="row mt-3">
                            <div class="col-6">
                                <label class="fw-bold mb-2">Proof Of Transfer</label><br>
                                <img src="" id="view_sop_img" alt="" style="width: 150px">
                            </div>
                        </div>

                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-success btn-download" download>Download Image</a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
@endsection

@section('Custom_js')
    <script>
        var so_id = "{{ $so_id }}";    
        var dataPo = @json($dataPo);    
        console.log(dataPo);
        
        var public = "{{ asset('') }}";    
        var uploadImageUrl = "{{ asset('assets/image-cards.png') }}";
    </script>
    <script src="{{asset('custom_js/Customer/SalesOrderDetail.js')}}"></script>
@endsection