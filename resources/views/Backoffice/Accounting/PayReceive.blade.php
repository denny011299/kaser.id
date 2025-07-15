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
                <h4 class="fs-18 fw-semibold m-0">Payable & Receiveable</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Accounting</a></li>
                    <li class="breadcrumb-item active">Payable & Receiveable</li>
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
                            <div class="fs-16 mb-1">Payables</div>
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
                            <div class="fs-16 mb-1">Receiveables</div>
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
                            <span class="d-none d-sm-block">Payables</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation" menu="2">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab" aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline"></i></span>
                            <span class="d-none d-sm-block">Receiveables</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="row mb-2">
                            <div class="col-3">
                                <input type="text" id="filter_spoi_nomer" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Invoice Number ">
                            </div>
                            <div class="col-3">
                                <select name="" id="filter_spo_company" class="form-select"></select>
                            </div>
                            <div class="col-6">
                                
                            </div>
                        </div>
                        <table class="table" id="tablePayables">
                             <thead>
                                 <tr>
                                     <td>PO Date</td>
                                     <td>PO Number</td>
                                     <td>Invoice Number</td>
                                     <td>Supplier Name</td>
                                     <td class="text-center">Total</td>
                                     <td>Status</td>
                                     <td class="text-center">Action</td>
                                 </tr>
                             </thead>
                             <tbody></tbody>
                         </table>
                        
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <div class="row mb-2">
                            <div class="col-3">
                                <input type="text" id="filter_soi_nomer" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Invoice Number ">
                            </div>
                            <div class="col-3">
                                <select name="" id="filter_so_company" class="form-select"></select>
                            </div>
                        </div>
                        <table class="table" id="tableReceiveables">
                             <thead>
                                 <tr>
                                     <td>Order Date</td>
                                     <td>Due Date</td>
                                     <td>SO Number</td>
                                     <td>Invoice Number</td>
                                     <td>Customer Name</td>
                                     <td class="text-center">Total</td>
                                     <td>Status</td>
                                     <td class="text-center">Action</td>
                                 </tr>
                             </thead>
                             <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

@endsection

@section('Custom_js')
    <script>
        var public = "{{ asset('') }}";
        var uploadImageUrl = "{{ asset('assets/image-cards.png') }}";
    </script>
    <script src="{{asset('custom_js/Accounting/PayReceive.js')}}"></script>
@endsection