@extends('Backoffice.Layout')
@section('custom_css')
    <style>
        
        .card-menu{
            cursor: pointer;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
        }
        .card-select{
            border: 2px solid #91aadf!important;
        }
    </style>
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Bundling</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Promotion</a></li>
                    <li class="breadcrumb-item active">Bundling</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_bd_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Bundling Name ">
                    </div>
                    <div class="col-9 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Bundling</button>
                    </div>
                </div>
                <table class="table" id="tableBundling">
                    <thead>
                        <tr>
                            <td>Bundling Name</td>
                            <td>Bundling Price</td>
                            <td>Bundling Desc</td>
                            <td>Bundling Qty</td>
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
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Bundling Image</label>
                            <label class="float-start cursor mt-2">
                                <img src="{{ asset('assets/image-cards.png') }}"  class=" preview_gallery" style="width:90%">
                                <input type="file" accept="image/png, image/jpeg"  name="file" id="input_file_img" class="input-gambar input-gallery" hidden>
                                <input type="hidden" class="gallery_id" id="gallery_id">
                            </label>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="">Bundling Name*</label>
                                    <input type="text" class="form-control fill" name="" id="bd_name" placeholder="">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="">Bundling Price*</label>
                                     <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" class="form-control fill nominal_only" name="" id="bd_price" placeholder="10.000">
                                    </div>
                                    
                                </div>
                            </div>
                            <label for="">Desc</label>
                            <textarea name="" id="bd_desc" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="row mt-3 me-0">
                            <div class="col-9 pt-2">
                                <h6 class="label">Select Product <small class="text-muted" id="totalSelected">(0 Items)</small></h6>
                            </div>
                            <div class="col-3 text-end pe-0 me-0">
                                <input type="text" name="" id="search_product" class="form-control" placeholder="Search SKU/Name Product" style="height: 30px">
                            </div>
                        </div>
                        <div class="row row-product " style="height: 200px; overflow-y: auto; overflow-x: hidden;">
                           <div class="spinner-grow m-2 mx-auto mt-5" style="width: 4rem; height: 4rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

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
    <script src="{{asset('custom_js/Promotion/Bundling.js')}}"></script>
@endsection