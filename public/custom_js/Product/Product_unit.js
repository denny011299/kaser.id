    var mode=1;
    refreshProductUnit();
    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#modalInsert .modal-title').html("Add New Product Unit");
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");
    })

    function refreshProductUnit() {
        $("#tableProductUnit").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getProductUnit",
                type: "get",
                data:{
                    pu_short_name:$('#filter_pu_short_name').val(),
                    pu_full_name:$('#filter_pu_full_name').val()
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
                { data: "pu_full_name", className: "text-left"},
                { data: "pu_short_name", className: "text-left"},
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

        let table1 = $("#tableProductUnit").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertProductUnit";
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
            pu_short_name:$('#pu_short_name').val(),
            pu_full_name:$('#pu_full_name').val(),
             _token:token
        };

        if(mode==2){
            url="/admin/updateProductUnit";
            param.pu_id = $('#modalInsert').attr("pu_id");
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Product Unit");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Product Unit");
        refreshProductUnit();
    }


    $(document).on("keyup","#filter_pu_short_name, #filter_pu_full_name",function(){
        refreshProductUnit();
    });
    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableProductUnit').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsert .modal-title').html("Edit Product Unit");
        $('#modalInsert input').empty().val("");
        $('#pu_short_name').val(data.pu_short_name);
        $('#pu_full_name').val(data.pu_full_name);

        $('#modalInsert').modal("show");
        $('#modalInsert').attr("pu_id", data.pu_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableProductUnit').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus product unit ini?","btn-delete-product-unit");
        $('#btn-delete-product-unit').attr("pu_id", data.pu_id);
    });


    $(document).on("click","#btn-delete-product-unit",function(){
        $.ajax({
            url:"/admin/deleteProductUnit",
            data:{
                pu_id:$('#btn-delete-product-unit').attr('pu_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshProductUnit();
                notifikasi('success', "Berhasil Delete", "Berhasil delete product unit");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
