    var mode=1;
    var bundling = [];
    var product = [];
    refreshBundling();
    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('#modalInsert input').val("");
        $('#modalInsert textarea').val("");
        $('#modalInsert .modal-title').html("Add New Bundling");
        $('.preview_gallery').attr("src",uploadImageUrl);
        getProduct();   
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");
    })

    function refreshBundling() {
        $("#tableBundling").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getBundling",
                type: "get",
                data:{
                    bd_name:$('#filter_bd_name').val()
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].bd_price_text = formatRupiah(json[i].bd_price,"Rp.");
                        json[i].bd_img_preview = `<img src="${public+json[i].bd_img}" class="me-2" style="width:30px">`+json[i].bd_name;
                        json[i].action=`
                            
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit " data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                            </a>
                        `;
                        json[i].bd_short_desc = json[i].bd_desc;
                        if (json[i].bd_short_desc.length>30){
                            json[i].bd_short_desc = json[i].bd_desc.substr(0,30)+"...";
                        }
                        json[i].bd_qty = JSON.parse(json[i].bd_products).length + " Item(s)";
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
                { data: "bd_img_preview", className: "text-left"},
                { data: "bd_price_text", className: "text-left"},
                { data: "bd_short_desc", className: "text-left"},
                { data: "bd_qty", className: "text-left"},
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

        let table1 = $("#tableBundling").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertBundling";
        var valid=1;

        $("#modalInsert .fill").each(function(){
            if($(this).val()==null||$(this).val()=="null"||$(this).val()==""){
                valid=-1;
                $(this).addClass('is-invalid');
            }
        });

        if(bundling.length<=0){
            notifikasi('error', "Gagal Insert", 'Minimal 1 Product dipilih!');
            ResetLoadingButton('.btn-save', 'Save changes');
            return false;
        }

        if(valid==-1){
            notifikasi('error', "Gagal Insert", 'Silahkan cek kembali inputan anda');
            ResetLoadingButton('.btn-save', 'Save changes');
            return false;
        };

        param = {
            bd_name:$('#bd_name').val(),
            bd_price:convertToAngka($('#bd_price').val()),
            bd_desc:$('#bd_desc').val(),
            bd_products:JSON.stringify(bundling),
            _token:token
        };

        if(mode==2){
            url="/admin/updateBundling";
            param.bd_id = $('#modalInsert').attr("bd_id");
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
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Bundling");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Bundling");
        refreshBundling();
    }


    $(document).on("keyup","#filter_bd_name",function(){
        refreshBundling();
    });


    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableBundling').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsert .modal-title').html("Add Edit Bundling");
        $('#modalInsert input').empty().val("");
        $('#bd_name').val(data.bd_name);
        $('#bd_desc').val(data.bd_desc);
        $('#bd_price').val(formatRupiah(data.bd_price));
        $('.preview_gallery').attr("src",public+data.bd_img);
        bundling = JSON.parse(data.bd_products);
        getProduct(2);
        $('#modalInsert').modal("show");
        $('#modalInsert').attr("bd_id", data.bd_id);
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableBundling').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Bundling ini?","btn-delete-Bundling");
        $('#btn-delete-Bundling').attr("bd_id", data.bd_id);
    });


    $(document).on("click","#btn-delete-Bundling",function(){
        $.ajax({
            url:"/admin/deleteBundling",
            data:{
                bd_id:$('#btn-delete-Bundling').attr('bd_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshBundling();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Bundling");
                
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

    $(document).on("keyup","#search_product",function(){
        var search = $(this).val();
        $(".card-menu").hide();
        $(".no-found").remove();
        product.forEach((item,index) => {
            console.log(item.pr_name.toLowerCase().indexOf(search.toLowerCase()));
            if(item.pr_name.toLowerCase().indexOf(search.toLowerCase())>=0|| item.pr_sku.toLowerCase().indexOf(search.toLowerCase())>=0){
                $(".row-product .card-menu").eq(index).show();
            }
        });
        if($('.card-menu:visible').length==0){
            $(".row-product").append(`
                <div class="col-12 text-center no-found">
                    <p class="text-muted"><span class="mdi mdi-archive-remove-outline"></span> No products found</p>
                </div>
            `);
        }
    });

    $(document).on("click",".card-menu",function(){
        var index = $(this).attr("idx");
        $(this).toggleClass("card-select");
        if($(this).hasClass("card-select")){
            var idxs = -1;
            bundling.forEach((item,idx) => {
                if(item == product[index].pr_id){
                    console.log("masukkkk");
                    idxs = 1;
                }
            });
            
            if(idxs==-1)bundling.push(product[index].pr_id);
               console.log(bundling);
        }
        else{
            bundling.forEach((item,idx) => {
                if(item == product[index].pr_id) bundling.splice(idx,1);
            });
        }
        var total = $('.card-select').length;
        $('#totalSelected').html(`(${total} Items)`);
    });

    function getProduct (type=1) {//1 = Add, 2 = Edit
        $.ajax({
            url:"/admin/getProduct",
            data:{
                _token:token
            },
            method:"get",
            success:function(e){
                product = JSON.parse(e);
                refreshProduct();
                if(type==2){
                    console.log("testtt");
                    
                    bundling.forEach(item => {
                        $('.card-menu').each(function(){
                            var element = $(this);
                            var idx = $(this).attr("idx");
                            console.log(item,product[idx]);
                            
                            if(product[idx].pr_id == item){
                                element.trigger("click");
                            }
                        });
                    });
                }
            },
            error:function(e){
                console.log(e);
            }
        });
    }

    function refreshProduct() {
        $(".row-product").html("");
        product.forEach((item,index) => {
            $(".row-product").append(`
                <div class="col-6">
                    <div class="card card-menu" idx="${index}" >
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-5">
                                <div  style="background-image: url('${public+item.pr_img}'); background-size: cover; background-position: center;height:90px;border-radius: 10px"></div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body p-3 ps-2">
                                    <h6 class="card-title mb-1" style="font-size: 11pt">${item.pr_name}</h6>
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="card-text"><small class="text-muted"><span class="mdi mdi-archive-outline"></span> ${item.pr_stock}</small></p>
                                        </div>
                                        <div class="col-8 text-start pe-0">
                                            <p class="card-text"><small class="text-muted">${formatRupiah(item.pr_price,"Rp.")}</small></p>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            `);
        });
    }