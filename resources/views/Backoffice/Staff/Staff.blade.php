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
                <h4 class="fs-18 fw-semibold m-0">Staff</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Staff</a></li>
                    <li class="breadcrumb-item active">Staff</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_st_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter Staff Name ">
                    </div>
                    <div class="col-3">
                        <select name="" id="filter_category_id" class="form-select"></select>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Staff</button>
                    </div>
                </div>
                <table class="table" id="tableStaff">
                    <thead>
                        <tr>
                            <td>Staff Name</td>
                            <td>Position</td>
                            <td>Phone Number</td>
                            <td>Email</td>
                            <td>Gender</td>
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
                    <h5 class="modal-title">Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <div class="profile">
                                <label for="">Staff Profile*</label>
                                <label class="float-start cursor mt-2">
                                    <img src="{{ asset('assets/image-cards.png') }}"  class="w-100 preview_gallery">
                                    <input type="file" accept="image/png, image/jpeg"  name="file" id="input_file_img" class="input-gambar input-gallery" hidden>
                                    <input type="hidden" class="gallery_id" id="gallery_id">
                                </label>
                            </div>
                            <div class="ktp">
                                <label class="pt-4" for="">Staff KTP*</label>
                                <label class="float-start cursor mt-2">
                                    <img src="{{ asset('assets/image-cards.png') }}"  class="w-100 preview_gallery_ktp">
                                    <input type="file" accept="image/png, image/jpeg"  name="file" id="input_file_img_ktp" class="input-gambar input-gallery" hidden>
                                    <input type="hidden" class="gallery_id_ktp" id="gallery_id_ktp">
                                </label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="">Staff Name*</label>
                                    <input type="text" class="form-control fill" name="" id="st_name" placeholder="">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="">Staff Phone*</label>
                                    <input type="text" class="form-control fill number-only" name="" id="st_nomer" placeholder="08xxxxx">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="">Staff Address*</label>
                                    <input type="text" class="form-control fill" name="" id="st_address" placeholder="Jl....">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="">Staff Email*</label>
                                    <input type="email" class="form-control fill" name="" id="st_email" placeholder="">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="">Staff Position*</label>
                                    <select name="" id="category_id" class="form-select fill"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="">Staff Gender*</label>
                                    <select name="" id="st_gender" class="form-select fill">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="">Staff NIK*</label>
                                    <input type="text" class="form-control fill number-only" name="" id="st_nik" placeholder="">
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-6 mb-2">
                                    <label for="">Staff Birthdate*</label>
                                    <input type="date" class="form-control fill" name="" id="st_birthdate" placeholder="">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="">Staff Age*</label>
                                    <input type="text" class="form-control fill number-only" name="" id="st_age" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-6 mb-2">
                                    <label for="">Staff Religion*</label>
                                    <select name="" id="st_religion" class="form-select fill">
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="">Staff Username*</label>
                                    <input type="text" class="form-control fill" name="" id="st_username" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="" id="labelPasswordOld">Old Password*</label>
                                    <input type="password" class="form-control fill" name="" id="st_password" placeholder="">
                                </div>
                                <div class="col-6 mb-2" id="password">
                                    <label for="">Confirm Password</label>
                                    <input type="password" class="form-control" name="" id="confirm_password" placeholder="">
                                </div>
                            </div>
                           
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
    <script src="{{asset('custom_js/Staff/Staff.js')}}"></script>
@endsection