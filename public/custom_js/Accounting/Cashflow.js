var mode = 1; //1 = debit, 2 = kredit
    var variants = [];
    refreshCashflow();
    autocompleteKas('#filter_coa');
    autocompleteKas('#je_coa_name', '#modalInsert');


    $(document).on('click','.btnAdd',function(){
        $('#modalInsert input').val("");
        $('#modalInsert .modal-title').html("Add New Cashflow");
        $('#modalInsert #je_coa_name').empty();
        $('.is-invalid').removeClass('is-invalid');
        $('#modalInsert').modal("show");

    })

    $(document).on("change","#btnType",function(){
        mode= $(this).val();
        if($(this).is(":checked")){
            mode = 2;
        } else mode = 1;
        
        if (mode == 1){
            $('.catatan').html(`
                <label for="">Debit*</label>
                <div class="input-group fix-nominal">
                    <span class="input-group-text">Rp.</span>
                    <input type="text" name="" id="je_debit" class="form-control fill number-only nominal_only" placeholder="Ex 10000">
                </div>    
            `)
        } else{
            $('.catatan').html(`
                <label for="">Credit*</label>
                <div class="input-group fix-nominal">
                    <span class="input-group-text">Rp.</span>
                    <input type="text" name="" id="je_credit" class="form-control fill number-only nominal_only" placeholder="Ex 10000">
                </div>   
            `)
        }
    });

    function refreshCashflow() {
        $("#tableCashflow").dataTable({
            dom: 'Bfrtip',
            serverSide: false,
            destroy: true,
            deferLoading: 10,
            deferRender: true,
            ajax: {
                url: "/admin/getJournalEntries",
                type: "get",
                data:{
                    je_description:$('#filter_cf_desc').val(),
                    coa_id:$('#filter_coa').val(),
                    coa_nama:"kas",
                    je_date:$('#filter_cf_date').val()
                },
                dataSrc: function (json) {
                    for (var i = 0; i < json.length; i++) {
                        json[i].debit_format = "Rp "+formatRupiah(json[i].je_debit);
                        if (json[i].je_credit > 0){
                            json[i].kredit_format = "("+"Rp "+formatRupiah(json[i].je_credit)+")";
                            json[i].cash_format = `<p class="badge text-bg-danger mt-3 fw-bold">Cash Out</p>`;
                        } else {
                            json[i].kredit_format = "Rp "+formatRupiah(json[i].je_credit);
                            json[i].cash_format = `<p class="badge text-bg-success mt-3 fw-bold">Cash In</p>`;
                        }
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
                { data: "je_date", className: "text-left"},
                { data: "cash_format", className: "text-left"},
                { data: "je_description", className: "text-left"},
                { data: "debit_format", className: "text-center"},
                { data: "kredit_format", className: "text-center"},
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

        let table1 = $("#tableCashflow").DataTable();
        table1.one("draw", function () {
            table1.columns.adjust();
        }).ajax.reload();
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertJournalEntries";
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
            je_date:$('#je_date').val(),
            je_description:$('#je_description').val(),
            je_reference:"",
            coa_id:$('#je_coa_name').val(),
            je_debit:$('#je_debit').length != 0 ? convertToAngka($('#je_debit').val()) : 0,
            je_credit:$('#je_credit').length != 0 ? convertToAngka($('#je_credit').val()) : 0,
             _token:token
        };

        //convert data -> form data
        const fd = new FormData();
        for (const [key, value] of Object.entries(param)) {
            fd.append(key, value);
        }
        
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
                afterInsertCashflow();
            },
            error:function(e){
                ResetLoadingButton(".btn-save", 'Save changes');
                console.log(e);
            }
        });
    });

    function afterInsertCashflow() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Debit");
        else if(mode==2)notifikasi('success', "Berhasil Insert", "Berhasil menambah Kredit");
        refreshCashflow();
    }
    
    $(document).on("keyup","#filter_cf_desc",function(){
        refreshCashflow();
    });
    $(document).on("change","#filter_cf_date",function(){
        refreshCashflow();
    });
    $(document).on("change","#filter_coa",function(){
        refreshCashflow();
    });