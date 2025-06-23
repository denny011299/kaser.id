    var mode=1;
    refreshCategory();
    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#modalInsert .modal-title').html("Add New Category");
        $('.icons').removeClass('icons-active');
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");
    })
    function refreshCategory() {
        $("#tableCategory").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getCategory",
                type: "get",
                data:{
                    category_name:$('#filter_category_name').val()
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].category_image  = `<i data-feather="${json[i].category_img}" class="icons"></i>`
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
                { data: "category_name", className: "text-left"},
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

        let table1 = $("#tableCategory").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertCategory";
        var valid=1;

        $("#modalInsert .fill").each(function(){
            if($(this).val()==null||$(this).val()=="null"||$(this).val()==""){
                valid=-1;
                $(this).addClass('is-invalid');
            }
        });

        if($('.icons-active').length<=0) valid=-1;

        if(valid==-1){
            notifikasi('error', "Gagal Insert", 'Silahkan cek kembali inputan anda');
            ResetLoadingButton('.btn-save', 'Save changes');
            return false;
        };

        param = {
            category_name:$('#category_name').val(),
            category_img:$('.icons-active').attr("value"),
             _token:token
        };

        if(mode==2){
            url="/admin/updateCategory";
            param.category_id = $('#modalInsert').attr("category_id");
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Category");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Category");
        refreshCategory();
    }

    $('.icons').click(function () {
        $('.icons').removeClass('icons-active');
        $(this).addClass('icons-active');
    });

    $(document).on("keyup","#filter_category_name",function(){
        refreshCategory();
    });
    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableCategory').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        
        $('#modalInsert input').empty().val("");
        $('#category_name').val(data.category_name);
        $('.'+data.category_img).addClass('icons-active');

        $('#modalInsert').modal("show");
        $('#modalInsert').attr("category_id", data.category_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableCategory').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus category ini?","btn-delete-category");
        $('#btn-delete-category').attr("category_id", data.category_id);
    });


    $(document).on("click","#btn-delete-category",function(){
        $.ajax({
            url:"/admin/deleteCategory",
            data:{
                category_id:$('#btn-delete-category').attr('category_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshCategory();
                notifikasi('success', "Berhasil Delete", "Berhasil delete category");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
