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
                <h4 class="fs-18 fw-semibold m-0">Product Units</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Product Units</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_pu_short_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Unit Full Name ">
                    </div>
                    <div class="col-3">
                        <input type="text" id="filter_pu_full_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Unit Short Name ">
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Product Unit</button>
                    </div>
                </div>
                <table class="table" id="tableProductUnit">
                    <thead>
                        <tr>
                            <td>Full Name</td>
                            <td>Short Name</td>
                            <td class="text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

       
    </div>

     {{-- Modal Insert--}}
    <div class="modal fade bs-example-modal-center show" id="modalInsert"    tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" id="modalInsert">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                       <label for="">Fullname*</label>
                       <input type="text" class="form-control fill" name="category_name" id="pu_full_name" placeholder="Ex Piece">
                       <label for="">Shortname*</label>
                       <input type="text" class="form-control fill" name="category_name" id="pu_short_name" placeholder="Ex Pcs">
                       
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
    <script src="{{asset('custom_js/Product/Product_unit.js')}}"></script>
@endsection