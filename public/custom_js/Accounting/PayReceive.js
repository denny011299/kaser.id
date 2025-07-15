    refreshPayables();
    autocompleteSupplier('#filter_spo_company');
    autocompleteCustomer('#filter_so_company');

    var mode=1;

    $(document).on("click",".menu",function(){
        var menu = $(this).attr("menu");
        if(menu==1) refreshPayables();
        else if(menu==2) refreshReceiveables();
    }); 

    function refreshChartPayable(){
        $.ajax({
            url: '/admin/getPayablesData',
            method: 'GET',
            success: function (data) {
                const categories = data.map(item => item.date);
                const seriesData = data.map(item => parseInt(item.total));

                const options = {
                    chart: {
                        type: 'line',
                        height: 200
                    },
                    series: [{
                        name: 'Total Payables',
                        data: seriesData
                    }],
                    xaxis: {
                        categories: categories,
                        title: {
                            text: 'Tanggal'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah (Rp)'
                        }
                    },
                    colors: ['#E7366B']
                };

                const chart = new ApexCharts(document.querySelector("#conversion-visitors"), options);
                chart.render();
            },
            error: function (xhr, status, error) {
                console.error("Gagal mengambil data payables:", error);
            }
        });
    }

    function refreshPayables() {
        $("#tablePayables").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getPoInvoice",
                type: "get",
                data:{
                    list_status:['Unpaid', 'Half Paid'],
                    spoi_nomer:$('#filter_spoi_nomer').val(),
                    spo_to_company:$('#filter_spo_company option:selected').text().trim()
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].action=`
                            <a href="/admin/PurchaseOrderDetail/${json[i].spo_id}" aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_view " data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-eye-outline fs-14 text-info"></i>
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
                { data: "spoi_date", className: "text-start"},
                { data: "spo_nomer", className: "text-start"},
                { data: "spoi_nomer", className: "text-start"},
                { data: "spo_to_company", className: "text-start"},
                { data: "spoi_total", className: "text-center"},
                { data: "spoi_status", className: "text-start"},
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
        let table1 = $("#tablePayables").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    function refreshReceiveables() {
        $("#tableReceiveables").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getSoInvoice",
                type: "get",
                data:{
                    list_status:['Unpaid', 'Half Paid'],
                    soi_nomer:$('#filter_soi_nomer').val(),
                    so_to_company:$('#filter_so_company option:selected').text().trim()
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        
                        json[i].action=`
                            
                            <a href="/admin/SalesOrderDetail/${json[i].so_id}" aria-label="anchor" class="btn btn-sm bg-primary-subtle me-2 btn_view " data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="mdi mdi-eye-outline fs-14 text-info"></i>
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
                { data: "soi_date", className: "text-start"},
                { data: "soi_due_date", className: "text-start"},
                { data: "so_nomer", className: "text-start"},
                { data: "soi_nomer", className: "text-start"},
                { data: "so_to_company", className: "text-start"},
                { data: "soi_total", className: "text-center"},
                { data: "soi_status", className: "text-start"},
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
        let table1 = $("#tableReceiveables").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }


    //View
    $(document).on("click",".btn_view",function(){
        localStorage.setItem("activeTab", "#messages");
    });


    // Filter
    $(document).on("keyup","#filter_spoi_nomer",function(){
        refreshPayables();
    });
    $(document).on("change","#filter_spo_company",function(){
        refreshPayables();
    });

    $(document).on("keyup","#filter_soi_nomer",function(){
        refreshReceiveables();
    });
    $(document).on("change","#filter_so_company",function(){
        refreshReceiveables();
    });