    var mode=1;
    var variants = [];
    refreshCustomer();
    autocompleteLocation('#filter_city_id');
    autocompleteLocation('#city_id','#modalInsert');

    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('.preview_gallery').attr("src",uploadImageUrl);
        $('#input_file_galery').val("");
        $('#modalInsert input').val("");
        $('#modalInsert textarea').val("");
        $('#modalInsert #city_id').empty();
        $('#modalInsert #cus_gender').val("Male");
        $('#modalInsert .modal-title').html("Add New Customer");
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");
    })

 

    function refreshCustomer() {
        $("#tableCustomer").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getCustomer",
                type: "get",
                data:{
                    sp_name:$('#filter_sp_name').val(),
                    city_id:$('#filter_city_id').val(),
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].cus_img_preview = `<img src="${public+json[i].cus_img}" class="me-2" style="width:30px">`+json[i].cus_name;
                        
                        json[i].action=`
                            
                            <a href="/admin/customerDetail/${json[i].cus_id}" aria-label="anchor" class="btn btn-sm bg-info-subtle me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-eye-outline fs-14 text-info"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit " data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                            </a>
                        `;
                        json[i].cus_total_piutang_text = formatRupiah(json[i].cus_total_piutang+"","Rp.");
                        json[i].cus_total_spent_text = formatRupiah(json[i].cus_total_spent+"","Rp.");
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
                { data: "cus_img_preview", className: "text-left"},
                { data: "cus_code", className: "text-left"},
                { data: "cus_nomer", className: "text-left"},
                { data: "city_name", className: "text-left"},
                { data: "cus_total_piutang_text", className: "text-left"},
                { data: "cus_total_spent_text", className: "text-left"},
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

        let table1 = $("#tableCustomer").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertCustomer";
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
            cus_name:$('#cus_name').val(),
            cus_nomer:$('#cus_nomer').val(),
            cus_address:$('#cus_address').val(),
            city_id:$('#city_id').val(),
            cus_notes:$('#cus_notes').val(),
            cus_dob:$('#cus_dob').val(),
            cus_gender:$('#cus_gender').val(),
             _token:token
        };

        if(mode==2){
            url="/admin/updateCustomer";
            param.cus_id = $('#modalInsert').attr("cus_id");
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Customer");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Customer");
        refreshCustomer();
    }
    
    $(document).on("keyup","#filter_sp_name",function(){
        refreshCustomer();
    });
    $(document).on("change","#filter_city_id",function(){
        refreshCustomer();
    });

    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableCustomer').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        console.log(data);
        $('#modalInsert .modal-title').html("Edit Customer");
        mode=2;
        $('.preview_gallery').attr("src",public+data.cus_img),
        $('#cus_name').val(data.cus_name),
        $('#cus_nomer').val(data.cus_nomer),
        $('#cus_address').val(data.cus_address),
        $('#cus_gender').val(data.cus_gender),
        $('#cus_dob').val(data.cus_dob),
        $('#city_id').empty().append(`<option value="${data.city_id}">${data.city_name}</option>`),
        $('#cus_notes').val(data.cus_notes),
        $('#modalInsert').modal("show");
        $('#modalInsert').attr("cus_id", data.cus_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableCustomer').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Customer ini?","btn-delete-Customer");
        $('#btn-delete-Customer').attr("cus_id", data.cus_id);
    });



    $(document).on("click","#btn-delete-Customer",function(){
        $.ajax({
            url:"/admin/deleteCustomer",
            data:{
                cus_id:$('#btn-delete-Customer').attr('cus_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshCustomer();
                notifikasi('success', "Berhasil Delete", "Berhasil delete product Customer ");
                
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


