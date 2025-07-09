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
                <h4 class="fs-18 fw-semibold m-0">Journal Entries</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Accounting</a></li>
                    <li class="breadcrumb-item active">Journal Entries</li>
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
                    <div class="col-6 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Journal Entry</button>
                    </div>
                </div>
                <table class="table" id="tableJournal">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Category</td>
                            <td>Description</td>
                            <td>Reference</td>
                            <td>Debit</td>
                            <td>Credit</td>
                            <td>Gross</td>
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
                    <h5 class="modal-title">Insert Journal Entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    
                    <label for="">Date*</label>
                    <input type="date" name="" id="je_date" class="form-control fill mb-3" placeholder="Ex 10">

                    <label for="">Description*</label>
                    <input type="text" name="" id="cc_nama" class="form-control fill mb-3" placeholder="Ex Aktiva">

                    <label for="">COA Name*</label>
                    <select class="form-control fill" id="sc_coa_name" placeholder=""></select>
                    
                    <div class="col-5 text-end pt-3">
                         <div class="btn-group" role="group" aria-label="Basic radio toggle button group" >
                            <input type="radio" class="btn-check btn_scan" name="btnradio" id="btn_scan" value="1" autocomplete="off" checked="" style="border-radius: 100px;">
                            <label class="btn btn-outline-primary" for="btn_scan">Auto Scan</label>

                            <input type="radio" class="btn-check btn_scan " name="btnradio" id="btn_manual" value="2" autocomplete="off" style="border-radius: 100px;">
                            <label class="btn btn-outline-primary" for="btn_manual">Manual Entry</label>
                        </div>
                    </div>
                    <br>
                    <label for="">Debit*</label>
                    <input type="text" name="" id="je_debit" class="form-control fill mb-3 number-only nominal_only" placeholder="Ex 10000">

                    <label for="">Description*</label>
                    <input type="text" name="" id="cc_nama" class="form-control fill mb-3" placeholder="Ex Aktiva">
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
    <script src="{{asset('custom_js/Accounting/JournalEntries.js')}}"></script>
@endsection