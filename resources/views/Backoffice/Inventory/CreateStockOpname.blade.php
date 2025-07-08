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
                    @if($stp_type==1)
                        <div class="col-3">
                            <select name="" id="category_id" class="form-select" {{$mode==1?"":"disabled"}}></select>
                        </div>
                    @endif
                    <div class="col-3">
                        <input type="text"  class="form-control fill" id="staff" aria-describedby="emailHelp" placeholder="Inventory Staff" {{$mode==1?"":"disabled"}}>
                    </div>
                    <div class="col-6 text-end">
                        
                    </div>
                </div>
                <table class="table mt-3" id="tableStockOpname">
                    <thead>
                        <tr>
                            <td  class="text-center">No.</td>
                            <td>SKU</td>
                            <td style="width:15%">Name</td>
                            <td class="text-center">Stock Comp.</td>
                            <td class="text-center">Stock Real</td>
                            <td class="text-center">Difference</td>
                            <td>Notes</td>
                        </tr>
                    </thead>
                    <tbody id="tbStock"></tbody>
                </table>
            </div>
        </div>

       <div class="text-end">
        <button class="btn bg-primary-subtle btn-save" style="border-radius: 100px"><span class="mdi mdi-content-save-check-outline"></span> Save Change</button>
       </div>
    </div>

        
@endsection

@section('Custom_js')
    <script>
        var mode = "{{$mode}}";
        var stp_type = "{{$stp_type}}";
        var data = @json($data);
    </script>
    <script src="{{asset('custom_js/Inventory/CreateStockOpname.js')}}"></script>
@endsection