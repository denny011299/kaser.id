const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],
    [{ 'size': ['small', false, 'large', 'huge'] }],
    ['clean']
];
const quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: toolbarOptions
    },
});

$(document).ready(function() {
    // Receipt Form
    $('#r_name').val(data.company_name ? data.company_name : "");
    $('#r_phone_number').val(data.company_nomor ? data.company_nomor : ""); 
    $('#r_address').val(data.company_address ? data.company_address : ""); 
    $('#r_font_size').val(data.font_size ? data.font_size : "8").trigger("blur");
    $('#r_currency').val(data.currency ? data.currency : "IDR").trigger("change");
    $('#r_page_size').val(data.page_size ? data.page_size : "58").trigger("change");

    // Receipt Preview
    $('#rp_name').html(data.company_name ? data.company_name : "PT. -");
    $('#rp_phone_number').html(data.company_nomor ? data.company_nomor : "*Phone Number*"); 
    $('#rp_address').html(data.company_address ? data.company_address : "*Address*");
    $('#rp_customer_name').html(data.customer_name ? data.customer_name : "");
    $('#rp_footer').html(data.footer_text ? data.footer_text : "");
    $('#rp_logo').attr("src", data.company_logo ? public+data.company_logo : dummyLogo);
    $('#rp_customer_name').html(data.customer_name ? data.customer_name : "Budi")

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

    // Quill Preview
    quill.root.innerHTML = data.footer_text ? data.footer_text : "";
    update();

    // Pengambilan data untuk toggle
    if (data.visible_footer == '1'){
        $('#r_show_footer').attr('checked');
        quill.enable(true);
        $('#foot').show();
    }
    else{
        $('#r_show_footer').removeAttr('checked');
        quill.enable(false);
        $('#foot').hide();
    }

    if (data.visible_customer == '1'){
        $('#rp_customer_name').show();
        $('#r_customer_name').attr('checked');
    }
    else{
        $('#rp_customer_name').hide();
        $('#r_customer_name').removeAttr('checked');
    }

    if (data.visible_table == '1'){
        $('#rp_table_number').show();
        $('#r_table_number').attr('checked');
    }
    else{
        $('#rp_table_number').hide();
        $('#r_table_number').removeAttr('checked');
    }

    if (data.visible_cashier == '1'){
        $('#rp_cashier_name').show();
        $('#r_cashier_name').attr('checked');
    }
    else{
        $('#rp_cashier_name').hide();
        $('#r_cashier_name').removeAttr('checked');
    }

    if (data.visible_barcode == '1'){
        $('.barcode').show();
        $('#r_show_barcode').attr('checked');
    }
    else{
        $('.barcode').hide();
        $('#r_show_barcode').removeAttr('checked');
    }

    // Currency
    // 1. Simpan nilai asli harga dan format awal
    $('[data-price]').each(function() {
        const priceText = $(this).text().trim();
        const numericValue = priceText.replace(/[^0-9]/g, '');
        const currencySymbol = priceText.replace(/[0-9,.]/g, '').trim();
        
        $(this).data('original-price', numericValue);
        $(this).data('original-currency', currencySymbol);
    });

    // 2. Handler perubahan currency
    $('#r_currency').change(function() {
        const selectedCurrency = $(this).val();
        const currencySymbol = $(this).find('option:selected').data('symbol');
        
        updateAllPrices(selectedCurrency, currencySymbol);
    });

    // 3. Fungsi untuk update semua harga
    function updateAllPrices(currency, symbol) {
        $('[data-price]').each(function() {
            const originalPrice = $(this).data('original-price');
            const formattedPrice = formatCurrency(originalPrice, currency, symbol);
            $(this).text(formattedPrice);
        });
    }

    // 4. Fungsi format mata uang
    function formatCurrency(amount, currency, symbol) {
        // Konversi ke number
        const numberAmount = parseFloat(amount);
        
        // Format number dengan locale berbeda
        let formattedAmount;
        switch(currency) {
            case 'IDR':
                formattedAmount = numberAmount.toLocaleString('id-ID');
                break;
            case 'USD':
            case 'SGD':
            case 'AUD':
                formattedAmount = numberAmount.toLocaleString('en-US');
                break;
            case 'EUR':
                formattedAmount = numberAmount.toLocaleString('de-DE');
                break;
            case 'JPY':
                formattedAmount = numberAmount.toLocaleString('ja-JP');
                break;
            default:
                formattedAmount = numberAmount.toLocaleString();
        }
        
        // Format penempatan simbol
        
        switch(currency) {
            case 'EUR':
            case 'GBP':
                return `${formattedAmount} ${symbol ? symbol : "Rp"}`;
            default:
                return `${symbol ? symbol : "Rp"} ${formattedAmount}`;
        }
    }

    // 5. Trigger change awal
    $('#r_currency').trigger('change');
})

// Quill js
quill.on('selection-change', () => {
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'footer_text',
            'pengaturan_value': quill.root.innerHTML
        },
        success: function(e){
            update();
        },
        error: function(e){
            console.log(e);
        }
    });
});

