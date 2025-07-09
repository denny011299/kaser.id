@extends('Backoffice.Layout')
@section('custom_css')
    <link href="{{asset('custom_css/Meja.css')}}" rel="stylesheet">
@endsection
@section('body')
    <div class="row" style="height:100vh">
        <div class="col-md-12" style="position: relative">
            <div id="map-container">
                <div id="map-inner">
                    
                </div>
            </div>
            <input type="text" name="" id="floor_name" id="floor_name" class="form-control" placeholder="Floor Name" value="{{$floor->fl_name}}">
             <button class="btn bg-primary-subtle  text-primary btn-add-meja rounded-pill"><span class="mdi mdi-card-plus-outline"></span></button>
        </div>
    </div>

    <div class="modal fade bs-example-modal-center show" id="modalInsert" tabindex="-1" role="dialog" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" id="modalInsert">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="mt-2">Table Name*</label>
                            <input type="text" name="" class="form-control" id="table_name" placeholder="Table Name...">
                        </div>
                        <div class="col-6">
                            <label for="" class="mt-2">Capacity*</label>
                            <input type="number" name=""  class="form-control"  id="capacity" value="2" min="2">
                        </div>
                    </div>
                    <div id="radio-cards-container">
                        <!-- Radio Card 1 -->
                        <div class="radio-card radio-card-1" onclick="selectRadioCard('1')">
                            <!-- Radio Card Check (tick) icon. By default, its hidden. Will be displayed when card gets clicked. -->
                            <div class="radio-card-check">
                                <i class="fa-solid fa-check-circle"></i>
                            </div>
                            <!-- Section to display the icon, label, and some additional text -->
                            <div class="text-center">
                                <div class="radio-card-icon">
                                    <img src="./images/icon-react.png" alt="React" />
                                </div>
                                <div class="radio-card-label">
                                    Horizontal Table
                                </div>
                                <div class="radio-card-label-description">
                                    Side-by-side layout, perfect for two people facing each other.
                                </div>
                            </div>
                        </div>
                        <!-- Radio Card 2 -->
                        <div class="radio-card radio-card-2 " onclick="selectRadioCard('2')">
                            <!-- Radio Card Check (tick) icon. By default, its hidden. Will be displayed when card gets clicked. -->
                            <div class="radio-card-check">
                                <i class="fa-solid fa-check-circle"></i>
                            </div>
                            <!-- Section to display the icon, label, and some additional text -->
                            <div class="text-center">
                                <div class="radio-card-icon">
                                    <img src="./images/icon-angular.png" alt="Angular" />
                                </div>
                                <div class="radio-card-label">
                                    Vertical Table
                                </div>
                                <div class="radio-card-label-description mt-0">
                                   Space-saving layout with top and bottom seating — ideal for hallways or tight areas.
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn-delete-meja">Delete Table</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
@endsection
@section('Custom_js')
    <script>
        $('.button-toggle-menu').click();
        var public = "{{ asset('') }}";
        var floor = @json($floor);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <script src="{{asset('custom_js/Setting/Meja.js')}}"></script>
@endsection