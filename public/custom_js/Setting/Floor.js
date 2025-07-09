    var mode=1;
    refreshFloor();
    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#modalInsert .modal-title').html("Add New Floor");
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");
    })

    function refreshFloor() {
        $("#tableFloor").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getFloor",
                type: "get",
                data:{
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].action=`
                            
                            <a href="/admin/meja/${json[i].fl_id}" aria-label="anchor" class="btn btn-sm bg-info-subtle me-2  " data-bs-toggle="tooltip" data-bs-original-title="View">
                                <i class="mdi mdi-eye-outline fs-14 text-primary"></i>
                            </a>
                            <a  aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit " data-bs-toggle="tooltip" data-bs-original-title="Edit">
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
                { data: "fl_name", className: "text-left"},
                { data: "fl_jumlah", className: "text-left"},
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

        let table1 = $("#tableFloor").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertFloor";
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
            fl_name:$('#fl_name').val(),
             _token:token
        };

        if(mode==2){
            url="/admin/updateFloor";
            param.fl_id = $('#modalInsert').attr("fl_id");
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Floor");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Floor");
        refreshFloor();
    }


    $(document).on("keyup","#filter_pu_short_name, #filter_pu_full_name",function(){
        refreshFloor();
    });
    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableFloor').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsert .modal-title').html("Edit Floor");
        $('#modalInsert input').empty().val("");
        $('#fl_name').val(data.fl_name);

        $('#modalInsert').modal("show");
        $('#modalInsert').attr("fl_id", data.fl_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableFloor').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Floor ini?","btn-delete-floor");
        $('#btn-delete-floor').attr("fl_id", data.fl_id);
    });


    $(document).on("click","#btn-delete-floor",function(){
        $.ajax({
            url:"/admin/deleteFloor",
            data:{
                fl_id:$('#btn-delete-floor').attr('fl_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshFloor();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Floor");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
