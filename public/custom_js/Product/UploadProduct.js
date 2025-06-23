autocompleteCategory("#c_id",null);
autocompleteUnit("#pu_id",null);
autocompleteProductVariant("#pv_id",null);
var variant = [];
var bulk = [];
var modePrice =1;

$(document).ready(function() {
    if(mode==2) {
        $('#pr_name').val(data.pr_name);
        $('#pr_sku').val(data.pr_sku); 
        $('#pr_exp').val(data.pr_exp); 
        $('#pr_berat').val(data.pr_berat); 
        $('#pr_stok').val(data.pr_stock); 
        $('#pr_alert_stok').val(data.pr_alert_stok); 
        $('#pr_deskripsi').val(data.pr_deskripsi); 
        $('#pr_barcode').val(data.pr_barcode); 
        $('.preview_gallery').attr("src",public+data.pr_img); 
        $('#pr_price').val(formatRupiah(data.pr_price+"")); 
        $('#c_id').append(`<option value="${data.c_id}">${data.c_name}</option>`);
        $('#pu_id').append(`<option value="${data.pu_id}">${data.pu_name}</option>`);


        if(data.list_variasi.length > 0) {
            $('#btn-aktifasi-variant').hide();
            $('#btn-deactivate-variant').show();
            $('.block-variant').show();

            data.list_variasi.forEach(item => {
                variant.push({
                    pvs_name: item.pvs_name,
                    pvs_stok: item.pvs_stok,
                    pvs_sku: item.pvs_sku,
                    pvs_id: item.pvs_id,
                    pv_id: item.pv_id,
                    pv_name: item.pv_name,
                });
                insertVariant();
            });
        }

        if(data.list_price.length > 0) {
            $('.btn-bulk').hide();
            $('#btn-deactivate-bulk').show();
            $('.block-bulk').show();

            data.list_price.forEach(item => {
                insertBulk(item.pvs_name);

                $('.row-bulk').last().find('#pp_from').val(item.pp_from);
                $('.row-bulk').last().find('#pp_to').val(item.pp_to);
                $('.row-bulk').last().find('#pp_price').val(item.pp_price);
            });
        }
        
    }
});

$(document).on("click", ".btn-add-variant", function() {
    var data = $('#pv_id').select2("data")[0];
    var attr = JSON.parse(data.pv_attribute);
    if(variant.length <= 0) {
        $('.container-variant').html("");
    }

    attr.forEach(item => {
        variant.push({
            "pvs_name":item,
            "pv_id": data.pv_id,
            "pv_name": data.pv_name,
            "pvs_stok": 0,
            "pvs_sku":0
        });
        insertVariant();
    });
    
    $('#pv_id').empty();
});

$(document).on("click", "#btn-deactivate", function() {
    $('#pv_id').empty();
    $('.container-variant').html('');
    $('#btn-aktifasi-variant').show();
    $('.block-variant').hide();
});

$(document).on("click", "#btn-aktifasi-variant", function() {
    $(this).hide();
    resetVariant();
    $('.block-variant').show();
});

$(document).on("click", ".btn_delete_row", function() {
    var idx = $(this).closest('.row-variant').index();
    variant.splice(idx, 1);
    $(this).closest('.row-variant').remove();
    if(variant.length <= 0) {
        resetVariant();
    }   
});

function insertVariant() {
    $('.container-variant').html("");
    variant.forEach((item) => {
        $('.container-variant').append(`
            <div class=" row row-variant p-3" >
                <div class="col-2">
                    <label for="">Variant Type</label>
                    <input type="text" class="form-control" name="" disbaled value="${item.pv_name}" id="pv_id" placeholder="">
                    <input type="hidden" class="form-control" name="" value="${item.pv_id}" id="pv_id" placeholder="">
                </div>
                <div class="col-3">
                    <label for="">Variant Name</label>
                    <input type="text" class="form-control" name="" value="${item.pvs_name}" id="pvs_name" placeholder="">
                </div>
                <div class="col-2">
                    <label for="">Variant Stock</label>
                    <input type="text" class="form-control number-only" name="" id="pvs_stok" value="${item.pvs_stok}" placeholder="">
                </div>
                <div class="col-2">
                    <label for="">Variant SKU</label>
                    <input type="text" class="form-control" name="" id="pvs_sku" placeholder="" value="${item.pvs_sku}">
                </div>
                <div class="col-2">
                    <label for=""></label>
                    <a aria-label="anchor" class="btn mt-3 bg-danger-subtle btn_delete_row" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                        <i class="mdi mdi-delete fs-16 text-danger"></i>
                    </a>
                </div>
                <input type="hidden" id="pvs_id" value="">
            </div>
        `);
    });
}

function resetVariant() {
    $('.container-variant').html(`
        <div class="text-center pt-5" style="color: #b8c7ea;font-size: 20pt;">
            <span class="mdi mdi-package-variant"></span>
            <label for="">No Variant</label>
        </div>
    `);
}

