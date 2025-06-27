var mode=1;
    refreshProduct();
    autocompleteProduct('#pr_id','#modalInsert');
 $(document).on("click",".menu",function(){
        console.log();
        var menu = $(this).attr("menu");
        if(menu==1) refreshProduct();
        else if(menu==2) refreshSupplies();
        else if(menu==3) refreshPurchaseOrder();
        else if(menu==4) refreshPoInvoice();
    }); 

    function refreshProduct() {
        $("#tableProduct").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getCustomerPrice",
                type: "get",
                data:{
                    cus_id:cus_id,
                     type:1
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].pr_name_text = `<img src="${public+json[i].pr_img}" class="me-2" style="width:30px">`+json[i].pr_name;
                        json[i].cp_price_text = formatRupiah(json[i].cp_price+"","Rp.");
                        json[i].action=`
                            
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit_product" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete_product" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                            </a>
                        `;
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
                { data: "pr_sku", className: "text-start"},
                { data: "pr_name_text", className: "text-start"},
                { data: "c_name", className: "text-center"},
                { data: "cp_price_text", className: "text-end"},
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
        let table1 = $("#tableProduct").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-add-product",function(){
        $('#modalInsert input').val("");
        $('#modalInsert #pr_id').empty();
        $('#modalInsert').modal("show");
    });
    
    //edit product
    $(document).on("click",".btn_edit_product",function(){
        var data = $('#tableProduct').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsert .modal-title').html("Edit Product");
        $('#modalInsert input').empty().val("");
        $('#modalInsert #pr_id').empty().val("");
        $('#spr_price').val(formatRupiah(data.cp_price));
        $('#pr_id').append(`<option value="${data.pr_id}">${data.pr_name}</option>`);
        console.log(data);
        
        $('#modalInsertSupplies').modal("show");
        $('#modalInsertSupplies').attr("cp_id", data.cp_id);
    });

       //insert product
    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertCustomerPrice";
        var valid=1;
        
        $("#modalInsert .fillProduct").each(function(){
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
            cus_id:cus_id,
            pr_id:$('#pr_id').val(),
            cp_price:convertToAngka($('#spr_price').val()),
            _token:token
        };

        if(mode==2){
            url="/admin/updateCustomerPrice";
            param.cp_id = $('#modalInsert').attr("cp_id");
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
                afterInsertProduct();
            },
            error:function(e){
                ResetLoadingButton(".btn-save", 'Save changes');
                console.log(e);
            }
        });
    });
     function afterInsertProduct() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Harga Product");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Harga Product");
        refreshProduct();
    }
      //delete
    $(document).on("click",".btn_delete_product",function(){
        var data = $('#tableProduct').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus product unit ini?","btn-delete-product");
        $('#btn-delete-product').attr("cp_id", data.cp_id);
    });


    $(document).on("click","#btn-delete-product",function(){
        $.ajax({
            url:"/admin/deleteCustomerPrice",
            data:{
                cp_id:$('#btn-delete-product').attr('cp_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshProduct();
                notifikasi('success', "Berhasil Delete", "Berhasil delete product");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });