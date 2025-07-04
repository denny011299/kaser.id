    var mode=1;
    refreshStatus(dataPo.so_status);
    refreshPoInvoice();
    $(document).on("click",".btn-add-invoice",function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#soi_date').val(getCurrentDate());
        $('#modalInsert').modal("show");
    });
 


    $(document).on("click",".menu",function(){
        var menu = $(this).attr("menu");
        console.log(menu);
        
        if(menu==2) refreshDO();
        else if(menu==3) refreshPoInvoice();
        else if(menu==4)refreshPayment();
    });

    function refreshPoInvoice() {
        $("#tablePoInvoice").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getSoInvoice",
                type: "get",
                data:{
                    so_id:so_id
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        var color = "bg-success";
                        if(json[i].soi_status=="Unpaid") color="bg-danger";
                        else if(json[i].soi_status=="Half Paid") color="bg-warning";
                        else if(json[i].soi_status=="Canceled") color="bg-secondary";
                        json[i].soi_tanggal_text = moment(json[i].soi_tanggal).format('D MMM YYYY');
                        json[i].soi_total_text = formatRupiah(json[i].soi_total,"Rp.");
                        json[i].soi_status_text = `<span class="badge ${color}">${json[i].soi_status}</span>`;
              
                        if(dataPo.so_status!="Done"){
                            json[i].action=`
                                <a  aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit " data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                    <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                </a>
                                <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                    <i class="mdi mdi-delete fs-14 text-danger"></i>
                                </a>
                            `;
                        }
                        else{
                            json[i].action=``;

                        }
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
                { data: "soi_tanggal_text", className: "text-center"},
                { data: "soi_nomer", className: "text-start"},
                { data: "soi_total_text", className: "text-end"},
                { data: "soi_status_text", className: "text-center"},
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

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertSoInvoice";
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
            so_id:so_id,
            soi_date:$('#soi_date').val(),
            soi_due_date:$('#soi_due_date').val(),
            soi_total:convertToAngka($('#soi_total').val()),
             _token:token
        };

        if(mode==2){
            url="/admin/updateSoInvoice";
            param.soi_id = $('#modalInsert').attr("soi_id");
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
                afterInsert();
            },
            error:function(e){
                ResetLoadingButton(".btn-save", 'Save changes');
                console.log(e);
            }
        });
    });

    function afterInsert() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Invoice");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Invoice");
        refreshSoInvoice();
    }

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tablePoInvoice').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Sales Order ini?","btn-delete-SoInvoice");
        $('#btn-delete-SoInvoice').attr("soi_id", data.soi_id);
    });



    $(document).on("click","#btn-delete-SoInvoice",function(){
        $.ajax({
            url:"/admin/deleteSoInvoice",
            data:{
                soi_id:$('#btn-delete-SoInvoice').attr('soi_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshSoInvoice();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Sales Order ");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });

 //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tablePoInvoice').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsert .modal-title').html("Edit Invoice");
        $('#modalInsert input').empty().val("");
        $('#soi_date').val(data.soi_date);
        $('#soi_due_date').val(data.soi_due_date);
        $('#soi_total').val(formatRupiah(data.soi_total));

        $('#modalInsert').modal("show");
        $('#modalInsert').attr("soi_id", data.soi_id);
    });
    
    //payment
    function refreshPayment() {
        $("#tablePaymentPo").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getPaymentSo",
                type: "get",
                data:{
                    so_id:so_id
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].sop_tanggal_text = moment(json[i].sop_date).format('D MMM YYYY');
              
                        
                        json[i].sop_total_text = formatRupiah(json[i].sop_total,"Rp.");
                        if(dataPo.so_status!="Done"){
                            json[i].action=`
                                <a  aria-label="anchor" class="btn btn-sm bg-info-subtle me-2 btn_view_payment" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                    <i class="mdi mdi-eye-outline fs-14 text-primary"></i>
                                </a>
                                <a  aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit_payment" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                    <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                </a>
                                <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete_payment" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                    <i class="mdi mdi-delete fs-14 text-danger"></i>
                                </a>
                            `;
                        }
                        else{
                            json[i].action=``;
                        }
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
                { data: "soi_nomer", className: "text-start"},
                { data: "sop_tanggal_text", className: "text-center"},
                { data: "sop_type", className: "text-center"},
                { data: "sop_total_text", className: "text-end"},
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

        let table1 = $("#tablePaymentPo").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save-payment",function(){
      
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertPaymentSo";
        var valid=1;

        $("#modalInsertPayment .fillPayment").each(function(){
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
            sop_date:$('#sop_date').val(),
            soi_id:$('#soi_id').val(),
            sop_type:$('#sop_type').val(),
            sop_total:convertToAngka($('#sop_total').val()),
             _token:token
        };
          LoadingButton(this);
        if(mode==2){
            url="/admin/updatePaymentSo";
            param.sodp_id = $('#modalInsertPayment').attr("sodp_id");
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
            method:"post",
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            headers: {
                'X-CSRF-TOKEN': token
            },
            success:function(e){      
                refreshStatus(e.so_status);
                ResetLoadingButton(".btn-save-payment", 'Save changes');      
                afterInsertPayment();
            },
            error:function(e){
                ResetLoadingButton(".btn-save-payment", 'Save changes');
                console.log(e);
            }
        });
    });

    function afterInsertPayment() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Invoice");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Invoice");
        refreshPayment();
    }
  

    //delete
    $(document).on("click",".btn_delete_payment",function(){
        var data = $('#tablePaymentPo').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        console.log(data.sop_id);
        
        console.log($('#btn-delete-payment').attr('sop_id'));
        showModalDelete("Apakah yakin ingin mengahapus Payment ini?","btn-delete-payment");
        $('#btn-delete-payment').attr("sop_id", data.sop_id);
    });



    $(document).on("click","#btn-delete-payment",function(){
        $.ajax({
            url:"/admin/deletePaymentSo",
            data:{
                sop_id:$('#btn-delete-payment').attr('sop_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshPayment();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Payment");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });

 //edit
    $(document).on("click",".btn_edit_payment",function(){
        var data = $('#tablePaymentPo').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        getInvoice();
        $('#modalInsertPayment .modal-title').html("Edit Payment"   );
        $('#modalInsertPayment input').empty().val("");
        $('#sop_date').val(data.sop_date);
        $('#soi_id').val(data.soi_id);
        $('#sop_type').val(data.sop_type);
        $('#sop_total').val(formatRupiah(data.sop_total));

        $('#modalInsertPayment').modal("show");
        $('#modalInsertPayment').attr("sop_id", data.sop_id);
    });
    
    $(document).on("click",".btn_view_payment",function(){
        var data = $('#tablePaymentPo').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        console.log(data);
        
        $('#view_sop_date').html(moment(data.sop_date).format('D MMM YYYY'));
        $('#view_sop_total').html(formatRupiah(data.sop_total,"Rp."));
        $('#view_soi_nomer').html(data.soi_nomer);
        $('#view_sop_type').html(data.sop_type);
        $('#view_sop_img').attr("src",public + data.sop_img);
        $('.btn-download').attr("href",public + data.sop_img);
        $('#modalViewPayment').modal("show");
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

    $(document).on("click",".btn-add-payment",function(){
        mode=1;
        getInvoice();
        $('#modalInsertPayment input').val("");
        $('#spop_date').val(getCurrentDate());
        $('.preview_gallery').attr("src",uploadImageUrl);
        $('#modalInsertPayment').modal("show");
    });

    function getInvoice() {
        var data = $('#tablePoInvoice').DataTable().rows().data().toArray();
        $('#soi_id').html("");
        data.forEach(item => {
            $('#soi_id').append(`<option value="${item.soi_id}">${item.soi_nomer}</option>`); 
        });
        
    }
   

    function refreshStatus(status) {
        var color = "bg-success";
        if(status=="Submitted") color="bg-info";
        else if(status=="Invoice") color="bg-warning";
        else if(status=="Canceled") color="bg-secondary";
        var text = color.split("-")[1];
        $('#label_spo_status').html(`<span class="badge ${color}">${status}</span>`);
        $('#label_spo_status').html(` <label for="" class="${color}-subtle text-${text}  px-3 py-1 mb-2" style="border-radius: 100px;font-size:8pt">${status} </label>`);
    }

    //DO
     function refreshProduct() {
        $('.row-product').html("");
        console.log(dataPo.items.length);
        dataPo.items.forEach((item,idx) => {
            console.log(idx);
            
            $('.row-product').append(`
                <div class="col-6 item-product">
                    <div class="row mt-2 px-0">
                        <div class="col-5">
                            <div class="input-group">
                                <input type="number" min="0" name="" id="dod_qty" class="form-control dod_qty" value="${item.sod_qty}">
                                <span class="input-group-text dod_unit">${item.sod_unit}</span>
                                <input type="hidden" class="sod-${item.sod_id}" id="sod_id" value="${item.sod_id}">
                                <input type="hidden"  id="dod_id" value="">
                            </div>
                            
                        </div>
                        <div class="col-7 pt-2 ">
                            <h6 class="dod_nama">${item.sod_nama}</h6>
                        </div>
                    </div>
                </div>
                                
            `); 
        });
        
    }


     $(document).on("click",".btn-save-do",function(){
      
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertDO";
        var valid=1;
        var items = [];
        $("#modalInsertDO .fillDo").each(function(){
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

        $('.item-product').each(function () {
            console.log($(this).find('.dod_qty').val());
            
            if($(this).find('.dod_qty').val()>0){
                items.push({
                    sod_id:$(this).find('#sod_id').val(),
                    dod_qty:$(this).find('.dod_qty').val(),
                    dod_unit:$(this).find('.dod_unit').html(),
                    dod_name:$(this).find('.dod_nama').html(),
                    dod_id:$(this).find('#dod_id').val()?$(this).find('#dod_id').val():null,
                })
            }
        }) 

        param = {
            do_date:$('#do_date').val(),
            do_sender_name:$('#do_sender_name').val(),
            do_receiver_name:$('#do_receiver_name').val(),
            do_note:$('#do_note').val(),
            do_item: JSON.stringify(items),
            so_id: so_id,
             _token:token
        };
        LoadingButton(this);
        
        if(mode==2){
            url="/admin/updateDO";
            param.do_id = $('#modalInsertDO').attr("do_id");
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
                refreshStatus(e.so_status);
                ResetLoadingButton(".btn-save-do", 'Save changes');      
                afterInsertPayment();
            },
            error:function(e){
                ResetLoadingButton(".btn-save-do", 'Save changes');
                console.log(e);
            }
        });
    });
    function refreshDO() {
        $("#tableDO").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getDO",
                type: "get",
                data:{
                    so_id:so_id
                },
                dataSrc: function (json) {
                    console.log(json);
                    
                    for (var i = 0; i < json.length; i++) {
                        json[i].do_date_text = moment(json[i].do_date).format('D MMM YYYY');
              
                        
                        json[i].total_item_text = json[i].items.length+" Items";
                        if(dataPo.so_status!="Done"){
                            json[i].action=`
                                <a  aria-label="anchor" class="btn btn-sm bg-info-subtle me-2 btn_view_do" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                    <i class="mdi mdi-eye-outline fs-14 text-primary"></i>
                                </a>
                                <a  aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit_do" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                    <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                </a>
                                <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete_do" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                    <i class="mdi mdi-delete fs-14 text-danger"></i>
                                </a>
                            `;
                        }
                        else{
                            json[i].action=``;
                        }
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
                { data: "do_nomer", className: "text-start"},
                { data: "do_date_text", className: "text-center"},
                { data: "total_item_text", className: "text-center"},
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

        let table1 = $("#tableDO").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }
    function afterInsertPayment() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Delivery Order");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update  Delivery Order");
        refreshDO();
    }
    $(document).on("click",".btn-add-delivery",function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#modalInsert textarea').val("");
        $('#do_date').val(getCurrentDate());
        refreshProduct();
        $('#modalInsertDO').modal("show");
    });
    //delete do
    $(document).on("click",".btn_delete_do",function(){
        var data = $('#tableDO').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Delivery Order ini?","btn-delete-do");
        $('#btn-delete-do').attr("do_id", data.do_id);
    });



    $(document).on("click","#btn-delete-do",function(){
        $.ajax({
            url:"/admin/deleteDO",
            data:{
                do_id:$('#btn-delete-do').attr('do_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshDO();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Delivery Order");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
    //edit Do
    $(document).on("click",".btn_edit_do",function(){
        var data = $('#tableDO').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        console.log(data);
        $('#modalInsertDO .modal-title').html("Edit DO");
        $('#modalInsertDO input').empty().val("");
        refreshProduct();

        $('#do_date').val(data.do_date);
        $('#do_sender_name').val(data.do_sender_name);
        $('#do_receiver_name').val(data.do_receiver_name);
        $('#do_note').val(data.do_note);
        $('.dod_qty').val(0);
        data.items.forEach(element => {
            var el = $('.sod-'+element.sod_id).closest('.item-product');
    
            el.find('#so_id').val(element.so_id);
            el.find('#dod_qty').val(element.dod_qty);
            el.find('#dod_id').val(element.dod_id);
            console.log(element);
            
        });

        $('#modalInsertDO').modal("show");
        $('#modalInsertDO').attr("do_id", data.do_id);
    });
