@extends('Backoffice.Layout')
@section('custom_css')
    <style>
        .icon{
            width: 50px;
            height: 50px;
        }
        .icon:hover{
            color:#108dff;
            cursor: pointer;
        }
        .icons-active{
            color:#108dff;
        }
        .icons{
            cursor: pointer;
            width: 60px;
        }
    </style>
@endsection
@section('body')
     <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Category</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Category</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3">
                        <input type="text" id="filter_category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Filter  Category Name ">
                    </div>
                    <div class="col-9 text-end">
                        <button class="btn bg-success-subtle btnAdd" style="border-radius: 100px"><span class="mdi mdi-plus-thick"></span> New Category</button>
                    </div>
                </div>
                <table class="table mt-3" id="tableCategory">
                    <thead>
                        <tr>
                            <td>Category Name</td>
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
                       <label for="">Category Name*</label>
                       <input type="text" class="form-control fill" name="category_name" id="category_name" placeholder="Enter Category Name">
                       <label class="mt-3">Category icon*</label><br>
                       <small class="text-muted">*Please select at least one icon</small>
                       <div class="container-icon row mt-4" style="height: 300px;overflow-y:scroll;overflow-x:hidden">
                            @foreach ($featherIcon as $item)
                                 <div class="col-2  col-sm-2  col-md-2  col-lg-1 mb-4">
                                    <i data-feather="{{$item}}" class="icons {{$item}}" value="{{$item}}"></i>
                                </div>
                            @endforeach
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
    <script src="{{asset('custom_js/Product/iconName.js')}}"></script>
    <script src="{{asset('custom_js/Product/Category.js')}}"></script>
@endsection