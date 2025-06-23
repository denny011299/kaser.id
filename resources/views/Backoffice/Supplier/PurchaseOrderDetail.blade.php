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
                <h4 class="fs-18 fw-semibold m-0">Purchase Order Detail</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Supplier</a></li>
                    <li class="breadcrumb-item">Purchase Order</li>
                    <li class="breadcrumb-item active">Purchase Order Detail</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-2 pt-2">
                                <img src="{{asset($data["sp_img"])}}" alt="" style="width: 100px">
                            </div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-6 pt-1">
                                        <h5>{{$data["sp_name"]}}</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                         <label for="" class="bg-primary-subtle text-primary px-3 py-1 mb-2" style="border-radius: 100px;font-size:8pt">{{$data["city_name"]}}</label>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        <p class="mb-0">Telphone : {{$data["sp_nomer"]}}</p>
                                        <p>Address : {{$data["sp_address"]}}</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0">Cp Name : {{$data["sp_cp_name"]}}</p>
                                        <p>CP Telphone : {{$data["sp_cp_nomer"]}}</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0">Bank Name : {{$data["sp_bank_name"]}}</p>
                                        <p>Bank Account : {{$data["sp_bank_account"]}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#E7366B" fill-rule="evenodd" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10m.75-16a.75.75 0 0 0-1.5 0v.317c-1.63.292-3 1.517-3 3.183c0 1.917 1.813 3.25 3.75 3.25c1.377 0 2.25.906 2.25 1.75s-.873 1.75-2.25 1.75c-1.376 0-2.25-.906-2.25-1.75a.75.75 0 0 0-1.5 0c0 1.666 1.37 2.891 3 3.183V18a.75.75 0 0 0 1.5 0v-.317c1.63-.292 3-1.517 3-3.183c0-1.917-1.813-3.25-3.75-3.25c-1.376 0-2.25-.906-2.25-1.75s.874-1.75 2.25-1.75c1.377 0 2.25.906 2.25 1.75a.75.75 0 0 0 1.5 0c0-1.666-1.37-2.891-3-3.183z" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="fs-16 mb-1">Conversion Rate</div>
                        </div>
                        <div class="d-flex align-items-baseline mb-2">
                            <div class="fs-22 mb-0 me-2 fw-semibold text-dark">15%</div>
                            <div class="me-auto">
                                <span class="text-danger d-inline-flex align-items-center">
                                    10%
                                    <i data-feather="trending-down" class="ms-1" style="height: 20px; width: 20px;"></i>
                                </span>
                            </div>
                        </div>
                        <div id="conversion-visitors" class="apex-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                 <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#108dff" fill-rule="evenodd" d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991zM14 9a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8c4 0 4-.895 4-2s-1.79-2-4-2s-4 .895-4 2s0 2 4 2" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="fs-16 mb-1">Active Users</div>
                        </div>
                        <div class="d-flex align-items-baseline mb-2">
                            <div class="fs-22 mb-0 me-2 fw-semibold text-dark">2,986</div>
                            <div class="me-auto">
                                <span class="text-primary d-inline-flex align-items-center">
                                    4%
                                    <i data-feather="trending-up" class="ms-1" style="height: 20px; width: 20px;"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div id="active-users" class="apex-charts"></div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-underline border-bottom" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none"><i class="mdi mdi-home-account"></i></span>
                            <span class="d-none d-sm-block">Summary</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " data-bs-toggle="tab" href="#messages" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                            <span class="d-none d-sm-block">Invoice</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab" aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline"></i></span>
                            <span class="d-none d-sm-block">Payment</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="row mt-4">
                            <div class="col-6">
                                <h6 class="fw-bold">From</h6>
                                <label for="">{{$dataPo["spo_from_company"]}}</label><br>
                                <label for="">{{$dataPo["spo_from_address"]}}</label><br>
                                <label for="">{{$dataPo["spo_from_nomer"]}}</label>
                            </div>
                            <div class="col-6">
                                <h6 class="fw-bold">To</h6>
                                <label id="text_to_name">{{$dataPo["spo_to_company"]}}</label><br>
                                <label id="text_to_address">{{$dataPo["spo_to_address"]}}</label><br>
                                <label id="text_to_nomor">{{$dataPo["spo_nomer"]}}</label>
                            </div>
                        </div>
                        <hr>
                        <h6  class="fw-bold">List Product</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td class="text-center">Qty</td>
                                    <td>Description</td>
                                    <td class="text-end">Unit Price</td>
                                    <td class="text-end">Subtotal</td>
                                </tr>
                            </thead>
                            <tbody id="tbDetail">
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach ($dataPo["items"] as $item)
                                    <tr>
                                        <td class="text-center">{{$item->spod_qty}}</td>
                                        <td class="text-start">{!!$item->spod_nama!!}</td>
                                        <td class="text-end">Rp.{{number_format($item->spod_harga,0,",",".")}}</td>
                                        <td class="text-end">Rp.{{number_format($item->spod_subtotal,0,",",".")}}</td>
                                    </tr>
                                    @php
                                        $subtotal += $item->spod_subtotal;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="3">Total</td>
                                    <td class="text-end" id="total_value">Rp.{{number_format($subtotal,0,",",".")}}</td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="3">PPN (11%)</td>
                                    <td class="text-end" id="ppn_value">Rp.{{number_format($dataPo["spo_total_ppn"],0,",",".")}}</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td class="text-end" colspan="3">Grand Total</td>
                                    <td class="text-end" id="grandTotal_value">Rp. {{number_format($dataPo["spo_total"],0,",",".")}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="col-9"></div>
                            <div class="col-3 text-end">
                                <div style="height: 50px;border-bottom:1.5px solid gray"></div>
                                <p class="mt-2" id="text_sign_by">{{$dataPo["spo_sign_by"]}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <p class="mb-0">
                            Indulge your taste buds with our mouthwatering selection of gourmet 
                            dishes crafted with the finest ingredients sourced from local farms. 
                            From savory appetizers to delectable main courses and decadent desserts, 
                            our menu promises to delight even the most discerning palates. 
                            Whether you're craving a hearty. most discerning palates. 
                            Whether you're craving a hearty.
                        </p>
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel">
                        <p class="mb-0">
                            Etsy mixtape wayfarers, ethical wes anderson tofu before they
                            sold out mcsweeney's organic lomo retro fanny pack lo-fi
                            farm-to-table readymade. Messenger bag gentrify pitchfork
                            tattooed craft beer, iphone skateboard locavore carles etsy
                            salvia banksy hoodie helvetica. skateboard locavore carles etsy
                            salvia banksy hoodie helvetica.
                        </p>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

@endsection

@section('Custom_js')
    <script>
        var public = "{{ asset('') }}";    
        var uploadImageUrl = "{{ asset('assets/image-cards.png') }}";
    </script>
    <script src="{{asset('custom_js/Supplier/Supplier.js')}}"></script>
@endsection