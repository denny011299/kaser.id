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
                <h4 class="fs-18 fw-semibold m-0">Sales Order</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Supplier</a></li>
                    <li class="breadcrumb-item">Sales Order</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" class="form-control" id="filter_nomer" aria-describedby="emailHelp" placeholder="Filter  No. PO">
                    </div>
                    <div class="col-3">
                       <select name="" id="filter_cus_id" class="form-select"></select>
                    </div>
                    <div class="col-6 text-end">
                        <a href="/admin/createSalesOrder" class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Sales Order</a>
                    </div>
                </div>
                <table class="table mt-3" id="tableSalesOrder">
                    <thead>
                        <tr>
                            <td>No. SO</td>
                            <td>Order Date</td>
                            <td>Customer Name</td>
                            <td>Total</td>
                            <td>Status</td>
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
    <script src="{{asset('custom_js/Customer/SalesOrder.js')}}"></script>
@endsection