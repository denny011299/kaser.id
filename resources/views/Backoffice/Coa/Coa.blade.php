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
                <h4 class="fs-18 fw-semibold m-0">Chart of Accounts (COA)</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Chart of Accounts</a></li>
                    <li class="breadcrumb-item active">COA</li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-underline border-bottom" role="tablist">
                    <li class="nav-item menu" role="presentation" menu="1">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none"><i class="mdi mdi-home-account"></i></span>
                            <span class="d-none d-sm-block">COA Categories</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation" menu="2">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab" aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline"></i></span>
                            <span class="d-none d-sm-block">COA</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation" menu="3">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                            <span class="d-none d-sm-block">Sub COA</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="row mb-2">
                            <div class="col-3">
                                <input type="text" id="filter_cc_kode" class="form-control number-only" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Category Code ">
                            </div>
                            <div class="col-3">
                                <input type="text" id="filter_cc_nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Category Name ">
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-success btn-add-category" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> Add Category</button>
                            </div>
                        </div>
                        <table class="table" id="tableCoaCategory">
                             <thead>
                                 <tr>
                                     <td>Code</td>
                                     <td>Category Name</td>
                                     <td class="text-center">Action</td>
                                 </tr>
                             </thead>
                             <tbody></tbody>
                         </table>
                        
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <div class="row mb-2">
                            <div class="col-3">
                                <input type="text" id="filter_coa_kode" class="form-control number-only" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter COA Code ">
                            </div>
                            <div class="col-3">
                                <input type="text" id="filter_coa_nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter COA Name ">
                            </div>
                            <div class="col-3">
                                <select name="" id="filter_coa_cc_name" class="form-select"></select>
                            </div>
                            <div class="col-3 text-end">
                                <button class="btn btn-success btn-add-coa" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> Add COA</button>
                            </div>
                        </div>
                        <table class="table" id="tableCoa">
                             <thead>
                                 <tr>
                                     <td>Code</td>
                                     <td>COA Name</td>
                                     <td>Category</td>
                                     <td class="text-center">Action</td>
                                 </tr>
                             </thead>
                             <tbody></tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel">
                        <div class="row mb-2">
                            <div class="col-3">
                                <input type="text" id="filter_sc_kode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter COA Code ">
                            </div>
                            <div class="col-3">
                                <input type="text" id="filter_sc_nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter COA Name ">
                            </div>
                            <div class="col-3">
                                <select name="" id="filter_sc_coa_name" class="form-select"></select>
                            </div>
                            <div class="col-3 text-end">
                                <button class="btn btn-success btn-add-sub" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> Add Sub COA</button>
                            </div>
                        </div>
                        <table class="table mt-3" id="tableSubCoa">
                            <thead>
                                <tr>
                                    <td>Code</td>
                                    <td>Sub COA Name</td>
                                    <td>COA</td>
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

     {{-- Modal Insert--}}
    <div class="modal fade " id="modalInsertCategory"  tabindex="-1" role="dialog"  data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Insert Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    
                    <label for="">Category Code*</label>
                    <input type="text" name="" id="cc_kode" class="form-control fill mb-3" placeholder="Ex 10">

                    <label for="">Category Name*</label>
                    <input type="text" name="" id="cc_nama" class="form-control fill " placeholder="Ex Aktiva">
                
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save-category">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
     {{-- Modal Insert--}}
    <div class="modal fade " id="modalInsertCoa"  tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Insert COA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <label for="">Category Name*</label>
                    <select class="form-control fill" id="coa_cc_name" placeholder=""></select>

                    <label for="" class="mt-3">Coa Kode*</label>
                    <input type="text" class="form-control fill mb-3" id="coa_kode" placeholder="Ex 101"></input>

                    <label for="">Coa Name*</label>
                    <input type="text" class="form-control fill" id="coa_nama" placeholder="Ex Kas"></input>

                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save-coa">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
     {{-- Modal Insert--}}
    <div class="modal fade " id="modalInsertSub"  tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Insert Sub COA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <label for="">COA Name*</label>
                    <select class="form-control fill" id="sc_coa_name" placeholder=""></select>

                    <label for="" class="mt-3">Sub Coa Kode*</label>
                    <input type="text" class="form-control fill mb-3" id="sc_kode" placeholder=""></input>

                    <label for="">Sub Coa Name*</label>
                    <input type="text" class="form-control fill" id="sc_nama" placeholder=""></input>

                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save-sub">Save changes</button>
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
    <script src="{{asset('custom_js/Coa/Coa.js')}}"></script>
@endsection