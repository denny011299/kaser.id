    var mode=1;
    refreshCategoryStaff();
    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#modalInsert .modal-title').html("Add New Staff Position");
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");
    })

    function refreshCategoryStaff() {
        $("#tableCategoryStaff").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getCategoryStaff",
                type: "get",
                data:{
                    cs_name:$('#filter_cs_name').val()
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
                { data: "cs_name", className: "text-left"},
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

        let table1 = $("#tableCategoryStaff").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertCategoryStaff";
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
            cs_name:$('#cs_name').val(),
             _token:token
        };

        if(mode==2){
            url="/admin/updateCategoryStaff";
            param.cs_id = $('#modalInsert').attr("cs_id");
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Category Staff");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Category Staff");
        refreshCategoryStaff();
    }


    $(document).on("keyup","#filter_cs_name",function(){
        refreshCategoryStaff();
    });

    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableCategoryStaff').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsert .modal-title').html("Edit Staff Position");
        $('#modalInsert input').empty().val("");
        $('#cs_name').val(data.cs_name);

        $('#modalInsert').modal("show");
        $('#modalInsert').attr("cs_id", data.cs_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableCategoryStaff').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Category Staff ini?","btn-delete-category-staff");
        $('#btn-delete-category-staff').attr("cs_id", data.cs_id);
    });


    $(document).on("click","#btn-delete-category-staff",function(){
        $.ajax({
            url:"/admin/deleteCategoryStaff",
            data:{
                cs_id:$('#btn-delete-category-staff').attr('cs_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshCategoryStaff();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Category Staff");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
