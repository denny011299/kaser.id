    refreshCoaCategory();
    autocompleteCoaCategory('#filter_coa_cc_name');
    autocompleteCoa('#filter_sc_coa_name');

    autocompleteCoaCategory('#coa_cc_name', '#modalInsertCoa');
    autocompleteCoa('#sc_coa_name', '#modalInsertSub');

    var mode=1;

    $(document).on("click",".menu",function(){
        console.log();
        var menu = $(this).attr("menu");
        if(menu==1) refreshCoaCategory();
        else if(menu==2) refreshCoa();
        else if(menu==3) refreshSubCoa();
    }); 

    function refreshCoaCategory() {
        $("#tableCoaCategory").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getCoaCategory",
                type: "get",
                data:{
                    cc_kode:$('#filter_cc_kode').val(),
                    cc_nama:$('#filter_cc_nama').val(),
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].action=`
                            
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit_category" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete_category" data-bs-toggle="tooltip" data-bs-original-title="Delete">
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
                { data: "cc_kode", className: "text-start"},
                { data: "cc_nama", className: "text-start"},
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
        let table1 = $("#tableCoaCategory").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    function refreshCoa() {
        $("#tableCoa").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getCoa",
                type: "get",
                data:{
                    coa_kode:$('#filter_coa_kode').val(),
                    coa_nama:$('#filter_coa_nama').val(),
                    cc_id:$('#filter_coa_cc_name').val(),
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].cc_nama_text = json[i].cc_kode + " - " + json[i].cc_nama;
                        json[i].action=`
                            
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit_coa" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete_coa" data-bs-toggle="tooltip" data-bs-original-title="Delete">
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
                { data: "coa_kode", className: "text-start"},
                { data: "coa_nama", className: "text-start"},
                { data: "cc_nama_text", className: "text-start"},
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
        let table1 = $("#tableCoa").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    function refreshSubCoa() {
        $("#tableSubCoa").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getSubCoa",
                type: "get",
                data:{
                    sc_kode:$('#filter_sc_kode').val(),
                    sc_nama:$('#filter_sc_nama').val(),
                    coa_id:$('#filter_sc_coa_name').val(),
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].coa_nama_text = json[i].coa_kode + " - " + json[i].coa_nama;
                        json[i].action=`
                            <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit_sub" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                            </a>
                            <a aria-label="anchor" class="btn btn-sm bg-danger-subtle btn_delete_sub" data-bs-toggle="tooltip" data-bs-original-title="Delete">
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
                { data: "sc_kode", className: "text-left"},
                { data: "sc_nama", className: "text-left"},
                { data: "coa_nama_text", className: "text-left"},
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

        let table1 = $("#tableSubCoa").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }


    $(document).on("click",".btn-add-category",function(){
        mode = 1;
        $('#modalInsertCategory input').val("");
        $('#modalInsertCategory #cc_coa').empty();
        $('#modalInsertCategory').modal("show");
    });
    
    $(document).on("click",".btn-add-coa",function(){
        mode = 1;
        $('#modalInsertCoa input').val("");
        $('#modalInsertCoa #coa_id').empty();
        $('#modalInsertCoa select').empty();
        $('#modalInsertCoa').modal("show");
    });

    $(document).on("click",".btn-add-sub",function(){
        mode = 1;
        $('#modalInsertSub input').val("");
        $('#modalInsertSub #sc_id').empty();
        $('#modalInsertSub select').empty();
        $('#modalInsertSub').modal("show");
    });


    //edit category
    $(document).on("click",".btn_edit_category",function(){
        var data = $('#tableCoaCategory').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsertCategory .modal-title').html("Edit Category Coa");
        $('#modalInsertCategory input').empty().val("");
        $('#cc_kode').val(data.cc_kode);
        $('#cc_nama').val(data.cc_nama);
        console.log(data);
        
        $('#modalInsertCategory').modal("show");
        $('#modalInsertCategory').attr("cc_id", data.cc_id);
    });

    //edit coa
    $(document).on("click",".btn_edit_coa",function(){
        var data = $('#tableCoa').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsertCoa .modal-title').html("Edit COA");
        $('#modalInsertCoa input').empty().val("");
        $('#coa_cc_name').empty().append(`<option value="${data.cc_id}">${data.cc_kode} - ${data.cc_nama}</option>`);
        $('#coa_kode').val(data.coa_kode);
        $('#coa_nama').val(data.coa_nama);
        console.log(data);
        console.log(data.cc_id)
        
        $('#modalInsertCoa').modal("show");
        $('#modalInsertCoa').attr("coa_id", data.coa_id);
    });

    //edit sub coa
    $(document).on("click",".btn_edit_sub",function(){
        var data = $('#tableSubCoa').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        mode=2;
        $('#modalInsertSub .modal-title').html("Edit Sub COA");
        $('#modalInsertSub input').empty().val("");
        $('#sc_coa_name').empty().append(`<option value="${data.coa_id}">${data.coa_nama_text}</option>`);
        $('#sc_kode').val(data.sc_kode);
        $('#sc_nama').val(data.sc_nama);
        console.log(data);
        
        $('#modalInsertSub').modal("show");
        $('#modalInsertSub').attr("sc_id", data.sc_id);
    });


    //insert category
    $(document).on("click",".btn-save-category",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertCoaCategory";
        var valid=1;
        
        $("#modalInsertCategory .fill").each(function(){
            if($(this).val()==null||$(this).val()=="null"||$(this).val()==""){
                valid=-1;
                $(this).addClass('is-invalid');
            }
        });

        if(valid==-1){
            notifikasi('error', "Gagal Insert", 'Silahkan cek kembali inputan anda');
            ResetLoadingButton('.btn-save-category', 'Save changes');
            return false;
        };
        
        param = {
            cc_kode: $('#cc_kode').val(),
            cc_nama: $('#cc_nama').val(),
            _token:token
        };

        if(mode==2){
            url="/admin/updateCoaCategory";
            param.cc_id = $('#modalInsertCategory').attr("cc_id");
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
                ResetLoadingButton(".btn-save-category", 'Save changes');      
                afterInsertCategory();
            },
            error:function(e){
                ResetLoadingButton(".btn-save-category", 'Save changes');
                console.log(e);
            }
        });
    });

    //insert COA
    $(document).on("click",".btn-save-coa",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertCoa";
        var valid=1;
        
        $("#modalInsertCoa .fill").each(function(){
            if($(this).val()==null||$(this).val()=="null"||$(this).val()==""){
                valid=-1;
                $(this).addClass('is-invalid');
            }
        });

        if(valid==-1){
            notifikasi('error', "Gagal Insert", 'Silahkan cek kembali inputan anda');
            ResetLoadingButton('.btn-save-coa', 'Save changes');
            return false;
        };
    
        param = {
            cc_id:$('#coa_cc_name').val(),
            coa_kode:$('#coa_kode').val(),
            coa_nama:$('#coa_nama').val(),
            _token:token
        };

        if(mode==2){
            url="/admin/updateCoa";
            param.coa_id = $('#modalInsertCoa').attr("coa_id");
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
                ResetLoadingButton(".btn-save-coa", 'Save changes');      
                afterInsertCoa();
            },
            error:function(e){
                ResetLoadingButton(".btn-save-coa", 'Save changes');
                console.log(e);
            }
        });
    });

    //insert Sub COA
    $(document).on("click",".btn-save-sub",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertSubCoa";
        var valid=1;
        
        $("#modalInsertSub .fill").each(function(){
            if($(this).val()==null||$(this).val()=="null"||$(this).val()==""){
                valid=-1;
                $(this).addClass('is-invalid');
            }
        });

        if(valid==-1){
            notifikasi('error', "Gagal Insert", 'Silahkan cek kembali inputan anda');
            ResetLoadingButton('.btn-save-sub', 'Save changes');
            return false;
        };
        
        param = {
            coa_id:$('#sc_coa_name').val(),
            sc_kode:$('#sc_kode').val(),
            sc_nama:$('#sc_nama').val(),
            _token:token
        };

        if(mode==2){
            url="/admin/updateSubCoa";
            param.sc_id = $('#modalInsertSub').attr("sc_id");
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
                ResetLoadingButton(".btn-save-sub", 'Save changes');      
                afterInsertSub();
            },
            error:function(e){
                ResetLoadingButton(".btn-save-sub", 'Save changes');
                console.log(e);
            }
        });
    });

    function afterInsertCategory() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Category COA");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Category COA");
        refreshCoaCategory();
    }

    function afterInsertCoa() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah COA");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update COA");
        refreshCoa();
    }

    function afterInsertSub() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah sub COA");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update sub COA");
        refreshSubCoa();
    }

     //delete
    $(document).on("click",".btn_delete_category",function(){
        var data = $('#tableCoaCategory').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus category ini?","btn-delete-category");
        $('#btn-delete-category').attr("cc_id", data.cc_id);
    });


    $(document).on("click","#btn-delete-category",function(){
        $.ajax({
            url:"/admin/deleteCoaCategory",
            data:{
                cc_id:$('#btn-delete-category').attr('cc_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshCoaCategory();
                notifikasi('success', "Berhasil Delete", "Berhasil delete category");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    //delete COA
    $(document).on("click",".btn_delete_coa",function(){
        var data = $('#tableCoa').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus COA ini?","btn-delete-coa");
        $('#btn-delete-coa').attr("coa_id", data.coa_id);
    });


    $(document).on("click","#btn-delete-coa",function(){
        $.ajax({
            url:"/admin/deleteCoa",
            data:{
                coa_id:$('#btn-delete-coa').attr('coa_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshCoa();
                notifikasi('success', "Berhasil Delete", "Berhasil delete COA");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
    //delete sub COA
    $(document).on("click",".btn_delete_sub",function(){
        var data = $('#tableSubCoa').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus sub COA ini?","btn-delete-sub");
        $('#btn-delete-sub').attr("sc_id", data.sc_id);
    });


    $(document).on("click","#btn-delete-sub",function(){
        $.ajax({
            url:"/admin/deleteSubCoa",
            data:{
                sc_id:$('#btn-delete-sub').attr('sc_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshSubCoa();
                notifikasi('success', "Berhasil Delete", "Berhasil delete sub COA");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    $(document).on('change', '#coa_cc_name', function(){
        console.log($(this).val());
        if ($(this).val() != null && $(this).val() != ""){
            var cc_kode = $(this).select2("data")[0].cc_kode;
            $('#coa_kode').val(cc_kode);
        } else {
            $('#coa_kode').val("");
        }
    })

    $(document).on('change', '#sc_coa_name', function(){
        console.log($(this).val());
        if ($(this).val() != null && $(this).val() != ""){
            var coa_kode = $(this).select2("data")[0].coa_kode;
            console.log($(this).select2("data")[0])
            $('#sc_kode').val(coa_kode);
        } else {
            $('#sc_kode').val("");
        }
    })

    // Filter
    $(document).on("keyup","#filter_cc_kode",function(){
        refreshCoaCategory();
    });
    $(document).on("keyup","#filter_cc_nama",function(){
        refreshCoaCategory();
    });

    $(document).on("keyup","#filter_coa_kode",function(){
        refreshCoa();
    });
    $(document).on("keyup","#filter_coa_nama",function(){
        refreshCoa();
    });
    $(document).on("change","#filter_coa_cc_name",function(){
        refreshCoa();
    });

    $(document).on("keyup","#filter_sc_kode",function(){
        refreshSubCoa();
    });
    $(document).on("keyup","#filter_sc_nama",function(){
        refreshSubCoa();
    });
    $(document).on("change","#filter_sc_coa_name",function(){
        refreshSubCoa();
    });