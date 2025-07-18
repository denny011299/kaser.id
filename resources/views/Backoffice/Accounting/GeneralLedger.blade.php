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
                <h4 class="fs-18 fw-semibold m-0">General Ledger</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Accounting</a></li>
                    <li class="breadcrumb-item active">General Ledger</li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body p-4">
                {{-- <div class="row">
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
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Journal Entry</button>
                    </div>
                </div> --}}
                <div class="container" id="list"></div>
            </div>
        </div>
    </div>


@endsection

@section('Custom_js')
    <script>
        var public = "{{ asset('') }}";
        var uploadImageUrl = "{{ asset('assets/image-cards.png') }}";
    </script>
    <script src="{{asset('custom_js/Accounting/GeneralLedger.js')}}"></script>
@endsection