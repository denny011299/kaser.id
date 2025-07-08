    var mode=1;

    refreshStockOpname();

    function refreshStockOpname() {
        $("#tableStockOpname").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getStockOpname",
                type: "get",
                data:{
                    stp_date:$('#filter_stp_date').val(),
                    stp_nomer:$('#filter_stp_nomer').val(),
                    stp_type:stp_type
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].stp_date_text = moment(json[i].stp_date).format('D MMM YYYY');
                        json[i].action=`
                            
                            <a href="/admin/viewStockOpname/${json[i].stp_id}/${stp_type}" aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_view" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-eye-outline fs-14 text-primary"></i>
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
                { data: "stp_date", className: "text-left"},
                { data: "stp_nomer", className: "text-left"},
                { data: "created_by", className: "text-left"},
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

        let table1 = $("#tableStockOpname").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }


    $(document).on("keyup","#filter_stp_nomer",function(){
        refreshStockOpname();
    });
    $(document).on("change","#filter_stp_date",function(){
        refreshStockOpname();
    });

    //delete
    $(document).on("click",".btn_delete",function(){
        var data = $('#tableStockOpname').DataTable().row($(this).parents('tr')).data();//ambil data dari table
        showModalDelete("Apakah yakin ingin mengahapus Stock Opname ini?","btn-delete-stock-opname");
        $('#btn-delete-stock-opname').attr("stp_id", data.stp_id);
    });


    $(document).on("click","#btn-delete-stock-opname",function(){
        $.ajax({
            url:"/admin/deleteStockOpname",
            data:{
                stp_id:$('#btn-delete-stock-opname').attr('stp_id'),
                _token:token
            },
            method:"post",
            success:function(e){
                $('.modal').modal("hide");
                refreshStockOpname();
                notifikasi('success', "Berhasil Delete", "Berhasil delete Stock Opname");
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
