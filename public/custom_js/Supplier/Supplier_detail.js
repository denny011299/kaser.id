    refreshProduct();
    autocompleteProduct('#pr_id','#modalInsert');
    autocompleteSupplies('#sup_id','#modalInsertSupplies');
    var mode=1;

    $(document).on("click",".menu",function(){
        console.log();
        var menu = $(this).attr("menu");
        if(menu==1) refreshProduct();
        else if(menu==2) refreshSupplies();
        else if(menu==3) refreshPurchaseOrder();
        else if(menu==4) refreshPoInvoice();
    }); 

    function refreshProduct() {
        $("#tableProduct").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getSupplierPrice",
                type: "get",
                data:{
                    sp_id:sp_id,
                     type:1
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].pr_name_text = `<img src="${public+json[i].pr_img}" class="me-2" style="width:30px">`+json[i].pr_name;
                        json[i].spr_price_text = formatRupiah(json[i].spr_price+"","Rp.");
                        json[i].action=`
                            
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit_product" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete_product" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                            </a>
                        `;
                    }
                    return json;
                },
                error: function (e) {
                    console.log(e.responseText);
                },
            },
            initComplete: (settings, json) => {
            },
            columns: [
                { data: "pr_sku", className: "text-start"},
                { data: "pr_name_text", className: "text-start"},
                { data: "c_name", className: "text-center"},
                { data: "spr_price_text", className: "text-end"},
                { data: "action", className: "text-center"},
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
        let table1 = $("#tableProduct").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }
    function refreshSupplies() {
        $("#tableSupplies").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getSupplierPrice",
                type: "get",
                data:{
                    sp_id:sp_id,
                    type:2
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].spr_price_text = formatRupiah(json[i].spr_price+"","Rp.");
                        json[i].action=`
                            
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit_supplies" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete_supplies" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                            </a>
                        `;
                    }
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
                { data: "spr_price_text", className: "text-end"},
                { data: "action", className: "text-center"},
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
        let table1 = $("#tableSupplies").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-add-product",function(){
        $('#modalInsert input').val("");
        $('#modalInsert #pr_id').empty();
        $('#modalInsert').modal("show");
    });
    

    $(document).on("click",".btn-add-supplies",function(){
        $('#modalInsertSupplies input').val("");
        $('#modalInsertSupplies #sup_id').empty();
        $('#modalInsertSupplies').modal("show");
    });

    //edit product
    $(document).on("click",".btn_edit_product",function(){
        var data = $('#tableProduct').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsert .modal-title').html("Edit Product");
        $('#modalInsert input').empty().val("");
        $('#modalInsert #pr_id').empty().val("");
        $('#spr_price').val(formatRupiah(data.spr_price));
        $('#pr_id').append(`<option value="${data.pr_id}">${data.pr_name}</option>`);
        console.log(data);
        
        $('#modalInsertSupplies').modal("show");
        $('#modalInsertSupplies').attr("spr_id", data.spr_id);
    });

    //edit product
    $(document).on("click",".btn_edit_supplies",function(){
        var data = $('#tableSupplies').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsertSupplies .modal-title').html("Edit Supply");
        $('#modalInsertSupplies input').empty().val("");
        $('#modalInsertSupplies #sup_id').empty().val("");
        $('#spr_price').val(formatRupiah(data.spr_price));
        $('#sup_id').append(`<option value="${data.sup_id}">${data.sup_name}</option>`);
        console.log(data);
        
        $('#modalInsertSupplies').modal("show");
        $('#modalInsertSupplies').attr("spr_id", data.spr_id);
    });

    //insert product
    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertSupplierPrice";
        var valid=1;
        
        $("#modalInsert .fillProduct").each(function(){
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
            sp_id:sp_id,
            pr_id:$('#pr_id').val(),
            spr_price:convertToAngka($('#spr_price').val()),
            _token:token
        };

        if(mode==2){
            url="/admin/updateSupplierPrice";
            param.spr_id = $('#modalInsert').attr("spr_id");
        }

        LoadingButton($(this));
        $.ajax({
            url:url,
            data: param,
            method:"post",
            headers: {
                'X-CSRF-TOKEN': token
            },
            success:function(e){      
                ResetLoadingButton(".btn-save", 'Save changes');      
                afterInsertSupplies();
            },
            error:function(e){
                ResetLoadingButton(".btn-save", 'Save changes');
                console.log(e);
            }
        });
    });
    //insert Supplies
    $(document).on("click",".btn-save-supplies",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertSupplierPrice";
        var valid=1;
        
        $("#modalInsertSupplies .fill").each(function(){
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
            sp_id:sp_id,
            sup_id:$('#sup_id').val(),
            spr_price:convertToAngka($('#spr_price').val()),
            _token:token
        };

        if(mode==2){
            url="/admin/updateSupplierPrice";
            param.spr_id = $('#modalInsertSupplies').attr("spr_id");
        }

        LoadingButton($(this));
        $.ajax({
            url:url,
            data: param,
            method:"post",
            headers: {
                'X-CSRF-TOKEN': token
            },
            success:function(e){      
                ResetLoadingButton(".btn-save", 'Save changes');      
                afterInsertProduct();
            },
            error:function(e){
                ResetLoadingButton(".btn-save", 'Save changes');
                console.log(e);
            }
        });
    });
    function afterInsertProduct() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Harga Product");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Harga Product");
        refreshProduct();
    }
    function afterInsertSupplies() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Harga Supply");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Harga Supply");
        refreshSupplies();
    }
     //delete
    $(document).on("click",".btn_delete_product",function(){
        var data = $('#tableProduct').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus product unit ini?","btn-delete-product");
        $('#btn-delete-product').attr("spr_id", data.spr_id);
    });


    $(document).on("click","#btn-delete-product",function(){
        $.ajax({
            url:"/admin/deleteSupplierPrice",
            data:{
                spr_id:$('#btn-delete-product').attr('spr_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshProduct();
                notifikasi('success', "Berhasil Delete", "Berhasil delete product");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
    //delete supplies
    $(document).on("click",".btn_delete_supplies",function(){
        var data = $('#tableSupplies').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus supply unit ini?","btn-delete-supply");
        $('#btn-delete-supply').attr("spr_id", data.spr_id);
    });


    $(document).on("click","#btn-delete-supply",function(){
        $.ajax({
            url:"/admin/deleteSupplierPrice",
            data:{
                spr_id:$('#btn-delete-supply').attr('spr_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshSupplies();
                notifikasi('success', "Berhasil Delete", "Berhasil delete product");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    
  

    function refreshPurchaseOrder() {
        $("#tablePurchaseOrder").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getPurchaseOrder",
                type: "get",
                data:{
                    sp_id:sp_id,
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].spo_tanggal_text = moment(json[i].spo_tanggal).format('D MMM YYYY');
                        json[i].spo_total = formatRupiah(json[i].spo_total,"Rp.");
                        json[i].action=`
                            
                            <a href="/admin/PurchaseOrderDetail/${json[i].spo_id}" aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit " data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
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
                { data: "spo_nomer", className: "text-left"},
                { data: "spo_tanggal_text", className: "text-left"},
                { data: "spo_total", className: "text-left"},
                { data: "spo_status", className: "text-center"},
                { data: "action", className: "text-center"},
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

        let table1 = $("#tablePurchaseOrder").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    
    function refreshPoInvoice() {
        $("#tablePoInvoice").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getPoInvoice",
                type: "get",
                data:{
                    sp_id:sp_id
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        var color = "bg-success";
                        if(json[i].spoi_status=="Unpaid") color="bg-danger";
                        else if(json[i].spoi_status=="Half Paid") color="bg-warning";
                        else if(json[i].spoi_status=="Canceled") color="bg-secondary";
                        json[i].spoi_tanggal_text = moment(json[i].spoi_tanggal).format('D MMM YYYY');
                        json[i].spoi_total_text = formatRupiah(json[i].spoi_total,"Rp.");
                        json[i].spoi_status_text = `<span class="badge ${color}">${json[i].spoi_status}</span>`;
                        json[i].action=`
                            
                            <a href="/admin/PurchaseOrderDetail/${json[i].spo_id}" aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit " data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-eye-outline fs-14 text-primary"></i>
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
                { data: "spo_nomer", className: "text-center"},
                { data: "spoi_tanggal_text", className: "text-center"},
                { data: "spoi_nomer", className: "text-start"},
                { data: "spoi_total_text", className: "text-end"},
                { data: "spoi_status_text", className: "text-center"},
                { data: "action", className: "text-center"},
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

        let table1 = $("#tablePoInvoice").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

   