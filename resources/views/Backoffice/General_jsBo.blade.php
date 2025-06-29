<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
<script src="{{asset('assets/js/pages/analytics-dashboard.init.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.1.1/js/bootstrap5-toggle.jquery.min.js"></script>
<!-- Moment.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<!-- JS Barcode -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.12.1/dist/JsBarcode.all.min.js"></script>
<!-- Quill JS -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>


<script>
      feather.replace();
    function LoadingButton(id) {
        $(id).html(`
            <div class="text-center h-100">
                <div class="spinner-border" role="status">
                </div>
            </div>   
        `).attr("disabled", true);
    }

    function ResetLoadingButton(id, text = null) {
        $(id).html(`${text? text : 'Save Changes'}`).attr("disabled", false);
        console.log("success");
    }
    function notifikasi(simbol,title,deskripsi) {
        Swal.fire({
            icon: simbol,
            title:title,
            text: deskripsi,
        });
    }
    $('.btn-cancel').on("click",function(){
        closeModalDelete();
    })
        //munculin modal delete
    function showModalDelete(text, button_id) {
        //button id ini, id button ketika dikofrimasi delete
        $("#text-delete").html(text);
        $(".btn-konfirmasi").attr("id", button_id);
        $('#modalDelete').modal("show");
    }
      
    function closeModalDelete() {
        $('#modalDelete').modal("hide");
    }
    $(document).on("input", ".number-only", function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
        if ($(this).val()[0] === '0'&&$(this).val().length>1) {
            $(this).val($(this).val().substring(1));
        }
    })
    $(document).on("keyup", ".nominal_only", function() {
        $(this).val(formatRupiah(convertToAngka($(this).val())));
    });
    function formatRupiah(angka, prefix) {
        angka = angka.toString();
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
    }
    function convertToAngka(rupiah) {
        return parseInt(rupiah.replace(/,.*|[^0-9]/g, ""), 10);
    }

    function autocompleteLocation(id, modalParent = null) {
        //search country dan city
        $(id).select2({
            ajax: {
                url: "/autocompleteLocation",
                dataType: "json",
                type: "post",
                data: function data(params) {
                    return {
                        "keyword": params.term,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    };
                },
                processResults: function processResults(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item;
                        }),
                    };
                },
            },
            minimumInputLength: 3,
            language: {
                inputTooShort: function() {
                    return 'Please add up to 3 characters for accurate result';
                }
            },
            placeholder: "City Name",
            closeOnSelect: true,
            allowClear: true,
            theme: "bootstrap-5",
            width: "100%",
            dropdownParent: modalParent ? $(modalParent) : "",
        });
    }

    function autocompleteSupplier(id, modalParent = null,length=3) {
        //search country dan city
        $(id).select2({
            ajax: {
                url: "/autocompleteSupplier",
                dataType: "json",
                type: "post",
                data: function data(params) {
                    return {
                        "keyword": params.term,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    };
                },
                processResults: function processResults(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item;
                        }),
                    };
                },
            },
            minimumInputLength: length,
            language: {
                inputTooShort: function() {
                    return 'Please add up to 3 characters for accurate result';
                }
            },
            placeholder: "Supplier Name",
            closeOnSelect: true,
            allowClear: true,
            theme: "bootstrap-5",
            width: "100%",
            dropdownParent: modalParent ? $(modalParent) : "",
        });
    }
    
    function autocompleteCategory(id, modalParent = null) {
        //search country dan city
        $(id).select2({
            ajax: {
                url: "/autocompleteCategory",
                dataType: "json",
                type: "post",
                data: function data(params) {
                    return {
                        "keyword": params.term,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    };
                },
                processResults: function processResults(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item;
                        }),
                    };
                },
            },
            placeholder: "Category Name",
            closeOnSelect: true,
            allowClear: true,
            theme: "bootstrap-5",
            width: "100%",
            dropdownParent: modalParent ? $(modalParent) : "",
        });
    }

    function autocompleteUnit(id, modalParent = null) {
        //search country dan city
        $(id).select2({
            ajax: {
                url: "/autocompleteUnit",
                dataType: "json",
                type: "post",
                data: function data(params) {
                    return {
                        "keyword": params.term,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    };
                },
                processResults: function processResults(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item;
                        }),
                    };
                },
            },
            placeholder: "Unit Name",
            closeOnSelect: true,
            allowClear: true,
            theme: "bootstrap-5",
            width: "100%",
            dropdownParent: modalParent ? $(modalParent) : "",
        });
    }

    function autocompleteSupplies(id, modalParent = null) {
        //search country dan city
        $(id).select2({
            ajax: {
                url: "/autocompleteSupplies",
                dataType: "json",
                type: "post",
                data: function data(params) {
                    return {
                        "keyword": params.term,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    };
                },
                processResults: function processResults(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item;
                        }),
                    };
                },
            },
            placeholder: "Select Supplies",
            closeOnSelect: true,
            allowClear: true,
            theme: "bootstrap-5",
            width: "100%",
            dropdownParent: modalParent ? $(modalParent) : "",
        });
    }

    function autocompleteProduct(id, modalParent = null) {
        //search country dan city
        $(id).select2({
            ajax: {
                url: "/autocompleteProduct",
                dataType: "json",
                type: "post",
                data: function data(params) {
                    return {
                        "keyword": params.term,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    };
                },
                processResults: function processResults(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item;
                        }),
                    };
                },
            },
            placeholder: "Select Product",
            closeOnSelect: true,
            allowClear: true,
            theme: "bootstrap-5",
            width: "100%",
            dropdownParent: modalParent ? $(modalParent) : "",
        });
    }

    function autocompleteProductVariant(id, modalParent = null) {
        //search country dan city
        $(id).select2({
            ajax: {
                url: "/autocompleteProductVariant",
                dataType: "json",
                type: "post",
                data: function data(params) {
                    return {
                        "keyword": params.term,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    };
                },
                processResults: function processResults(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item;
                        }),
                    };
                },
            },
            placeholder: "Product Variant",
            closeOnSelect: true,
            allowClear: true,
            theme: "bootstrap-5",
            width: "100%",
            dropdownParent: modalParent ? $(modalParent) : "",
        });
    }

    function autocompleteCategoryStaff(id, modalParent = null,length=3) {
        //search country dan city
        $(id).select2({
            ajax: {
                url: "/autocompleteCategoryStaff",
                dataType: "json",
                type: "post",
                data: function data(params) {
                    return {
                        "keyword": params.term,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    };
                },
                processResults: function processResults(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item;
                        }),
                    };
                },
            },
            placeholder: "Staff Position",
            closeOnSelect: true,
            allowClear: true,
            theme: "bootstrap-5",
            width: "100%",
            dropdownParent: modalParent ? $(modalParent) : "",
        });
    }

    function autocompleteCustomer(id, modalParent = null) {
        //search country dan city
        $(id).select2({
            ajax: {
                url: "/autocompleteCustomer",
                dataType: "json",
                type: "post",
                data: function data(params) {
                    return {
                        "keyword": params.term,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    };
                },
                processResults: function processResults(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item;
                        }),
                    };
                },
            },
            placeholder: "Select Customer",
            closeOnSelect: true,
            allowClear: true,
            theme: "bootstrap-5",
            width: "100%",
            dropdownParent: modalParent ? $(modalParent) : "",
        });
    }

    function getCurrentDate(daysAfter = 0) {
        let local = new Date();
        local.setMinutes(local.getMinutes() - local.getTimezoneOffset());
        local.setDate(local.getDate() + daysAfter); // Add the specified number of days
        return local.toJSON().slice(0, 10);
    }

    function calculateAge(birthDateString) {
        console.log(birthDateString)
        const birthDate = new Date(birthDateString);
        const today = new Date();

        // Get days of each month
        const daysInMonth = [31, (today.getFullYear() % 4 === 0 ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        let years = today.getFullYear() - birthDate.getFullYear();
        let months = today.getMonth() - birthDate.getMonth();
        let days = today.getDate() - birthDate.getDate();

        // Handle negative days (borrow days from the month)
        if (days < 0) {
            months--;
            days += daysInMonth[(today.getMonth() - 1 + 12) % 12]; // Get last month days count
        }

        // Handle negative months (borrow months from the year)
        if (months < 0) {
            years--;
            months += 12;
        }

        return `${years} Tahun, ${months} Bulan, ${days} Hari`;
    }

</script>