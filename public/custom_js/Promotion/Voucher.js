    var mode=1;
    refreshVoucher();
    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#modalInsert textarea').val("");
        $('#modalInsert .modal-title').html("Add New Voucher");
        $('#voucherType').prop("checked",false).trigger('change');
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");
    })

    function refreshVoucher() {
        $("#tableVoucher").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getVoucher",
                type: "get",
                data:{
                    vc_name:$('#filter_vc_name').val()
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        if(json[i].vc_nominal!=0) json[i].vc_nominal_text = formatRupiah(json[i].vc_nominal,"Rp.");
                        else json[i].vc_nominal_text = json[i].vc_persen+"%";

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
                { data: "vc_name", className: "text-left"},
                { data: "vc_nominal_text", className: "text-left"},
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

        let table1 = $("#tableVoucher").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertVoucher";
        var valid=1;
        var voucherType=1;//fix nominal
        var nominal,persen;
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

        if($('#voucherType').is(":checked")){
           voucherType=2;
           //percent
           persen = $('#vc_persen').val();
           nominal = 0;
        }
        else{
            nominal = convertToAngka($('#vc_nominal').val());
            persen = 0;
        }
        param = {
            vc_name:$('#vc_name').val(),
            vc_deskripsi:$('#vc_deskripsi').val(),
            voucherType:voucherType,
            vc_nominal:nominal,
            vc_persen:persen,
             _token:token
        };

        if(mode==2){
            url="/admin/updateVoucher";
            param.vc_id = $('#modalInsert').attr("vc_id");
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Voucher");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Voucher");
        refreshVoucher();
    }


    $(document).on("keyup","#filter_vc_name",function(){
        refreshVoucher();
    });

    $(document).on("change","#voucherType",function(){
        if($(this).is(":checked")){
            $('.fix-nominal').hide();
            $('.percent').show();
        }
        else{
            $('.fix-nominal').show();
            $('.percent').hide();
        }
    });

    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableVoucher').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsert .modal-title').html("Add Edit Voucher");
        $('#modalInsert input').empty().val("");
        $('#vc_name').val(data.vc_name);
        $('#vc_deskripsi').val(data.vc_deskripsi);
        if(data.vc_nominal!=0){
            $('#vc_nominal').val(formatRupiah(data.vc_nominal));
            $('#voucherType').prop("checked",false).trigger('change');
        }
        else {
            $('#vc_persen').val(data.vc_persen);
            $('#voucherType').prop("checked",true).trigger('change');
        }
        $('#modalInsert').modal("show");
        $('#modalInsert').attr("vc_id", data.vc_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableVoucher').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Voucher ini?","btn-delete-voucher");
        $('#btn-delete-voucher').attr("vc_id", data.vc_id);
    });


    $(document).on("click","#btn-delete-voucher",function(){
        $.ajax({
            url:"/admin/deleteVoucher",
            data:{
                vc_id:$('#btn-delete-voucher').attr('vc_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshVoucher();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Voucher");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
