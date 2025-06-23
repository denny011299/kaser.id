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
                <h4 class="fs-18 fw-semibold m-0">Product</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_pr_name" class="form-control" id="pr_name" aria-describedby="emailHelp" placeholder="Filter Product Name ">
                    </div>
                    <div class="col-3">
                        <input type="text" id="filter_pr_sku" class="form-control" id="pr_sku" aria-describedby="emailHelp" placeholder="Filter SKU ">
                    </div>
                    <div class="col-3">
                       <select name="" id="filter_c_id" class="form-select"></select>
                    </div>
                    <div class="col-3 text-end">
                        <a href="/admin/insertProduct" class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Product</a>
                    </div>
                </div>
                <table class="table" id="tableProduct">
                    <thead>
                        <tr>
                            <td>SKU</td>
                            <td>Product Name</td>
                            <td>Category</td>
                            <td>Product Price</td>
                            <td>Product Stock</td>
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
        var public = "{{ asset('') }}";    
        var uploadImageUrl = "{{ asset('assets/image-cards.png') }}";
    </script>
    <script src="{{asset('custom_js/Product/Product.js')}}"></script>
@endsection