var mode=1;//1 = auto scan, 2 = manual input
var type= 1;//1 = all, 2 = In, 3 = Out
afterInsert();
$('#input_barcode').trigger("focus");
$('#filter_start_date').val(getCurrentDate(-1));
$('#filter_end_date').val(getCurrentDate());

$(document).on("click",".btn_scan",function(){
    mode= $(this).attr("mode");
    $('#input_barcode').val("");
    $('#input_qty').val("1");
    $('#input_barcode').trigger("focus");
});
$(document).on("change","#filter_start_date,#filter_end_date",function(){
    afterInsert();
});
$(document).on("click",".btn_scan",function(){
    mode= $(this).attr("mode");
    $('#input_barcode').val("");
    $('#input_qty').val("1");
    $('#input_barcode').trigger("focus");
});

$(document).on("click",".nav-jenis",function(){
    type= $(this).attr("tipe");
    afterInsert();
});

$('#input_barcode').on('keyup', function(e) {
    if (e.which === 13) { // 13 = Enter
        const barcode = $(this).val();
        console.log("Barcode:", barcode);
        if(mode==1){
            // Auto scan mode
            insertData(barcode);
            $(this).val(""); // reset input
        }
        else{
            $('#input_qty').focus().select();
        }
    } 
});

$('#input_qty').on('keyup', function(e) {
    if (e.which === 13) { // 13 = Enter
        const barcode = $(this).val();
        insertData(barcode);
        $('#input_barcode').val("");
        $('#input_qty').val("1");
        $('#input_barcode').trigger("focus");
    } 
});

function insertData() {
    LoadingButton(this);
    $('.is-invalid').removeClass('is-invalid');
    var url ="/admin/insertManageSupplies";
    var valid=1;

    $("#modalInsert .fill").each(function(){
        if($(this).val()==null||$(this).val()=="null"||$(this).val()==""){
            valid=-1;
            $(this).addClass('is-invalid');
        }
    });

    if(valid==-1){
        notifikasi('error', "Gagal Insert", 'Silahkan cek kembali inputan anda');
        ResetLoadingButton('.btn-save', 'Save changes');
        return false;
    };

    param = {
        ms_type:$('#input-type').val(),//1 = In , 2 = Out
        barcode:$('#input_barcode').val(),
        ms_stock:$('#input_qty').val(),
        jenis_insert:1,//1 = Product , 2 = supplies
         _token:token
    };

    LoadingButton($(this));
    
    $.ajax({
        url:url,
        data: param,
        method:"post",
        headers: {
            'X-CSRF-TOKEN': token
        },
        success:function(e){      
            if($('#input-type').val()==1){
                toastr.success('', 'Successfully Added Incoming Item');
            }
            else{
                toastr.success('', 'Successfully Added Outgoing Item');
                
            }
            afterInsert();
        },
        error:function(e){
            console.log(e);
        }
    });
}

function getIn() {
    $("#tableSuppliesIn").dataTable({
        dom: 'Bfrtip',
        serverSide: false,
        destroy: true,
        deferLoading: 10,
        deferRender: true,
        processing: true,
        ajax: {
            url: "/admin/getManageSupplies",
            type: "get",
            data:{
                ms_type:1
            },
            dataSrc: function (json) {
                for (var i = 0; i < json.length; i++) {
                    
                    json[i].action=`
                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                        </a>
                    `;
                }
                data = json;
                return json;
            },
            error: function (e) {
                console.log(e.responseText);
            },
        },
        initComplete: (settings, json) => {
        },
        columns: [
            { data: "sup_sku", className: "text-start"},
            { data: "sup_name", className: "text-start"},
            { data: "ms_stock", className: "text-start"},
        ],
        searching: false,
        displayLength: 10,
        responsive: true,
        ordering: true,
        scrollX: false,
        scrollY: true,
        rowCallback: function (row, data, index) {
            $(row).find('td').addClass('align-middle');
        }
    });
    let table1 = $("#tableSuppliesIn").DataTable();
    table1.one("draw", function () {
        table1.columns.adjust();
    }).ajax.reload();
}


function getOut() {
    $("#tableSuppliesOut").dataTable({
        dom: 'Bfrtip',
        serverSide: false,
        destroy: true,
        deferLoading: 10,
        deferRender: true,
        processing: true,
        ajax: {
            url: "/admin/getManageSupplies",
            type: "get",
            data:{
                ms_type:2
            },
            dataSrc: function (json) {
                for (var i = 0; i < json.length; i++) {
                    
                    json[i].action=`
                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                        </a>
                    `;
                }
                data = json;
                return json;
            },
            error: function (e) {
                console.log(e.responseText);
            },
        },
        initComplete: (settings, json) => {
        },
        columns: [
            { data: "sup_sku", className: "text-start"},
            { data: "sup_name", className: "text-start"},
            { data: "ms_stock", className: "text-start"},
        ],
        searching: false,
        displayLength: 10,
        responsive: true,
        ordering: true,
        scrollX: false,
        scrollY: true,
        rowCallback: function (row, data, index) {
            $(row).find('td').addClass('align-middle');
        }
    });
    let table1 = $("#tableSuppliesOut").DataTable();
    table1.one("draw", function () {
        table1.columns.adjust();
    }).ajax.reload();
}

function getAll() {
    $("#tableSuppliesAll").dataTable({
        dom: 'Bfrtip',
        serverSide: false,
        destroy: true,
        deferLoading: 10,
        deferRender: true,
        processing: true,
        ajax: {
            url: "/admin/getManageSupplies",
            type: "get",
            data:{
                all:"1",
                "ms_start_date":$('#filter_start_date').val(),
                "ms_end_date":$('#filter_end_date').val(),
            },
            dataSrc: function (json) {
                for (var i = 0; i < json.length; i++) {
                    
                    json[i].action=`
                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                        </a>
                    `;
                }
                data = json;
                return json;
            },
            error: function (e) {
                console.log(e.responseText);
            },
        },
        initComplete: (settings, json) => {
        },
        columns: [
            { data: "sup_sku", className: "text-start"},
            { data: "sup_name", className: "text-start"},
            { data: "sup_in", className: "text-center"},
            { data: "sup_out", className: "text-center"},
        ],
        searching: false,
        displayLength: 10,
        responsive: true,
        ordering: true,
        scrollX: false,
        scrollY: true,
        rowCallback: function (row, data, index) {
            $(row).find('td').addClass('align-middle');
        }
    });
    let table1 = $("#tableSuppliesAll").DataTable();
    table1.one("draw", function () {
        table1.columns.adjust();
    }).ajax.reload();
}


function afterInsert() {
    if(type==1){
        getAll();
    }else if(type==2){
        getIn();
    }else{
        getOut();
    }
}