$(document).on("click", "#btn-deactivate-bulk", function() {
    resetBulk();
    $('.btn-bulk').show();
    $(this).hide();
    $('.block-bulk').hide();
});

$(document).on("click", ".btn-bulk", function() {
    $(this).hide();
   $('.container-bulk').html('');
    if(variant.length <= 0) {// if no variant, insert  bulk price for general product price
        modePrice=1;
        insertBulk();
    }
    else{
        modePrice=2;
        variant.forEach(item => {
            insertBulk();
        });
    }
    $('#btn-deactivate-bulk').show();
    $('.block-bulk').show();
});

$(document).on("click", ".btn_delete_row_bulk", function() {
    $(this).closest('.row-bulk').remove();
    if($('.row-bulk').length <= 0) {
        $('#btn-deactivate-bulk').click();
    }
});

$(document).on("click", ".btn_add_row_bulk", function() {
    insertBulk();
});

function insertBulk() {
   $('.container-bulk').append(`
        <div class=" row row-bulk p-3" >
            <div class="col-2">
                <label for="">From</label>
                <input type="text" class="form-control number-only" name="" id="pp_from" placeholder="">
            </div>
            <div class="col-2">
                <label for="">To</label>
                <input type="text" class="form-control number-only" name="" id="pp_to" placeholder="">
            </div>
            <div class="col-3">
                <label for="">Price</label>
                <div class="input-group">   
                    <span class="input-group-text">Rp.</span>
                    <input type="text" class="form-control nominal_only" name="" id="pp_price" placeholder="">
                </div>
            </div>
            <div class="col-3">
                <label for=""></label>
                <a aria-label="anchor" class="btn mt-3 bg-danger-subtle btn_delete_row_bulk" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                    <i class="mdi mdi-delete fs-16 text-danger"></i>
                </a>
                <a aria-label="anchor" class="btn mt-3 bg-success-subtle btn_add_row_bulk" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                    <i class="mdi mdi-tag-plus-outline fs-16 text-success"></i>
                </a>
            </div>
            <input type="hidden" id="pp_id" value="">
        </div>
    `);
    
}

function resetBulk() {
    $('.container-bulk').html(`
        <div class="text-center pt-5" style="color: #b8c7ea;font-size: 20pt;">
            <span class="mdi mdi-currency-usd-off"></span>
            <label for="">No Bulk Price</label>
        </div>
    `);
}


    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertProduct";
        var valid=1;
        bulk = [];

        $("#modalInsert .fill").each(function(){
            if($(this).val()==null||$(this).val()=="null"||$(this).val()==""){
                valid=-1;
                $(this).addClass('is-invalid');
            }
        });

        $(".row-bulk").each(function(){
            bulk.push({
                pp_from:$(this).find('#pp_from').val(),
                pp_to:$(this).find('#pp_to').val(),
                pp_price:$(this).find('#pp_price').val(),
                pp_id:$(this).find('#pp_id').val()
            });
        });

        if(valid==-1){
            notifikasi('error', "Gagal Insert", 'Silahkan cek kembali inputan anda');
            ResetLoadingButton('.btn-save', 'Save changes');
            return false;
        };

        param = {
            pr_name:$('#pr_name').val(),
            pr_sku:$('#pr_sku').val(),
            c_id:$('#c_id').val(),
            pr_exp:$('#pr_exp').val(),
            pr_berat:$('#pr_berat').val(),
            pu_id:$('#pu_id').val(),
            pr_stok:$('#pr_stok').val(),
            pr_price:convertToAngka($('#pr_price').val()),
            pr_alert_stok:$('#pr_alert_stok').val(),
            pr_deskripsi:$('#pr_deskripsi').val(),
            pr_barcode:$('#pr_barcode').val(),
            list_variant:JSON.stringify(variant),
            list_bulk_price:JSON.stringify(bulk),
            _token:token
        };

        if(mode==2){
            url="/admin/updateProduct";
            param.pr_id = data.pr_id;
        }

        //convert data -> form data
        const fd = new FormData();
        for (const [key, value] of Object.entries(param)) {
            fd.append(key, value);
        }
        fd.append('main', $('#input_file_img')[0].files[0]);
        
        LoadingButton($(this));
        $.ajax({
            url:url,
            data: fd,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            method:"post",
            headers: {
                'X-CSRF-TOKEN': token
            },
            success:function(e){      
                ResetLoadingButton(".btn-save", 'Save changes');      
                afterInsert();
            },
            error:function(e){
                ResetLoadingButton(".btn-save", 'Save changes');
                console.log(e);
            }
        });
    });

    $(document).on("change", ".input-gambar", function(){
        let reader = new FileReader();
        let inputElement = $(this);
        if($(this).hasClass('input-gallery')){
            $(this).closest('.row').clone().appendTo("#list-gallery");
        }
        
        reader.onload = function(e) {
            inputElement.prev().attr("src", e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    })
function afterInsert() {
        window.location.href = "/admin/product";
    }
