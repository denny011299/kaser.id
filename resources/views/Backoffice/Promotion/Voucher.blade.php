@extends('Backoffice.Layout')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('custom_css/Voucher.css')}}">
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Voucher</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Voucher</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_vc_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Voucher Name ">
                    </div>
                    <div class="col-9 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Voucher</button>
                    </div>
                </div>
                <table class="table" id="tableVoucher">
                    <thead>
                        <tr>
                            <td>Vocuher Name</td>
                            <td>Vocuher Value</td>
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
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                       <label for="">Voucher Name*</label>
                       <input type="text" class="form-control fill" name="voucher_name" id="vc_name" placeholder="Voucher Name">
                       <label for="" class="mt-2">Voucher Deskripsi*</label>
                        <textarea name="" id="vc_deskripsi" class="form-control" cols="30" rows="5"></textarea>
                        <div class="row  mt-2">
                            <div class="col-6">
                                <h6>Voucher Type</h6>
                            </div>
                            <div class="col-6 d-flex ">
                                <div class="form-check form-switch mb-2 ms-auto justify-content-end">
                                    <input class="form-check-input" type="checkbox" role="switch" id="voucherType">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Percent</label>
                                </div>
                            </div>
                        </div>
                       <label class="fix-nominal" for="">Voucher Nominal*</label>
                       <div class="input-group mb-3 fix-nominal">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control  nominal " name="vc_nominal" id="vc_nominal" placeholder="25.000">
                        </div>
                       
                        <label for="" class="percent" style="display: none">Voucher Percent*</label>
                        <div class="input-group mb-3 percent" style="display: none">
                            <input type="text" class="form-control  number-only percent" name="vc_persen" id="vc_persen" placeholder="">
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
    <script src="{{asset('custom_js/Promotion/Voucher.js')}}"></script>
@endsection