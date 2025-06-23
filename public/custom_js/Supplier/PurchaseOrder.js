autocompleteSupplier("#filter_sp_id",null);
refreshPurchaseOrder();
  

    function refreshPurchaseOrder() {
        $("#tablePurchaseOrder").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getPurchaseOrder",
                type: "get",
                data:{
                    sp_id:$('#filter_sp_id').val(),
                    spo_nomer:$('#filter_nomer').val(),
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].spo_tanggal_text = moment(json[i].spo_tanggal).format('D MMM YYYY');
                        json[i].spo_total = formatRupiah(json[i].spo_total,"Rp.");
                        json[i].action=`
                            
                            <a href="/admin/PurchaseOrderDetail/${json[i].spo_id}" aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit " data-bs-toggle="tooltip" data-bs-original-title="Edit">
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
                { data: "spo_nomer", className: "text-left"},
                { data: "spo_tanggal_text", className: "text-left"},
                { data: "supplier_name", className: "text-left"},
                { data: "spo_total", className: "text-left"},
                { data: "spo_status", className: "text-center"},
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

        let table1 = $("#tablePurchaseOrder").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("keyup","#filter_nomer",function(){
        refreshPurchaseOrder();
    });

    $(document).on("change","#filter_sup_id",function(){
        refreshPurchaseOrder();
    });


    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tablePurchaseOrder').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Purchase Order ini?","btn-delete-PurchaseOrder");
        $('#btn-delete-PurchaseOrder').attr("spo_id", data.spo_id);
    });



    $(document).on("click","#btn-delete-PurchaseOrder",function(){
        $.ajax({
            url:"/admin/deletePurchaseOrder",
            data:{
                spo_id:$('#btn-delete-PurchaseOrder').attr('spo_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshPurchaseOrder();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Purchase Order ");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });

