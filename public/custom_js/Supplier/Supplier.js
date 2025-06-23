    var mode=1;
    var variants = [];
    refreshSupplier();
    autocompleteLocation('#filter_city_id');
    autocompleteLocation('#city_id','#modalInsert');

    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('.preview_gallery').attr("src",uploadImageUrl);
        $('#input_file_galery').val("");
        $('#modalInsert input').val("");
        $('#modalInsert textarea').val("");
        $('#modalInsert select').empty();
        $('#modalInsert .modal-title').html("Add New Supplier");
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");
    })

 

    function refreshSupplier() {
        $("#tableSupplier").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getSupplier",
                type: "get",
                data:{
                    sp_name:$('#filter_sp_name').val(),
                    city_id:$('#filter_city_id').val(),
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].sp_name_img = `<img src="${public+json[i].sp_img}" class="me-2" style="width:30px">`+json[i].sp_name;
                        
                        json[i].action=`
                            
                            <a href="/admin/supplierDetail/${json[i].sp_id}" aria-label="anchor" class="btn btn-sm bg-info-subtle me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-eye-outline fs-14 text-info"></i>
                            </a>
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
                { data: "sp_name_img", className: "text-left"},
                { data: "sp_nomer", className: "text-left"},
                { data: "city_name", className: "text-left"},
                { data: "sp_cp_name", className: "text-left"},
                { data: "sp_cp_nomer", className: "text-left"},
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

        let table1 = $("#tableSupplier").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertSupplier";
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
            sp_name:$('#sp_name').val(),
            sp_nomer:$('#sp_nomer').val(),
            sp_address:$('#sp_address').val(),
            sp_cp_name:$('#sp_cp_name').val(),
            sp_cp_nomer:$('#sp_cp_nomer').val(),
            sp_email:$('#sp_email').val(),
            sp_bank_account:$('#sp_bank_account').val(),
            sp_bank_name:$('#sp_bank_name').val(),
            city_id:$('#city_id').val(),
            sp_notes:$('#sp_notes').val(),
             _token:token
        };

        if(mode==2){
            url="/admin/updateSupplier";
            param.sp_id = $('#modalInsert').attr("sp_id");
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
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Supplier");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Supplier");
        refreshSupplier();
    }
    
    $(document).on("keyup","#filter_sp_name",function(){
        refreshSupplier();
    });
    $(document).on("change","#filter_city_id",function(){
        refreshSupplier();
    });

    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableSupplier').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        console.log(data.sp_name);
        $('#modalInsert .modal-title').html("Edit Supplier");
        mode=2;
        $('.preview_gallery').attr("src",public+data.sp_img),
        $('#sp_name').val(data.sp_name),
        $('#sp_nomer').val(data.sp_nomer),
        $('#sp_address').val(data.sp_address),
        $('#sp_cp_name').val(data.sp_cp_name),
        $('#sp_cp_nomer').val(data.sp_cp_nomer),
        $('#sp_email').val(data.sp_email),
        $('#sp_bank_account').val(data.sp_bank_account),
        $('#sp_bank_name').val(data.sp_bank_name),
        $('#city_id').empty().append(`<option value="${data.city_id}">${data.city_name}</option>`),
        $('#sp_notes').val(data.sp_notes),
        $('#modalInsert').modal("show");
        $('#modalInsert').attr("sp_id", data.sp_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableSupplier').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus supplier ini?","btn-delete-supplier");
        $('#btn-delete-supplier').attr("sp_id", data.sp_id);
    });



    $(document).on("click","#btn-delete-supplier",function(){
        $.ajax({
            url:"/admin/deleteSupplier",
            data:{
                sp_id:$('#btn-delete-supplier').attr('sp_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshSupplier();
                notifikasi('success', "Berhasil Delete", "Berhasil delete product supplier ");
                
            },
            error:function(e){
                console.log(e);
            }
        });
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


