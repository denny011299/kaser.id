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
                <h4 class="fs-18 fw-semibold m-0">Customer</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
                    <li class="breadcrumb-item active">Customer</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_cus_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Customer Name ">
                    </div>
                    <div class="col-3">
                        <select name="" id="filter_city_id" class="form-select"></select>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Customer</button>
                    </div>
                </div>
                <table class="table" id="tableCustomer">
                    <thead>
                        <tr>
                            <td>Customer Name</td>
                            <td>Customer Code</td>
                            <td>Telphone</td>
                            <td>City</td>
                            <td>Total Receivables</td>
                            <td>Total Spent</td>
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
                            <label for="">Customer Image</label>
                            <label class="float-start cursor mt-2">
                                <img src="{{ asset('assets/image-cards.png') }}"  class="w-100 preview_gallery">
                                <input type="file" accept="image/png, image/jpeg"  name="file" id="input_file_img" class="input-gambar input-gallery" hidden>
                                <input type="hidden" class="gallery_id" id="gallery_id">
                            </label>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="">Customer Name*</label>
                                    <input type="text" class="form-control fill" name="" id="cus_name" placeholder="">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="">Customer Phone*</label>
                                    <input type="text" class="form-control fill number-only" name="" id="cus_nomer" placeholder="08xxxxx">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="">Customer Address*</label>
                                    <input type="text" class="form-control fill" name="" id="cus_address" placeholder="Jl....">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="">Customer DOB*</label>
                                    <input type="date" class="form-control fill" name="" id="cus_dob" placeholder="">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="">Customer Gender*</label>
                                    <select name="" id="cus_gender" class="form-select fill">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-6 mb-2">
                                    <label for="">City*</label>
                                    <select name="" id="city_id" class="form-select"></select>
                                </div>
                            </div>
                            <label for="">Notes</label>
                            <textarea name="" id="cus_notes" cols="30" rows="3" class="form-control"></textarea>
                           
                        </div>
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
    <script src="{{asset('custom_js/Customer/Customer.js')}}"></script>
@endsection