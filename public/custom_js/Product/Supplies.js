    var mode=1;
    var variants = [];
    refreshSupplies();

    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#modalInsert .modal-title').html("Add New Supplies");
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");
    })


    function refreshSupplies() {
        $("#tableSupplies").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getSupplies",
                type: "get",
                data:{
                    sup_name:$('#filter_sup_name').val(),
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        
                        json[i].action=`
                            
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit " data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
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
                { data: "sup_sku", className: "text-left"},
                { data: "sup_name", className: "text-left"},
                { data: "sup_stock", className: "text-left"},
                { data: "sup_min_stok", className: "text-left"},
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

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertSupplies";
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
            sup_sku:$('#sup_sku').val(),
            sup_name:$('#sup_name').val(),
            sup_unit:$('#sup_unit').val(),
            sup_stock:$('#sup_stock').val(),
            sup_buy_price:$('#sup_buy_price').val(),
            sup_min_stock:$('#sup_min_stock').val(),
             _token:token
        };

        if(mode==2){
            url="/admin/updateSupplies";
            param.sup_id = $('#modalInsert').attr("sup_id");
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Supplies");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Supplies");
        refreshSupplies();
    }

    $(document).on("keyup","#filter_sup_name",function(){
        refreshSupplies();
    });

    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableSupplies').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        
        $('#modalInsert .modal-title').html("Edit Supplies");
        $('#modalInsert input').empty().val("");
        $('#sup_sku').val(data.sup_sku);
        $('#sup_name').val(data.sup_name);
        $('#sup_stock').val(data.sup_stock);
        $('#sup_unit').val(data.sup_unit);
        $('#sup_min_stock').val(data.sup_min_stok);
        $('#sup_buy_price').val(data.sup_buy_price);
        $('#modalInsert').modal("show");
        $('#modalInsert').attr("sup_id", data.sup_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableSupplies').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus supplies ini?","btn-delete-supplies");
        $('#btn-delete-supplies').attr("sup_id", data.sup_id);
    });



    $(document).on("click","#btn-delete-supplies",function(){
        $.ajax({
            url:"/admin/deleteSupplies",
            data:{
                sup_id:$('#btn-delete-supplies').attr('sup_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshSupplies();
                notifikasi('success', "Berhasil Delete", "Berhasil delete supplies ");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    $(document).on("click",".btn_delete_variant",function(){
        var idx = $(this).attr("index");
        variants.splice(idx,1);
        $(this).closest(".col-choice").remove(); 
    });