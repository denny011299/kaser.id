    var mode=1;
    refreshProduct();
    autocompleteCategory("#filter_c_id",null);

    function refreshProduct() {
        $("#tableProduct").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getProduct",
                type: "get",
                data:{
                    pr_name:$('#filter_pr_name').val(),
                    pr_sku:$('#filter_pr_sku').val()
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                         json[i].pr_name_text = `<img src="${public+json[i].pr_img}" class="me-2" style="width:30px">`+json[i].pr_name;
                        json[i].pr_price_text = formatRupiah(json[i].pr_price+"","Rp.");
                        json[i].action=`
                            
                            <a aria-label="anchor" href="/admin/updateProduct/${json[i].pr_id}" class="btn btn-sm bg-primary-subtle me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit">
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
                { data: "pr_sku", className: "text-start"},
                { data: "pr_name_text", className: "text-start"},
                { data: "c_name", className: "text-center"},
                { data: "pr_price_text", className: "text-end"},
                { data: "pr_stock", className: "text-center"},
                { data: "action", className: "text-start"},
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


    $(document).on("keyup","#filter_pr_sku, #filter_pr_name",function(){
        refreshProduct();
    });
    $(document).on("change","#filter_c_id",function(){
        refreshProduct();
    });
   

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableProduct').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus product ini?","btn-delete-Product");
        $('#btn-delete-Product').attr("pr_id", data.pr_id);
    });


    $(document).on("click","#btn-delete-Product",function(){
        $.ajax({
            url:"/admin/deleteProduct",
            data:{
                pr_id:$('#btn-delete-Product').attr('pr_id'),
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