// Update Quill
function update() {
    $('#rp_footer').html(quill.root.innerHTML)
}

// Toggle customer name
$(document).on("change", "#r_customer_name", function() {
    var cek = 0;
    if (this.checked){
        $('#rp_customer_name').show();
        $('#r_customer_name').attr('checked');
        cek = 1;
    }
    else{
        $('#rp_customer_name').hide();
        $('#r_customer_name').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'visible_customer',
            'pengaturan_value': cek
        },
        success: function(e){
            
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Table Number
$(document).on("change", "#r_table_number", function() {
    var cek = 0;
    if (this.checked){
        $('#rp_table_number').show();
        $('#r_table_number').attr('checked');
        cek = 1;
    }
    else{
        $('#rp_table_number').hide();
        $('#r_table_number').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'visible_table',
            'pengaturan_value': cek
        },
        success: function(e){
            
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Cashier Name
$(document).on("change", "#r_cashier_name", function() {
    var cek = 0;
    if (this.checked){
        $('#rp_cashier_name').show();
        $('#r_cashier_name').attr('checked');
        cek = 1;
    }
    else{
        $('#rp_cashier_name').hide();
        $('#r_cashier_name').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'visible_cashier',
            'pengaturan_value': cek
        },
        success: function(e){
            
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Show Barcode
$(document).on("change", "#r_show_barcode", function() {
    var cek = 0;
    if (this.checked){
        $('.barcode').show();
        $('#r_show_barcode').attr('checked');
        cek = 1;
    }
    else{
        $('.barcode').hide();
        $('#r_show_barcode').removeAttr('checked');
    }
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'visible_barcode',
            'pengaturan_value': cek
        },
        success: function(e){
            
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Toggle Show Footer
$(document).on("change", "#r_show_footer", function() {
    var cek = 0;
    if (this.checked){
        $('.foot').css('display', 'block');
        cek = 1;
    }
    else{
        $('.foot').css('display', 'none');
    }
    quill.enable(this.checked);
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'visible_footer',
            'pengaturan_value': cek
        },
        success: function(e){
            
        },
        error: function(e){
            console.log(e);
        }
    })
});

// Input Footer
$(document).on('blur', '#r_footer', function() {
    var footer = $(this).val();
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'footer_text',
            'pengaturan_value': footer
        },
        success: function(e){
            $('#rp_footer').html(footer)
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Input Company Name
$(document).on('blur', '#r_name', function() {
    var name = $(this).val();
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'company_name',
            'pengaturan_value': name
        },
        success: function(e){
            $('#rp_name').html(name)
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Input Company Phone Number
$(document).on('blur', '#r_phone_number', function() {
    var phone_number = $(this).val();
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'company_nomor',
            'pengaturan_value': phone_number
        },
        success: function(e){
            $('#rp_phone_number').html(phone_number)
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Input Company Address
$(document).on('blur', '#r_address', function() {
    var address = $(this).val();
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'company_address',
            'pengaturan_value': address
        },
        success: function(e){
            $('#rp_address').html(address)
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Input Font Size
$(document).on('blur', '#r_font_size', function() {
    var font_size = $(this).val();
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'font_size',
            'pengaturan_value': font_size
        },
        success: function(e){
            $("p, td, th").css("font-size", font_size + "pt")

            // Ukuran header preview
            $("#rp_logo").css({
                "width": font_size*6 + "pt",
                "height": font_size*6 + "pt"
            })
            $("#rp_name").css("font-size", font_size*1.8 + "pt")
            $("#rp_address, #rp_phone_number").css("font-size", font_size*1.2 + "pt")
        },
        error: function(e){
            console.log(e);
        }
    })
})

// Input Currency
$(document).on('change', '#r_currency', function() {
    var currency = $(this).val();
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'currency',
            'pengaturan_value': currency
        },
        success: function(e){

        },
        error: function(e){
            console.log(e);
        }
    });
})

// Input Page Size
$(document).on('change', '#r_page_size', function() {
    var page_size = $(this).val();
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            'pengaturan_nama': 'page_size',
            'pengaturan_value': page_size
        },
        success: function(e){
            $(".nota").css("width", page_size + "mm");
            // Barcode menjadi responsif
            JsBarcode("#barcode", "1234", {
                lineColor: "#000",
                width: page_size/16.5,
                height: page_size/1.7,
                displayValue: false
            });
        },
        error: function(e){
            console.log(e);
        }
    });
})

// Input Company Logo
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

    var logo = $('#input_file_img')[0].files[0];
    var oldFile = data.company_logo;

    const formData = new FormData();
    formData.append('pengaturan_nama', 'company_logo');
    formData.append('pengaturan_value', logo);
    formData.append('old_file', oldFile);
    $.ajax({
        url: '/admin/updatePengaturan',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(e){
            $('#rp_logo').attr("src",public+e[0]["filePath"]); 
        },
        error: function(e){
            console.log(e);
        }
    })
})