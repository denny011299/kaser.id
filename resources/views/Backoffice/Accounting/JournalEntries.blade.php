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
                <h4 class="fs-18 fw-semibold m-0">Journal</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Accounting</a></li>
                    <li class="breadcrumb-item active">Journal</li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_je_desc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Description ">
                    </div>
                    <div class="col-3">
                        <select name="" id="filter_coa" class="form-select"></select>
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" id="filter_je_date" name="">
                    </div>
                    <div class="col-3 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Journal</button>
                    </div>
                </div>
                <table class="table" id="tableJournal">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Category</td>
                            <td>Description</td>
                            <td>Reference</td>
                            <td class="text-center">Debit</td>
                            <td class="text-center">Credit</td>
                            <td class="text-center">Balance</td>
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
                    
                    <label for="">Reference</label>
                    <input type="text" name="" id="je_reference" class="form-control mb-3" placeholder="Ex PO001">

                    <label for="">COA Name*</label>
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
    <script src="{{asset('custom_js/Accounting/JournalEntries.js')}}"></script>
@endsection