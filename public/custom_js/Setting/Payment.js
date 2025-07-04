var list_tax = [];
var idx_delete = 0;

$(document).ready(function() {
    // Receipt Preview
    $('#rp_name').html(data.company_name ? data.company_name : "PT. -");
    $('#rp_phone_number').html(data.company_nomor ? data.company_nomor : "*Phone Number*"); 
    $('#rp_address').html(data.company_address ? data.company_address : "*Address*");
    $('#rp_customer_name').html(data.customer_name ? data.customer_name : "Budi")
    $('#rp_footer').html(data.footer_text ? data.footer_text : "");
    $('#rp_logo').attr("src", data.company_logo ? public+data.company_logo : dummyLogo);

    // Ukuran font & page preview
    $("p, td, th").css("font-size", data.font_size ? data.font_size + "pt" : "8pt")
    $(".nota").css("width", data.page_size ? data.page_size + "mm" : "58mm");

    // Ukuran header preview
    $("#rp_logo").css({
        "width": data.font_size ? data.font_size*6 + "pt" : "48pt",
        "height": data.font_size ? data.font_size*6 + "pt" : "48pt"
    })
    $("#rp_name").css("font-size", data.font_size ? data.font_size*1.8 + "pt" : "14.4pt")
    $("#rp_address, #rp_phone_number").css("font-size", data.font_size ? data.font_size*1.2 + "pt" : "9.6pt")

    // Barcode Preview
    JsBarcode("#barcode", "1234", {
        lineColor: "#000",
        width: data.page_size ? data.page_size / 16.5 : 3.5,
        height: data.page_size ? data.page_size/1.7 : 34.1,
        displayValue: false
    });
    $('#rp_footer').html(data.footer_text ? data.footer_text : "")

    getTax();

    // Toggle payment method
    if (!data.payment_qris) $('#pm_qris').prop('checked', false).trigger('change');
    else if (data.payment_qris == '1') $('#pm_qris').prop('checked', true);
    else $('#pm_qris').prop('checked', false);

    if (!data.payment_card) $('#pm_card').prop('checked', false).trigger('change');
    else if (data.payment_card == '1') $('#pm_card').prop('checked', true);
    else $('#pm_card').prop('checked', false);

    if (!data.payment_transfer) $('#pm_transfer').prop('checked', false).trigger('change');
    else if (data.payment_transfer == '1') $('#pm_transfer').prop('checked', true);
    else $('#pm_transfer').prop('checked', false);

    if (!data.payment_cash) $('#pm_cash').prop('checked', true).trigger('change');
    else if (data.payment_cash == '1') $('#pm_cash').prop('checked', true);
    else $('#pm_cash').prop('checked', false);

    // Toggle order method
    if (!data.order_online) $('#om_online').prop('checked', false).trigger('change');
    else if (data.order_online == '1') $('#om_online').prop('checked', true);
    else $('#om_online').prop('checked', false);

    if (!data.order_dine_in) $('#om_dine_in').prop('checked', false).trigger('change');
    else if (data.order_dine_in == '1') $('#om_dine_in').prop('checked', true);
    else $('#om_dine_in').prop('checked', false);

    if (!data.order_unpaid_bill) $('#om_unpaid_bill').prop('checked', false).trigger('change');
    else if (data.order_unpaid_bill == '1') $('#om_unpaid_bill').prop('checked', true);
    else $('#om_unpaid_bill').prop('checked', false);
    
    if (!data.order_take_away) $('#om_take_away').prop('checked', false).trigger('change');
    else if (data.order_take_away == '1') $('#om_take_away').prop('checked', true);
    else $('#om_take_away').prop('checked', false);
})

$(document).on('click','.btn-add-variant',function(){
    mode=1;
    $('#modalInsert input').val("");
    $('#modalInsert .modal-title').html("Add New Tax");
    $('.is-invalid').removeClass('is-invalid');
    $('#modalInsert').modal("show");
})
function refreshTax() {
    $('#tax-container').html("");
    $('#preview_tax').html("");
    var total = convertToAngka($('#total').html());
    var grandTotal = total;
    list_tax.forEach((item,index) => {
        $('#tax-container').append(`
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex">
                            <div class="col-7">${item.tx_name}&nbsp;-&nbsp;${item.tx_percent}%</div>
                            <div class="form-check form-switch text-end col-2">
                                <input class="form-check-input activeTax" type="checkbox" role="switch" index="${index}" ${item.status==2?"checked":""}>
                            </div>
                            <div class="col-3 justify-content-end pe-3" style="margin-top: -3px">
                                <span class="mdi mdi-close-circle-outline btn_delete" index="${index}" style="font-size: 14pt"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        `)

        if(item.status==2){
            var temp = total* item.tx_percent/100;
            console.log(total);
            
            $('#preview_tax').append(`
                <div class="d-flex  justify-content-between">
                    <p>${item.tx_name} ${item.tx_percent}%</p>
                    <p>${formatRupiah(temp,"Rp ")}</p>
                </div>
            `)
            $('#preview_tax').css("font-size", data.font_size ? data.font_size + "pt" : "14.4pt")
            grandTotal += temp;
        }
    });
    $('#grand').html(formatRupiah(grandTotal,"Rp "));
    $('#change').html(formatRupiah((100000-grandTotal),"Rp "))
}

