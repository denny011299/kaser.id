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
                <h4 class="fs-18 fw-semibold m-0">Staff Detail</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Staff</a></li>
                    <li class="breadcrumb-item">Staff</li>
                    <li class="breadcrumb-item active">Staff Detail</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-2 pt-0">
                                <img src="{{asset($data["st_profile"])}}" alt="" style="width: 150px; border-radius: 10px">
                            </div>
                            <div class="col-10 pt-1 px-3">
                                <div class="row">
                                    <div class="col-6 pt-1">
                                        <h5>{{$data["st_name"]}}</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                         <label for="" class="bg-primary-subtle text-primary px-3 py-1 mb-2" style="border-radius: 100px;font-size:8pt">{{$data["cs_name"]}}</label>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <table>
                                            <tr>
                                                <td>Birthdate</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{$data["st_birthdate"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Age</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{$data["st_age"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{$data["st_email"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{$data["st_gender"]}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <table>
                                            <tr>
                                                <td>Telephone</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{$data["st_nomer"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{$data["st_address"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Religion</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{$data["st_religion"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>NIK</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{$data["st_nik"]}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-underline border-bottom" role="tablist">
                    <li class="nav-item menu" role="presentation" menu="1">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tab_absensi" role="tab" aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none"><i class="mdi mdi-home-account"></i></span>
                            <span class="d-none d-sm-block">Absensi</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation" menu="2">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab_reimburse" role="tab" aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline"></i></span>
                            <span class="d-none d-sm-block">Reimburse</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation" menu="3">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab_cashbon" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                            <span class="d-none d-sm-block">Cashbon</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation" menu="4">
                        <a class="nav-link " data-bs-toggle="tab" href="#tab_salary" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                            <span class="d-none d-sm-block">Salary</span>
                        </a>
                    </li>
                    <li class="nav-item menu" role="presentation" menu="4">
                        <a class="nav-link " data-bs-toggle="tab" href="#tab_document" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                            <span class="d-none d-sm-block">Document</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="tab_absensi" role="tabpanel">
                        <table class="table" id="tableAbsensi">
                             <thead>
                                 <tr>
                                     <td class="text-center">Hari / date</td>
                                     <td class="text-center">Jam Masuk</td>
                                     <td class="text-center">Jam Keluar</td>
                                     <td>Lembur</td>
                                     <td class="text-center">Status</td>
                                     <td class="text-center">Action</td>
                                 </tr>
                             </thead>
                             <tbody></tbody>
                         </table>
                        
                    </div>
                    <div class="tab-pane" id="tab_reimburse" role="tabpanel">
                        <table class="table" id="tableReimburse">
                             <thead>
                                 <tr>
                                     <td class="text-center">Date</td>
                                     <td>No. Reimburse</td>
                                     <td>Total</td>
                                     <td class="text-center">Status</td>
                                     <td class="text-center">Action</td>
                                 </tr>
                             </thead>
                             <tbody></tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab_cashbon" role="tabpanel">
                       <table class="table" id="tableCashbon">
                            <thead>
                                <tr>
                                    <td class="text-center">Date</td>
                                    <td>No. Cashbon</td>
                                    <td>Due Date</td>
                                    <td>Total Cashbon</td>
                                    <td class="text-center">Status</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab_salary" role="tabpanel">
                        <table class="table" id="tableSalary">
                            <thead>
                                <tr>
                                    <td>No. Slip</td>
                                    <td class="text-center">Date</td>
                                    <td>Inv No.</td>
                                    <td class="text-end">Total</td>
                                    <td class="text-center">Status</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody id="">
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab_document" role="tabpanel">
                        <table class="table" id="tableDocument">
                            <thead>
                                <tr>
                                    <td>Document Name</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody id="">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="backButtons">
            <a href="/admin/Staff" class="btn btn-outline-dark">< Back</a>
        </div>
    </div>

@endsection

@section('Custom_js')
    <script>
        var st_id = "{{ $data['st_id'] }}";    
        var public = "{{ asset('') }}";    
        var uploadImageUrl = "{{ asset('assets/image-cards.png') }}";
    </script>
    <script src="{{asset('custom_js/Staff/Staff_detail.js')}}"></script>
@endsection