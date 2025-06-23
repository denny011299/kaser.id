    var mode=1;
    var variants = [];
    refreshProductVariant();

    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#modalInsert .modal-title').html("Add New Product Variant");
        $('.is-invalid').removeClass('is-invalid');
        refreshVariant();
        $('#modalInsert').modal("show");
    })

    function refreshVariant() {
        $('#container-variant').html("");
        variants.forEach((item,i) => {
              $('#container-variant').append(`
                <div class="col-5 col-lg-3 col-choice mb-3">
                    <div class="bg-primary-subtle px-3 py-2 mt-0 choice text-start">
                        <div class="row">
                            <div class="col-9 pt-1">
                                <label class="mt-0"><b>${item}</b></label>
                            </div>
                            <div class="col-3">
                                <span class="mdi mdi-close-circle-outline  variants btn_delete_variant" index="${i}" style="font-size: 14pt"></span>
                            </div>
                        </div>
                    </div>   
                </div>    
            `);
        });
    }

    function refreshProductVariant() {
        $("#tableProductVariant").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getProductVariant",
                type: "get",
                data:{
                    pv_name:$('#filter_pv_name').val(),
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].pv_variant_text="";
                        JSON.parse(json[i].pv_attribute).forEach(item => {
                          json[i].pv_variant_text += `<span class="badge bg-warning-subtle me-2 px-2 py-2 text-dark" style="border-radius:200px">${item}</span>`;  
                        });
                        
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
                { data: "pv_name", className: "text-left"},
                { data: "pv_variant_text", className: "text-left",width:"50%"},
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

        let table1 = $("#tableProductVariant").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertProductVariant";
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
            pv_attribute:JSON.stringify(variants),
            pv_name:$('#pv_name').val(),
             _token:token
        };

        if(mode==2){
            url="/admin/updateProductVariant";
            param.pv_id = $('#modalInsert').attr("pv_id");
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Product Variant");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Product Variant");
        refreshProductVariant();
    }


    $(document).on("click",".btn-add-variant",function(){
         $('.is-invalid').removeClass('is-invalid');
        if($('#variant').val()==""){
              $('#variant').addClass('is-invalid');
              return false;
        }
        
        variants.push($('#variant').val());
        refreshVariant();

        $('#variant').val("");
    });

    $(document).on("keyup","#filter_pv_name",function(){
        refreshProductVariant();
    });

    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableProductVariant').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        
        $('#modalInsert input').empty().val("");
        $('#pv_name').val(data.pv_name);
        variants = JSON.parse(data.pv_attribute);
        refreshVariant();
        $('#modalInsert').modal("show");
        $('#modalInsert').attr("pv_id", data.pv_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableProductVariant').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus product variant ini?","btn-delete-product-variant");
        $('#btn-delete-product-variant').attr("pv_id", data.pv_id);
    });



    $(document).on("click","#btn-delete-product-variant",function(){
        $.ajax({
            url:"/admin/deleteProductVariant",
            data:{
                pv_id:$('#btn-delete-product-variant').attr('pv_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshProductVariant();
                notifikasi('success', "Berhasil Delete", "Berhasil delete product variant ");
                
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