// Change active / inactive tax
$(document).on("click", '.activeTax', function(){
    var idx = $(this).attr("index");
    var data1 = list_tax[idx];
    var active = 1;
    if($(this).is(":checked")) active=2;

     $.ajax({
        url: '/admin/toggleActiveTax',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'tx_id': data1.tx_id,
            'status': active
        },
        success: function(e){
            getTax();
            toastr.success("Berhasil mengubah pajak!", "Sukses");
        },
        error: function(e){
            console.log(e);
        }
    })
});

// Insert Tax
$(document).on("click", '.btn-save', function(){
    var name = $('#tx_name').val();
    var percent = $('#tx_percent').val();

    $.ajax({
        url: '/admin/insertTax',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'tx_name': name,
            'tx_percent': percent
        },
        success: function(e){
            $('.modal').modal("hide");
            getTax();
            notifikasi('success', "Berhasil Insert", "Berhasil menambah Tax");
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Delete Tax
$(document).on("click", '.btn_delete', function(){
    idx_delete = $(this).attr("index");
    showModalDelete("Apakah yakin ingin menghapus pajak ini?","btn-delete-tax");
})
$(document).on("click", '#btn-delete-tax', function(){
    var data1 = list_tax[idx_delete];
    $.ajax({
        url: '/admin/toggleActiveTax',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'tx_id': data1.tx_id,
            'status': 0
        },
        success: function(e){
            $('.modal').modal("hide");
            getTax();
            notifikasi('success', "Berhasil Delete", "Berhasil delete Tax");
        },
        error: function(e){
            console.log(e);
        }
    })
    idx_delete = 0;
})



function getTax() {
    $.ajax({
        url: '/admin/getTax',
        method: 'get',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(e){
            list_tax = JSON.parse(e);
            refreshTax();
            console.log(e);
        },
        error: function(e){
            console.log(e);
        }
    })
}

// Toggle Payment QRIS
$(document).on("change", "#pm_qris", function() {
    var cek = 0;
    if (this.checked){
        $('#pm_qris').attr('checked');
        cek = 1;
    }
    else{
        $('#pm_qris').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'payment_qris',
            'pengaturan_value': cek
        },
        success: function(e){
            toastr.success("Berhasil mengubah metode bayar!", "Sukses");
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Payment Credit Card
$(document).on("change", "#pm_card", function() {
    var cek = 0;
    if (this.checked){
        $('#pm_card').attr('checked');
        cek = 1;
    }
    else{
        $('#pm_card').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'payment_card',
            'pengaturan_value': cek
        },
        success: function(e){
            toastr.success("Berhasil mengubah metode bayar!", "Sukses");
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Payment Transfer
$(document).on("change", "#pm_transfer", function() {
    var cek = 0;
    if (this.checked){
        $('#pm_transfer').attr('checked');
        cek = 1;
    }
    else{
        $('#pm_transfer').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'payment_transfer',
            'pengaturan_value': cek
        },
        success: function(e){
            toastr.success("Berhasil mengubah metode bayar!", "Sukses");
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Payment Cash
$(document).on("change", "#pm_cash", function() {
    var cek = 0;
    if (this.checked){
        $('#pm_cash').attr('checked');
        cek = 1;
    }
    else{
        $('#pm_cash').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'payment_cash',
            'pengaturan_value': cek
        },
        success: function(e){
            toastr.success("Berhasil mengubah metode bayar!", "Sukses");
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Order Online
$(document).on("change", "#om_online", function() {
    var cek = 0;
    if (this.checked){
        $('#om_online').attr('checked');
        cek = 1;
    }
    else{
        $('#om_online').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'order_online',
            'pengaturan_value': cek
        },
        success: function(e){
            toastr.success("Berhasil mengubah metode order!", "Sukses");
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Order Dine-In
$(document).on("change", "#om_dine_in", function() {
    var cek = 0;
    if (this.checked){
        $('#om_dine_in').attr('checked');
        cek = 1;
    }
    else{
        $('#om_dine_in').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'order_dine_in',
            'pengaturan_value': cek
        },
        success: function(e){
            toastr.success("Berhasil mengubah metode order!", "Sukses");
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Order Unpaid Bill
$(document).on("change", "#om_unpaid_bill", function() {
    var cek = 0;
    if (this.checked){
        $('#om_unpaid_bill').attr('checked');
        cek = 1;
    }
    else{
        $('#om_unpaid_bill').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'order_unpaid_bill',
            'pengaturan_value': cek
        },
        success: function(e){
            toastr.success("Berhasil mengubah metode order!", "Sukses");
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Order Take-Away
$(document).on("change", "#om_take_away", function() {
    var cek = 0;
    if (this.checked){
        $('#om_take_away').attr('checked');
        cek = 1;
    }
    else{
        $('#om_take_away').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'order_take_away',
            'pengaturan_value': cek
        },
        success: function(e){
            toastr.success("Berhasil mengubah metode order!", "Sukses");
        },
        error: function(e){
            console.log(e);
        }
    })
})