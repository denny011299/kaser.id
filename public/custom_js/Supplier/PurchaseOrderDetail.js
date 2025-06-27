    var mode=1;
    refreshStatus(dataPo.spo_status);
    refreshPoInvoice();
    $(document).on("click",".btn-add-invoice",function(){
        mode=1;
        
        $('#modalInsert input').val("");
        $('#spoi_date').val(getCurrentDate());
        $('#modalInsert').modal("show");
    });



    $(document).on("click",".menu",function(){
        var menu = $(this).attr("menu");
        console.log(menu);
        
        if(menu==2) refreshPoInvoice();
        else if(menu==3)refreshPayment();
    });

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
                    spo_id:spo_id
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
              
                        if(dataPo.spo_status!="Done"){
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

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertPoInvoice";
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
            spo_id:spo_id,
            spoi_date:$('#spoi_date').val(),
            spoi_nomer:$('#spoi_nomer').val(),
            spoi_total:convertToAngka($('#spoi_total').val()),
             _token:token
        };

        if(mode==2){
            url="/admin/updatePoInvoice";
            param.spo_id = $('#modalInsert').attr("spo_id");
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
        refreshPoInvoice();
    }

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tablePoInvoice').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Purchase Order ini?","btn-delete-PoInvoice");
        $('#btn-delete-PoInvoice').attr("spoi_id", data.spoi_id);
    });



    $(document).on("click","#btn-delete-PoInvoice",function(){
        $.ajax({
            url:"/admin/deletePoInvoice",
            data:{
                spoi_id:$('#btn-delete-PoInvoice').attr('spoi_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshPoInvoice();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Purchase Order ");
                
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
        $('#spoi_date').val(data.spoi_date);
        $('#spoi_nomer').val(data.spoi_nomer);
        $('#spoi_total').val(formatRupiah(data.spoi_total));

        $('#modalInsert').modal("show");
        $('#modalInsert').attr("spoi_id", data.spoi_id);
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
                url: "/admin/getPaymentPo",
                type: "get",
                data:{
                    spo_id:spo_id
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].spop_tanggal_text = moment(json[i].spop_date).format('D MMM YYYY');
                        console.log(json[i].spop_date);
                        
                        json[i].spop_total_text = formatRupiah(json[i].spop_total,"Rp.");
                        if(dataPo.spo_status=="Done"){
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
                { data: "spoi_nomer", className: "text-start"},
                { data: "spop_tanggal_text", className: "text-center"},
                { data: "spop_type", className: "text-center"},
                { data: "spop_total_text", className: "text-end"},
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
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertPaymentPo";
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
            spop_date:$('#spop_date').val(),
            spoi_id:$('#spoi_id').val(),
            spop_type:$('#spop_type').val(),
            spop_total:convertToAngka($('#spop_total').val()),
             _token:token
        };

        if(mode==2){
            url="/admin/updatePaymentPo";
            param.spop_id = $('#modalInsertPayment').attr("spop_id");
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
                refreshStatus(e.spo_status);
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
        showModalDelete("Apakah yakin ingin mengahapus Payment ini?","btn-delete-payment");
        $('#btn-delete-payment').attr("spop_id", data.spop_id);
    });



    $(document).on("click","#btn-delete-payment",function(){
        $.ajax({
            url:"/admin/deletePaymentPo",
            data:{
                spop_id:$('#btn-delete-payment').attr('spop_id'),
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
        $('#modalInsertPayment .modal-title').html("Edit Payment");
        $('#modalInsertPayment input').empty().val("");
        $('#spop_date').val(data.spop_date);
        $('#spoi_id').val(data.spoi_id);
        $('#spop_type').val(data.spop_type);
        $('#spop_total').val(formatRupiah(data.spop_total));

        $('#modalInsertPayment').modal("show");
        $('#modalInsertPayment').attr("spop_id", data.spop_id);
    });
    
    $(document).on("click",".btn_view_payment",function(){
        var data = $('#tablePaymentPo').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        console.log(data);
        
        $('#view_spop_date').html(moment(data.spop_date).format('D MMM YYYY'));
        $('#view_spop_total').html(formatRupiah(data.spop_total,"Rp."));
        $('#view_spoi_nomer').html(data.spoi_nomer);
        $('#view_spop_type').html(data.spop_type);
        $('#view_spop_img').attr("src",public + data.spop_img);
        $('.btn-download').attr("href",public + data.spop_img);
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
        $('#spoi_id').html("");
        data.forEach(item => {
            $('#spoi_id').append(`<option value="${item.spoi_id}">${item.spoi_nomer}</option>`); 
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