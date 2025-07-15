@extends('Backoffice.Layout')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('custom_css/vc-toggle-switch.css')}}">
    <style>
    </style>
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Cashflow</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Accounting</a></li>
                    <li class="breadcrumb-item active">Cashflow</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#E7366B" fill-rule="evenodd" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10m.75-16a.75.75 0 0 0-1.5 0v.317c-1.63.292-3 1.517-3 3.183c0 1.917 1.813 3.25 3.75 3.25c1.377 0 2.25.906 2.25 1.75s-.873 1.75-2.25 1.75c-1.376 0-2.25-.906-2.25-1.75a.75.75 0 0 0-1.5 0c0 1.666 1.37 2.891 3 3.183V18a.75.75 0 0 0 1.5 0v-.317c1.63-.292 3-1.517 3-3.183c0-1.917-1.813-3.25-3.75-3.25c-1.376 0-2.25-.906-2.25-1.75s.874-1.75 2.25-1.75c1.377 0 2.25.906 2.25 1.75a.75.75 0 0 0 1.5 0c0-1.666-1.37-2.891-3-3.183z" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="fs-16 mb-1">Cash-In</div>
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
            <div class="col-6">
                 <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#108dff" fill-rule="evenodd" d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991zM14 9a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8c4 0 4-.895 4-2s-1.79-2-4-2s-4 .895-4 2s0 2 4 2" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="fs-16 mb-1">Cash-Out</div>
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
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_cf_desc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Description ">
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" id="filter_cf_date" name="">
                    </div>
                    <div class="col-3">
                        <select name="" id="filter_coa" class="form-select"></select>
                    </div>
                    <div class="col-3 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Cashflow</button>
                    </div>
                </div>
                <table class="table" id="tableCashflow">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Category</td>
                            <td>Description</td>
                            <td class="text-center">Debit</td>
                            <td class="text-center">Credit</td>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
       
    </div>

    
     {{-- Modal Insert--}}
    <div class="modal fade " id="modalInsert"  tabindex="-1" role="dialog"  data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex px-2 pt-1" style="width: 100%">
                        <div class="col-7">
                            <h5 class="modal-title">Insert Journal Entry</h5>
                        </div>
                        <div class="col-4">
                            <div class="text-center d-flex justify-content-end">
                                <div class="vc-toggle-container">
                                    <label class="vc-switch" style="width: 100px;height:30px">
                                        <input type="checkbox" class="vc-switch-input" id="btnType" />
                                        <span class="vc-switch-label" data-on="Credit" data-off="Debit"></span>
                                        <span class="vc-handle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 pt-1">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    
                    <label for="">Date*</label>
                    <input type="date" name="" id="je_date" class="form-control fill mb-3" placeholder="Ex 10">

                    <label for="">Description*</label>
                    <input type="text" name="" id="je_description" class="form-control fill mb-3" placeholder="Ex Pembelian Alat">
                    
                    <label for="">Cash Type*</label>
                    <select class="form-control fill" id="je_coa_name" placeholder=""></select>
                    
                    <div class="catatan my-3">
                        <label for="">Debit*</label>
                        <div class="input-group fix-nominal">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" name="" id="je_debit" class="form-control fill number-only nominal_only" placeholder="Ex 10000">
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
        var uploadImageUrl = "{{ asset('assets/image-cards.png') }}";
    </script>
    <script src="{{asset('custom_js/Accounting/Cashflow.js')}}"></script>
@endsection