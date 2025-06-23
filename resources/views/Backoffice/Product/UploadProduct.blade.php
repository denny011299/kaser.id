@extends('Backoffice.Layout')
@section('custom_css')
    <style>
        .container-variant {
           background-color: rgb(238, 245, 253);
           border:2px dashed #b8c7ea;
           border-radius:20px;
           min-height:150px
        }
        .container-bulk{
           background-color: rgb(238, 245, 253);
           border:2px dashed #b8c7ea;
           border-radius:20px;
           min-height:150px
        }
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
                    <li class="breadcrumb-item active">Upload Product</li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <label for="">Product Image</label>
                        <label class="float-start cursor mt-3 text-center">
                            <img src="{{ asset('assets/image-cards.png') }}"  class="preview_gallery" style="width: 80%">
                            <input type="file" accept="image/png, image/jpeg"  name="file" id="input_file_img" class="input-gambar input-gallery" hidden>
                            <input type="hidden" class="gallery_id" id="gallery_id">
                        </label>
                    </div>
                    <div class="col-10">
                        <div class="row">
                            <div class="col-5">
                                <label for="">Product Name*</label>
                                <input type="text" class="form-control fill" name="" id="pr_name" placeholder="">
                            </div>
                            <div class="col-3">
                                <label for="">SKU*</label>
                                <input type="text" class="form-control fill" name="" id="pr_sku" placeholder="">
                            </div>
                            <div class="col-3">
                                <label for="">Category Product*</label>
                                <select name="" id="c_id" class="form-select"></select>
                            </div>
                            <div class="col-3 mt-2">
                                <label for="">Product Expired</label>
                                <input type="date" class="form-control" name="" id="pr_exp" placeholder="">
                            </div>
                            <div class="col-2 mt-2">
                                <label for="">Product Weight</label>
                                 <div class="input-group fix-nominal">
                                    <input type="text" class="form-control number-only" name="" id="pr_berat" placeholder="">
                                    <span class="input-group-text">Gr</span>
                                </div>
                                
                            </div>
                            <div class="col-3 mt-2">
                                <label for="">Product Unit*</label>
                                <select name="" id="pu_id" class="form-select"></select>
                            </div>
                            <div class="col-2 mt-2">
                                <label for="">Product Stock*</label>
                                <input type="text" class="form-control number-only" name="" id="pr_stok" placeholder="">
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-3 mt-2">
                                <label for="">Product Price*</label>
                                 <div class="input-group fix-nominal">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control nominal_only" name="" id="pr_price" placeholder="">
                                </div>
                            </div>
                            <div class="col-2 mt-2">
                                <label for="">Alert Stock*</label>
                                <input type="text" class="form-control number-only" name="" id="pr_alert_stok" placeholder="">
                            </div>
                            <div class="col-4 mt-2">
                                <label for="">Barcode Number</label>
                                <input type="text" class="form-control number-only" name="" id="pr_barcode" placeholder="">
                                <small class="text-muted">*If not filled in, it will be generated automatically.</small>
                            </div>
                        </div>
                        <label class="mt-2">Product Deskripsi*</label>
                        <textarea name="" id="pr_deskripsi" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6>Variant</h6>
                <button class="btn btn-outline-primary " id="btn-aktifasi-variant" style="border-radius: 100px">+ Activate Variant</button>
                <div class="container block-variant mt-3" style="display: none" >
                    <div class=" row">
                        <div class="col-3">
                            <label for="">Product Variant*</label>
                            <select name="" id="pv_id" class="form-select"></select>
                        </div>    
                        <div class="col-9 pt-3">
                            <button class="btn btn-outline-success btn-add-variant">Add Variant</button>
                            <button class="btn btn-outline-danger" id="btn-deactivate">Deactivate Variant</button>
                        </div>    
                    </div>
                    <div class="mt-3 container-variant" style="">
                      

                    </div>
                    
                </div>
                <h6 class="mt-3">Bluk Price</h6>
                <button class="btn btn-outline-primary btn-bulk" style="border-radius: 100px">+ Bluk Price</button>
                <button class="btn btn-outline-danger" id="btn-deactivate-bulk" style="display: none">Deactivate Bulk Price</button>
                <div class="container block-bulk mt-3" style="display: none" >
                    <div class="mt-3 container-bulk" style="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <a href="/admin/product" class="btn bg-dark-subtle" style="border-radius: 100px">Back</a>
            </div>
            <div class="col-6 text-end">
                <button class="btn bg-success-subtle btn-save" style="border-radius: 100px">Save Changes</button>
            </div>
        </div>
    </div>

@endsection

@section('Custom_js')
    <script>
        var public = "{{ asset('') }}";    
        var uploadImageUrl = "{{ asset('assets/image-cards.png') }}";
        var mode="{{$mode}}";
        var data=@json($data);
        console.log(data);
        
    </script>
    <script src="{{asset('custom_js/Product/UploadProduct.js')}}"></script>
@endsection