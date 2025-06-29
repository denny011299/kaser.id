autocompleteCustomer("#filter_cus_id",null);
refreshSalesOrder();
  

    function refreshSalesOrder() {
        $("#tableSalesOrder").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getSalesOrder",
                type: "get",
                data:{
                    cus_id:$('#filter_cus_id').val(),
                    so_nomer:$('#filter_nomer').val(),
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].so_tanggal_text = moment(json[i].so_tanggal).format('D MMM YYYY');
                        json[i].so_total = formatRupiah(json[i].so_total,"Rp.");
                        json[i].action=`
                            
                            <a href="/admin/SalesOrderDetail/${json[i].so_id}" aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_edit " data-bs-toggle="tooltip" data-bs-original-title="Edit">
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
                { data: "so_nomer", className: "text-left"},
                { data: "so_tanggal_text", className: "text-center"},
                { data: "customer_name", className: "text-left"},
                { data: "so_total", className: "text-end"},
                { data: "so_status", className: "text-center"},
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

        let table1 = $("#tableSalesOrder").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("keyup","#filter_nomer",function(){
        refreshSalesOrder();
    });

    $(document).on("change","#filter_sup_id",function(){
        refreshSalesOrder();
    });


    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableSalesOrder').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Purchase Order ini?","btn-delete-SalesOrder");
        $('#btn-delete-SalesOrder').attr("so_id", data.so_id);
    });



    $(document).on("click","#btn-delete-SalesOrder",function(){
        $.ajax({
            url:"/admin/deleteSalesOrder",
            data:{
                so_id:$('#btn-delete-SalesOrder').attr('so_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshSalesOrder();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Sales Order ");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });

