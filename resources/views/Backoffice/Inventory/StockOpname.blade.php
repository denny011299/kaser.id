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
                <h4 class="fs-18 fw-semibold m-0">Stock Opname</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                    <li class="breadcrumb-item active">Stock Opname</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="date" id="filter_stp_date" class="form-control" aria-describedby="emailHelp">
                    </div>
                    <div class="col-3">
                        <input type="text" id="filter_stp_nomer" class="form-control" aria-describedby="emailHelp" placeholder="Filter Opname No.">
                    </div>
                    <div class="col-6 text-end">
                        <a href="/admin/CreateStockOpname/{{$stp_type}}" class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Stock Opname</a>
                    </div>
                </div>
                <table class="table mt-3" id="tableStockOpname">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Opname No.</td>
                            <td>Name</td>
                            <td class="text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

       
    </div>

        
@endsection

@section('Custom_js')
    <script>
        var stp_type  = "{{$stp_type}}";
    </script>
    <script src="{{asset('custom_js/Inventory/StockOpname.js')}}"></script>
@endsection