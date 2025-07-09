var mode=1;
$(document).on("click",".menu",function(){
    var menu = $(this).attr("menu");
    if(menu==3) refreshKasbon();
}); 



function refreshKasbon() {
    $("#tableCashbon").dataTable({
        dom: 'Bfrtip',
        serverSide: false,
        destroy: true,
        deferLoading: 10,
        deferRender: true,
        ajax: {
            url: "/admin/getKasbon",
            type: "get",
            data:{
                st_id:st_id,
            },
            dataSrc: function (json) {
                for (var i = 0; i < json.length; i++) {
                    json[i].ks_jumlah_text = formatRupiah(json[i].ks_jumlah+"","Rp.");
                    json[i].ks_date_text = moment(json[i].ks_date).format('D MMM YYYY');
                    json[i].ks_due_date = moment(json[i].ks_date).format('MMM');
                    json[i].status_text = "Pending";
                    if(json[i].status==2) json[i].status_text = "Accept";
                    else if(json[i].status==3) json[i].status_text = "Decline";
                     json[i].action=`
                        <a aria-label="anchor" class="btn btn-sm bg-info-subtle me-2 btn_view_kasbon" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                            <i class="mdi mdi-eye-outline fs-14 text-info"></i>
                        </a>
                    `;
                    if(json[i].status==1){
                        json[i].action+=`
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit_kasbon" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete_kasbon" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                            </a>
                        `;
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
            { data: "ks_date_text", className: "text-center"},
            { data: "ks_nomer", className: "text-center"},
            { data: "ks_due_date", className: "text-center"},
            { data: "ks_jumlah_text", className: "text-center"},
            { data: "status_text", className: "text-center"},
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
    let table1 = $("#tableCashbon").DataTable();
    table1.one("draw", function () {
        table1.columns.adjust();
    }).ajax.reload();
}

    $(document).on("click",".btn-add-kasbon",function(){
        mode=1;
        $('#modalInsertKasbon .modal-title').html("Add New Cash Advance");
        $('#modalInsertKasbon input').val("");
        $('#modalInsertKasbon textarea').val("");
        $('.btn-acc').hide();
        $('#modalInsertKasbon').modal("show");
    });

    //insert product
    $(document).on("click",".btn-save-kasbon",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertKasbon";
        var valid=1;
        
        $("#modalInsertKasbon .fill").each(function(){
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
            ks_date:$('#ks_date').val(),
            ks_tujuan:$('#ks_tujuan').val(),
            ks_jumlah:convertToAngka($('#ks_jumlah').val()),
            st_id:st_id,
            _token:token
        };

        if(mode==2){
            url="/admin/updateKasbon";
            param.ks_id = $('#modalInsert').attr("ks_id");
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
                ResetLoadingButton(".btn-save-kasbon", 'Save changes');      
                afterInsertKasbon();
            },
            error:function(e){
                ResetLoadingButton(".btn-save-kasbon", 'Save changes');
                console.log(e);
            }
        });
    });
    function afterInsertKasbon() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil Mengajukan Cash Advance");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Cash Advance");
        refreshKasbon();
    }
     //delete
    $(document).on("click",".btn_delete_kasbon",function(){
        var data = $('#tableCashbon').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Cash Advance ini?","btn-delete-kasbon");
        $('#btn-delete-kasbon').attr("ks_id", data.ks_id);
    });


    $(document).on("click","#btn-delete-kasbon",function(){
        $.ajax({
            url:"/admin/deleteKasbon",
            data:{
                ks_id:$('#btn-delete-kasbon').attr('ks_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshKasbon();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Cash Advance");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    $(document).on("click",".btn_edit_kasbon",function(){
        var data = $('#tableCashbon').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsertKasbon .modal-title').html("Edit Cash Advance");
        $('#modalInsertKasbon input').empty().val("");
        $('#ks_date').val(data.ks_date);
        $('#ks_tujuan').val(data.ks_tujuan);
        $('#ks_jumlah').val(formatRupiah(data.ks_jumlah));
        $('.btn-acc').show();
        $('.btn-acc').attr("ks_id",data.ks_id);
        $('#modalInsertKasbon').modal("show");
        $('#modalInsertKasbon').attr("ks_id", data.ks_id);
    });
    $(document).on("click",".btn_view_kasbon",function(){
        var data = $('#tableCashbon').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalViewKasbon .modal-title').html("View Cash Advance");
        $('#modalViewKasbon input').empty().val("");
        $('#view_ks_date').html(data.ks_date);
        $('#view_ks_notes').html(data.ks_notes);
        $('#view_ks_tujuan').html(data.ks_tujuan);
        $('#view_ks_jumlah').html(formatRupiah(data.ks_jumlah));
        
        $('#modalViewKasbon').modal("show");
    });

     $(document).on("click",".btn-confirm-reject",function(){
         var st = $(this).attr("st");
        var ks_id = $(this).attr("ks_id");
        changeStatusKasbon(ks_id,st);
     });
     $(document).on("click",".btn-acc",function(){
        var st = $(this).attr("st");
        var ks_id = $(this).attr("ks_id");
        if(st==3){
            $('.btn-confirm-reject').attr("st",st);
            $('.btn-confirm-reject').attr("ks_id",ks_id);
            $('#modalReason').modal("show");
            return false;
        }
        changeStatusKasbon(ks_id,st);
    });

    function changeStatusKasbon(ks_id,st) {
        $.ajax({
            url:"/admin/ActionKasbon",
            data:{
                ks_id:ks_id,
                st:st,
                ks_notes:st==3?$('#ks_notes').val():null,
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshKasbon();
                if(st==2)notifikasi('success', "Berhasil Delete", "Berhasil terima Cash Advance");
                else if(st==2)notifikasi('success', "Berhasil Delete", "Berhasil tolak Cash Advance");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    }