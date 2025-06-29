    var product;
    var cart=[];
    var mode=1;
    var type=1;//1=Product, 2 = bahan baku
    var subtotal=0,ppn=0,grand=0;
    reset();
    autocompleteCustomer("#cus_id",null,0);
    $('#order_date').val(getCurrentDate());

    function getProduct (type=1) {
        loading(".row-product");
        $.ajax({
            url:"/admin/getCustomerPrice",
            data:{
                cus_id:$('#cus_id').val(),
                type:type,
                _token:token
            },
            method:"get",
            success:function(e){
                product = JSON.parse(e);
                if(product.length>0)refreshProduct();
                else {
                    $('.loading').remove();
                    notFound();
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
            console.log(item);
            var img=`<img class="card-img  rounded" src="${public+item.pr_img}" alt="Card image">`;
           
            $(".row-product").append(`
                <div class="card card-item" idx="${index}" >
                    <div class="card-body p-2 pt-1">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-4">
                                ${img}
                            </div>
                            <div class="col-md-8 pt-2">
                                <h5 class="card-title mb-1" style="font-size:11pt;">${item.pr_name}</h5>
                                <p class="text-muted" style="font-size:8pt;">${item.pr_deskripsi}</p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <p class="card-text fw-bold" style="font-size:12pt"><small class="text-muted">Rp.</small>${formatRupiah(item.pr_price)}</p>
                            </div>
                            <div class="col-6 text-end ">
                                <button class="btn btn-outline-primary btn-sm btn-add-to-cart" index="${index}" type="button" style="border-radius:100px;">+ Add To Cart</button>
                            </div>
                        </div>
                    </div>
                    
                 </div>
            `);
        });
        
    }

    $(document).on("click",".btn-add-to-cart",function () {
        var index = $(this).attr("index");

        if(product[index].list_variasi&&product[index].list_variasi.length>0){
            //ada variant
            $('#modal-img').attr("src",public+product[index].pr_img);
            $('#modal-item-title').html(product[index].pr_name);
            $('#modal-item-desc').html(product[index].pr_deskripsi);
            product[index].variant = reStruktur(product[index]);// variant itu yang sudah dikelompokan
            refreshVariasi(product[index].variant);
            $('.btn-add-item').attr("index",index);
            $('#modalVariant').modal("show");
        }
        else{
            
            insertNewData(product[index]);
        }
    });
    function reStruktur(data) {
        var variasi = [];
        console.log("Data :");
        console.log(data);
        
        data.list_variasi.forEach(item => {
            var ada=-1;
            variasi.forEach((element,index) => {
                if(element.pv_id == item.pv_id){
                    ada = index;
                }
            });
            if(ada==-1){
                variasi.push({
                    pv_id:item.pv_id,
                    pv_name:item.pv_name,
                    list:[{
                        "pv_id":item.pv_id,
                        "pvs_id":item.pvs_id,
                        "pvs_name":item.pvs_name,
                    }]
                })
            }
            else{
                variasi[ada].list.push({
                    "pv_id":item.pv_id,
                    "pvs_id":item.pvs_id,
                    "pvs_name":item.pvs_name,
                })
            }
        });
        console.log(variasi);
        
        return variasi;
    }
    function refreshVariasi(variant) {
        $('#container-variant').html("");
        variant.forEach(item => {
            var vt = "";
            item.list.forEach((element,index) => {
                vt += `
                    <input type="radio" class="btn-check btn-variant" name="${item.pv_id}" pv_id="${item.pv_id}" id="${element.pvs_id}" value="${element.pvs_name}" autocomplete="off" ${index==0?'checked=""':""}>
                    <label class="btn btn-outline-primary" for="${element.pvs_id}">${element.pvs_name}</label>         
                `;
            });
            var bg = `
                <div class="btn-group row-variant-item" role="group" aria-label="Basic radio toggle button group">
                    ${vt}
                </div>
            `;
            $('#container-variant').append(`
                <div class="col-6 row-variant">
                    <h6>${item.pv_name} </h6>
                        ${bg}
                    
                </div>
            `);
        });
    }

    $(document).on("click",".btn-add-item",function () {
        var index = $(this).attr("index");
        insertNewData(product[index]);
    });
    
    function insertNewData(data) {
        var idx = -1;
        var newMenuVariantSelected = [];
        var newNamaMenuVariantSelected = "";
       
        
        if(data.variant&&data.variant.length >0){
            $(`.row-variant-item .btn-variant:checked`).each(function(){
                newMenuVariantSelected.push($(this).attr("id"));
                newNamaMenuVariantSelected += ` <small class="muted"> - ${$(this).attr("value")} </small><br>`;
            });
        }
        cart.forEach((item,index) => {
            if(data.pr_name&&item.name == data.pr_name  || data.sup_id&&item.sup_id == data.sup_id){
                idx = index;
                if(data.variant&&data.variant.length>0){
                    item.variant.forEach(itemVariasi => {
                        if($.inArray(itemVariasi,newMenuVariantSelected)==-1){ 
                            console.log("Variasi :"+itemVariasi);
                            
                            idx=-1
                        };
                    });
                    console.log("IDX : "+idx);
                       
                }
            }
        });
        if(idx==-1){
            cart.push({
                "fullname":data.pr_name+(newNamaMenuVariantSelected!=""?"<br>"+newNamaMenuVariantSelected:""),
                "pr_id":data.pr_id,
                "name":data.pr_name,
                "price":data.pr_price,
                "type":type,
                "variant":newMenuVariantSelected.length>0?newMenuVariantSelected:null,
                "qty":1,
                "subtotal":data.pr_price,
            })
        }
        else{
            cart[idx].qty++;
            cart[idx].subtotal = cart[idx].qty*cart[idx].price;

        }
        refreshList();
        $('.modal').modal("hide");
        toastr.success('', 'Successfully Added Item');
    }
    $(document).on("click",".btn-plus",function () {
        let index = $(this).attr("index");
        let input = $(this).siblings(".qty-input");
        let val = parseInt(input.val()) || 0;
        input.val(val + 1);
        cart[index].qty++;
        cart[index].subtotal = cart[index].qty*cart[index].price;
        
        refreshList();
    });

    $(document).on("click",".btn-minus",function () {
        let index = $(this).attr("index");
        let input = $(this).siblings(".qty-input");
        let val = parseInt(input.val()) || 0;
        
        if (val-1 > 0) {
            input.val(val - 1);
            cart[index].qty--;
            cart[index].subtotal = cart[index].qty*cart[index].price;
        }
        else{
            cart.splice(index,1);
        }
         refreshList();
    });
    
    $(document).on("change","#cus_id",function () {
        var dt = $(this).select2("data")[0];
        cart = [];
        refreshList();
        if (dt) {
            $('#text_to_name').html(dt.cus_name);
            $('#text_to_address').html(dt.cus_address);
            $('#text_to_nomor').html(dt.cuss_nomer);
            getProduct(type);
        } else {
            // Saat di-clear
            $('#text_to_name').html('-');
            $('#text_to_address').html('-');
            $('#text_to_nomor').html('-');
        }
    });

    $(document).on("keyup","#sign_by",function () {
        $('#text_sign_by').html($(this).val());
    });

    
    $(document).on("keyup","#search",function () {
        var search = $(this).val();
        $('.not-found').remove();
        if(search!=""){
            $('.card-item').hide();
            $('.card-item').each(function(){
                var idx =$(this).attr("idx");
                if(product[idx].pr_name.toLowerCase().includes(search.toLowerCase())){
                        $(this).show();
                    }
                    if(product[idx].pr_sku.toLowerCase().includes(search.toLowerCase())){
                        $(this).show();
                    }
                    if(search == product[idx].pr_barcode){
                        $(this).show();
                    }
            });
            console.log($('.card-item:visible').length);
            
            if($('.card-item:visible').length<=0){
               notFound();
            }
        }
        else{
            if($('.card-item').length>0)$('.card-item').show();
            else notFound();
        }
    });
    
    function notFound() {
        $('.row-product').append(`
            <div class="text-center not-found mt-5 pt-5" style="color:#93c3e0;">
                <span class="mdi mdi-archive-remove" style="font-size:56pt"></span>
                <h5 class="mt-0" style="margin-top:-10px!important">Item Not Found</h5>
            </div>    
        `);
    }
    function refreshList() {
        $('#tbDetail').html("");
        var total =0;
        cart.forEach((item,index) => {
            $('#tbDetail').append(`
                <tr>
                    <td>
                        <div class="input-group  quantity-control justify-content-center">
                            <button class="btn btn-outline-secondary btn-sm btn-minus" index="${index}" type="button">−</button>
                            <input type="text" class="form-control text-center qty-input" value="${item.qty}" min="0">
                            <button class="btn btn-outline-secondary btn-sm btn-plus" index="${index}" type="button">+</button>
                        </div>
                    </td>
                    <td>${item.fullname}</td>
                    <td class="text-end">${formatRupiah(item.price,"Rp.")}</td>
                    <td class="text-end">${formatRupiah(item.subtotal,"Rp.")}</td>
                </tr>
            `);
            total += item.subtotal;
        });
        console.log(total);
        subtotal = total;
        ppn = (total*0.11);
        grand = total+(total*0.11);
        $('#total_value').html(formatRupiah(subtotal,"Rp."));
        $('#ppn_value').html(formatRupiah(ppn,"Rp."));
        $('#grandTotal_value').html(formatRupiah(grand,"Rp."));
    }

    $(document).on("click","#btn-save",function(){
         LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertSalesOrder";
        var valid=1;

        $(".fill").each(function(){
            if($(this).val()==null||$(this).val()=="null"||$(this).val()==""){
                valid=-1;
                $(this).addClass('is-invalid');
            }
        });


        if(valid==-1){
            ResetLoadingButton('#btn-save', 'Save changes');
            return false;
        };

        param = {
            so_tanggal:$('#order_date').val(),
            so_sign_by:$('#sign_by').val(),
            so_total:grand,
            so_type:type,
            so_total_ppn:ppn,
            cus_id:$('#cus_id').val(),
            list_product:JSON.stringify(cart),
             _token:token
        };

        if(mode==2){
            url="/admin/updateSalesOrder";
            param.spo_id = $('#modalInsert').attr("spo_id");
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
                ResetLoadingButton("#btn-save", 'Save changes');      
                afterInsert(e);
            },
            error:function(e){
                ResetLoadingButton("#btn-save", 'Save changes');
                console.log(e);
            }
        });
    });
    function afterInsert(id) {
        window.location.href ="/admin/SalesOrderDetail/"+id;
    }

    function loading(id) {
        $(id).html(`
            <div class="text-center mt-5 pt-5 loading">
                <div class="spinner-grow text-primary m-2 mx-auto" role="status" style="width: 6rem; height: 6rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>    
            </div>
        `);
    }

    function reset() {
        $(".row-product").html(`
            <div class="text-center not-found mt-5 pt-5" style="color:#93c3e0;">
                <span class="mdi mdi-domain" style="font-size:56pt"></span>
                <h5 class="mt-0" style="margin-top:-10px!important">Select Customer First</h5>
            </div>    
        `);
    }