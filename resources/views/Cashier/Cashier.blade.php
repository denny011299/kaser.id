@extends('Include.layout')

@section('custom_css')
    <style>
        .category{
            border-radius: 20px;
            border:1px solid #007bff;
        }
        /*
        .category{
            border-radius: 20px;
            border:1px solid #EF9F9F;
            background-color: #fcf1f1;
            font-weight: bold;
            color: #F47C7C;
            width: 100px;
        }*/
        .bg{
            background-color: #f7fcff;
        }
        .icon{
            background-color:  #c4c4c4;
            border-radius: 400px;
            width: 40px;
            height: 40px;
            text-align: center;
        }
        .icon-active{
            background-color:  #007bff;
            border-radius: 400px;
            width: 40px;
            height: 40px;
            text-align: center;
        }
         .box-category-active{
            border-radius: 15px;
            border:1px solid #007bff;
            color:#007bff;
            background-color: #fff;
            font-weight: bold;
            color: white;
            width:140px!important;
            cursor: pointer;
        }
         .box-category{
            border-radius: 15px;
            border:1px solid rgb(235, 235, 235);
            color:#a0a0a0;
            background-color: #ffffff;
            font-weight: bold;
            color: white;
            width:140px!important;
            cursor: pointer;
        }
        .badge-default{
            border:1px solid #007bff;
            color:#007bff;
        }
        .text-default-active{
            color:#007bff;
        }
        .text-default{
            color:#a0a0a0;
        }
    </style>    
@endsection

@section('body')
    
    <div class="row">
        <div class="col-9 bg pe-0">
            @include('Include.Navbar')
            <div class="swiper mySwiper mt-4 px-5">
                <div class="swiper-wrapper ">
                    @for ($i = 0; $i < 10; $i++)
                         <!-- Slide 1 -->
                         {{-- 
                        <div class="swiper-slide">
                            <div class="category p-2 text-center py-3">
                                <i class="bi bi-fork-knife mx-auto" style="font-size:18pt"></i>
                                <p class="my-0" style="font-size:10pt">All Food</p>
                            </div>
                        </div>--}}
                        <div class="swiper-slide">
                            <div class="{{$i==0?'box-category-active':"box-category"}} p-3 ps-2 pt-2 pb-1 me-2"> 
                                <div class=" pt-2 {{$i==0?'icon-active':"icon"}}"><i class="bi bi-fork-knife mx-auto" style="font-size:12pt"></i></div>
                                <p class="mb-0 mt-4 {{$i==0?'text-default-active':"text-default"}}" style="font-size:10pt;">All Food</p>
                                <p class="text-muted" style="font-size: 9pt;">3 Items</p>
                            </div>
                        </div>
                    @endfor 
                </div>
            </div>
            <div class="px-5 container-item">
                <div class="row mt-4" style="overflow-y: auto;height:65vh">
                    @for ($i = 0; $i < 20; $i++)
                        <div class="col-3 mb-4">
                            <div class="card " style="cursor: pointer;">
                                <img src="{{asset('assets/food-1.jpg')}}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title mb-0" style="font-size:13pt">Buttermelt Croissant</h5>
                                    <div class="row ">
                                        <div class="col-4 pt-1">
                                            <div class="badge bg-primary" style="border-radius: 100px">Bakery</div>
                                            
                                        </div>
                                        <div class="col-8 text-end pt-1">
                                            <h6 style="font-size:12pt">Rp. 5.000 <span class="text-muted" style="font-size: 9pt">/ Pcs</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    @endfor 
                </div>
            </div>
        </div>
        <div class="col-3 p-4 px-4">
            <div class="row">
                <div class="col-6">
                    <h5 class="text-default"><b>Bill Details</b></h5>
                </div>
                <div class="col-6">
                    <h6 class="text-muted text-end">#2314</h6>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection

@section('custom_js')
    <script src="{{asset('custom_js/Cashier.js')}}"></script>
@endsection