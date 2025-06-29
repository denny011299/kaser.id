    var mode=1;
    var variants = [];
    refreshStaff();
    autocompleteCategoryStaff('#filter_category_id');
    autocompleteCategoryStaff('#category_id','#modalInsert');

    $(document).on('click','.btnAdd',function(){
        mode=1;
        $('.preview_gallery').attr("src",uploadImageUrl);
        $('.preview_gallery_ktp').attr("src",uploadImageUrl);
        $('#input_file_galery').val("");
        $('#modalInsert input').val("");
        $('#modalInsert #category_id').empty();
        $('#modalInsert #st_gender').val("Male");
        $('#modalInsert #st_religion').val("Islam");
        $('#modalInsert .modal-title').html("Add New Staff");
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");

        // Untuk confirm password & password
        $('#labelPasswordOld').html("Password*");
        $('#password').html(`
            <label for="">Confirm Password*</label>
            <input type="password" class="form-control fill" id="confirm_password" placeholder="">
        `);

        $(document).on('change', '#st_birthdate', function(){
            var umur = calculateAge($('#st_birthdate').val());
            $('#st_age').val(umur);
        })
    })

 

    function refreshStaff() {
        $("#tableStaff").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getStaff",
                type: "get",
                data:{
                    st_name:$('#filter_st_name').val(),
                    category_id:$('#filter_category_id').val()
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].st_name_img = `<img src="${public+json[i].st_profile}" class="me-2" style="width:30px; height:30px; border-radius:100%">`+json[i].st_name;
                        
                        json[i].action=`
                            
                            <a href="/admin/staffDetail/${json[i].st_id}" aria-label="anchor" class="btn btn-sm bg-info-subtle me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit">
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
                { data: "st_name_img", className: "text-left"},
                { data: "cs_name", className: "text-left"},
                { data: "st_nomer", className: "text-left"},
                { data: "st_email", className: "text-left"},
                { data: "st_gender", className: "text-left"},
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

        let table1 = $("#tableStaff").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertStaff";
        var valid=1;

        $("#modalInsert .fill").each(function(){
            if($(this).val()==null||$(this).val()=="null"||$(this).val()==""){
                valid=-1;
                console.log($(this))
                $(this).addClass('is-invalid');
            }
        });

        if (mode == 1){
            if ($('#confirm_password').val() != $('#st_password').val()){
                valid = -1;
                $('#st_password').addClass('is-invalid');
                $('#confirm_password').addClass('is-invalid');
            }
        }
        
        if(valid==-1){
            notifikasi('error', "Gagal Insert", 'Silahkan cek kembali inputan anda');
            ResetLoadingButton('.btn-save', 'Save changes');
            return false;
        };
        
        if ($('.preview_gallery').attr('src') == uploadImageUrl && $('.preview_gallery_ktp').attr('src') == uploadImageUrl){
            notifikasi('error', "Gagal Insert", 'Wajib upload profile & ktp'); 
            ResetLoadingButton('.btn-save', 'Save changes');
            return false;
        }
        
        param = {
            st_name:$('#st_name').val(),
            st_nomer:$('#st_nomer').val(),
            st_address:$('#st_address').val(),
            st_email:$('#st_email').val(),
            cs_id:$('#category_id').val(),
            st_gender:$('#st_gender').val(),
            st_nik:$('#st_nik').val(),
            st_religion:$('#st_religion').val(),
            st_birthdate:$('#st_birthdate').val(),
            st_age:$('#st_age').val(),
            st_username:$('#st_username').val(),
            st_password: $('#st_password').val(),
            st_new_password: ($('#st_new_password').val() != "" ? $('#st_new_password').val() : ""),
             _token:token
        };

        if(mode==2){
            url="/admin/updateStaff";
            param.st_id = $('#modalInsert').attr("st_id");

            if ($('#st_new_password').val() != ""){
                if ($('#st_new_password').val() == $('#st_password').val()){
                    notifikasi('error', "Gagal Insert", 'Password baru tidak boleh sama dengan lama');
                    $('#st_password').addClass('is-invalid');
                    $('#st_new_password').addClass('is-invalid');
                    ResetLoadingButton('.btn-save', 'Save changes');
                    return false;
                }
            }
        }

        //convert data -> form data
        const fd = new FormData();
        for (const [key, value] of Object.entries(param)) {
            fd.append(key, value);
        }
        console.log($('#input_file_img')[0].files[0])
        fd.append('profile', $('#input_file_img')[0].files[0]);
        fd.append('ktp', $('#input_file_img_ktp')[0].files[0]);
        
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
                if (e.message) {
                    notifikasi('error', "Gagal Edit", e.message);
                    $('#st_password').addClass('is-invalid');
                } else{
                    afterInsert();
                }
            },
            error:function(e){
                ResetLoadingButton(".btn-save", 'Save changes');
                console.log(e);
            }
        });
    });

    function afterInsert() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Staff");
        else if(mode==2)notifikasi('success', "Berhasil Update", "Berhasil update Staff");
        refreshStaff();
    }
    
    $(document).on("keyup","#filter_st_name",function(){
        refreshStaff();
    });
    $(document).on("change","#filter_category_id",function(){
        refreshStaff();
    });

    //edit
    $(document).on("click",".btn_edit",function(){
        var data = $('#tableStaff').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert .modal-title').html("Edit Staff");
        mode=2;
        $('#modalInsert input').val("");
        $('.preview_gallery').attr("src",public+data.st_profile),
        $('#gallery_id').val(public+data.st_profile),
        $('.preview_gallery_ktp').attr("src",public+data.st_ktp),
        $('#gallery_id_ktp').val(public+data.st_ktp),
        $('#st_name').val(data.st_name),
        $('#st_nomer').val(data.st_nomer),
        $('#st_address').val(data.st_address),
        $('#st_email').val(data.st_email),
        $('#category_id').append(`<option value="${data.cs_id}">${data.cs_name}</option>`),
        $('#st_gender').val(data.st_gender),
        $('#st_nik').val(data.st_nik),
        $('#st_religion').val(data.st_religion),
        $('#st_birthdate').val(data.st_birthdate),
        $('#st_age').val(data.st_age),
        $('#st_username').val(data.st_username),
        $('#modalInsert').modal("show");
        $('#modalInsert').attr("st_id", data.st_id);

        // Ubah jadi Old Password & New Password
        $('#labelPasswordOld').html("Old Password*");
        $('#password').html(`
            <label for="">New Password</label>
            <input type="password" class="form-control" id="st_new_password" placeholder="">
        `);

        // Hitung Umur
        $(document).on('change', '#st_birthdate', function(){
            var umur = calculateAge($('#st_birthdate').val());
            $('#st_age').val(umur);
        })
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableStaff').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Staff ini?","btn-delete-staff");
        $('#btn-delete-staff').attr("st_id", data.st_id);
    });

    $(document).on("click","#btn-delete-staff",function(){
        $.ajax({
            url:"/admin/deleteStaff",
            data:{
                st_id:$('#btn-delete-staff').attr('st_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshStaff();
                notifikasi('success', "Berhasil Delete", "Berhasil delete staff ");
                
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


