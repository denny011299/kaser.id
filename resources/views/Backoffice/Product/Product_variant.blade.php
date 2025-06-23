@extends('Backoffice.Layout')
@section('custom_css')
    <style>
        .choice{
            border-radius: 100px;
        }
        .variants{
            cursor: pointer;
        }
    </style>
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Product Variant</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Product Variant</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_pv_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Variant Name ">
                    </div>
                    <div class="col-9 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Product Variant</button>
                    </div>
                </div>
                <table class="table" id="tableProductVariant">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Variant</td>
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
                       <label for="">Variant Name*</label>
                       <input type="text" class="form-control fill " name="" id="pv_name" placeholder="Ex Piece">
                       <label class="mt-3" for="">List Variant*</label>
                       <div class="row">
                            <div class="col-4 col-lg-3">
                                <input type="text" class="form-control" name="" id="variant" placeholder="New Variant">
                            </div>
                            <div class="col-3 col-lg-2">
                                <button class="btn bg-success-subtle btn-add-variant">+ Add</button>
                            </div>
                       </div>
                       <br>
                       <div id="container-variant" class="row">
                           
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
    <script src="{{asset('custom_js/Product/Product_variant.js')}}"></script>
@endsection