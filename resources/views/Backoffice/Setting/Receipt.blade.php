@extends('Backoffice.Layout')
@section('custom_css')
    <style>
        .logo{
            height: 10vh;
            width: 10vh;
        }
        hr{
            margin: 1vh 0;
        }
        h4, h6, p{
            margin: 0;
        }
        .body>table{
            border-collapse: separate;
        }
        .menu>td {
            padding-bottom: 1vh;
        }
    </style>
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Receipt</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>
                    <li class="breadcrumb-item active">Receipt</li>
                </ol>
            </div>
        </div>
        <div class="row px-3">
            <div class="card col-5">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Company Logo</label>
                            <label class="float-start cursor mt-2 text-left">
                                <img src="{{ asset('assets/image-cards.png') }}" class="preview_gallery" style="width: 80%">
                                <input type="file" accept="image/png, image/jpeg"  name="file" id="input_file_img" class="input-gambar input-gallery" hidden>
                                <input type="hidden" class="gallery_id" id="gallery_id">
                            </label>
                        </div>
                        <div class="col-8"></div>
                    </div>
                    <div class="mt-3">
                        <label for="">Company Name</label>
                        <input type="text" id="r_name" class="form-control" placeholder="Company Name">
                    </div>
                    <div class="mt-3">
                        <label for="">Company Address</label>
                        <input type="text" id="r_address" class="form-control" placeholder="Company Address">
                    </div>
                    <div class="mt-3">
                        <label for="">Company Phone Number</label>
                        <input type="text" id="r_phone_number" class="form-control number-only" placeholder="Company Phone Number">
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="mt-3">
                                <label for="">Font Size</label>
                                <input type="text" class="form-control number-only" id="r_font_size" placeholder="Ex 12">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="mt-3">
                                <label for="">Currency</label>
                                <select name="" id="r_currency" class="form-select">
                                    <option value="IDR" data-symbol="Rp">IDR - Indonesian Rupiah</option>
                                    <option value="USD" data-symbol="$">USD - US Dollar</option>
                                    <option value="EUR" data-symbol="€">EUR - Euro</option>
                                    <option value="JPY" data-symbol="¥">JPY - Japanese Yen</option>
                                    <option value="SGD" data-symbol="S$">SGD - Singapore Dollar</option>
                                    <option value="MYR" data-symbol="RM">MYR - Malaysian Ringgit</option>
                                    <option value="AUD" data-symbol="A$">AUD - Australian Dollar</option>
                                    <option value="CNY" data-symbol="¥">CNY - Chinese Yuan</option>
                                    <option value="HKD" data-symbol="HK$">HKD - Hong Kong Dollar</option>
                                    <option value="GBP" data-symbol="£">GBP - British Pound</option>
                                    <option value="KRW" data-symbol="₩">KRW - South Korean Won</option>
                                    <option value="THB" data-symbol="฿">THB - Thai Baht</option>
                                    <option value="INR" data-symbol="₹">INR - Indian Rupee</option>
                                    <option value="PHP" data-symbol="₱">PHP - Philippine Peso</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex">
                            <label for="">Footer</label>
                            <div class="form-check form-switch ms-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="r_show_footer" checked>
                            </div>
                        </div>
                        <div id="editor" style="height: 20vh"></div>
                    </div>
                    <div class="mt-3 ms-1 row">
                        <div class="col-6 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="r_customer_name" checked>
                            <label class="form-check-label" for="">Customer Name</label>
                        </div>
                        <div class="col-6 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="r_table_number" checked>
                            <label class="form-check-label" for="">Table Number</label>
                        </div>
                    </div>
                    <div class="mt-3 ms-1 row">
                        <div class="col-6 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="r_cashier_name" checked>
                            <label class="form-check-label" for="">Cashier Name</label>
                        </div>
                        <div class="col-6 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="r_show_barcode" checked>
                            <label class="form-check-label" for="">Show Barcode</label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="">Page Size</label>
                        <select name="" id="r_page_size" class="form-select">
                            <option value="44">44 mm</option>
                            <option value="58">58 mm</option>
                            <option value="76">76 mm</option>
                            <option value="80">80 mm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card col-6 offset-1" style="width: fit-content; height: fit-content">
                <div class="card-body">
                    <label for="">Preview</label>
                    <div class="container px-4 py-2">
                        <div class="text-center nota">
                            <div class="header">
                                <img id="rp_logo" class="logo mb-2" src="{{ asset('upload/setting/logo-dummy.jpg') }}" alt="">
                                <h4 id="rp_name"></h4>
                                <h6 id="rp_address"></h6>
                                <h6 id="rp_phone_number" class="mb-2"></h6>
                            </div>
                            <hr>
                            <div class="detail row" style="text-align: left">
                                <div class="col-6">
                                    <table>
                                        <tr>
                                            <td>Inv No</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>INV0001</td>
                                        </tr>
                                        <tr>
                                            <td>Customer</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td><p><span id="rp_customer_name"></span></p></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6 text-left">
                                    <table>
                                        <tr id="rp_table_number">
                                            <td>Table</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td><p>01</p></td>
                                        </tr>
                                        <tr id="rp_cashier_name">
                                            <td>Cashier</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>Indah</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="body">
                                <table class="w-100">
                                    <tr>
                                        <th style="text-align: left">ITEM</th>
                                        <th>QTY</th>
                                        <th style="text-align: right">PRICE</th>
                                        <th style="text-align: right">AMOUNT</th>
                                    </tr>
                                    <tr class="menu">
                                        <td style="text-align: left">Nasi Goreng</td>
                                        <td>1</td>
                                        <td style="text-align: right" data-price>Rp 20.000</td>
                                        <td style="text-align: right" data-price>Rp 20.000</td>
                                    </tr>
                                    <tr class="menu">
                                        <td style="text-align: left">Mie Goreng</td>
                                        <td>2</td>
                                        <td style="text-align: right" data-price>Rp 22.000</td>
                                        <td style="text-align: right" data-price>Rp 44.000</td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <div class="total">
                                <div class="d-flex justify-content-between">
                                    <p>TOTAL AMOUNT</p>
                                    <p data-price>Rp 64.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>TAX 10%</p>
                                    <p data-price>Rp 6.400</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw-bold">GRAND TOTAL</p>
                                    <p data-price class="fw-bold">Rp 70.400</p>
                                </div>
                            </div>
                            <hr>
                            <div class="payment">
                                <div class="d-flex justify-content-between">
                                    <p>CASH</p>
                                    <p data-price>Rp 100.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>CHANGE</p>
                                    <p data-price>Rp 29.600</p>
                                </div>
                            </div>
                            <hr>
                            <div class="foot">
                                <p id="rp_footer"></p>
                            </div>
                            <div class="barcode text-center">
                                <svg id="barcode">
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection

@section('Custom_js')
    <script>
        var public = "{{ asset('') }}";
        var data=@json($data);
        var dummyLogo = "{{ asset('upload/setting/logo-dummy.jpg') }}";
    </script>
    <script src="{{asset('custom_js/Setting/Receipt.js')}}"></script>
@endsection