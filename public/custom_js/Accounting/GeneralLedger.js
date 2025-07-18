    var mode = 1; //1 = debit, 2 = kredit
    var variants = [];
    refreshJournal();
    autocompleteCoa('#filter_coa');
    autocompleteCoa('#je_coa_name', '#modalInsert');


    $(document).on('click','.btnAdd',function(){
        $('#modalInsert input').val("");
        $('#modalInsert .modal-title').html("Add New Journal Entries");
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

    function refreshJournal() {
        $.ajax({
            url: "/admin/getGeneralLedger",
            method: "GET",
            data:{
                je_description:$('#filter_je_desc').val(),
                coa_id:$('#filter_coa').val(),
                je_date:$('#filter_je_date').val()
            },
            success: function (json) {
                console.log(json);
                var html = "";

                Object.entries(json).forEach((dataLedger, idx) => {
                    var datas = dataLedger[1];
                    var body = "";
                    datas.forEach(datas2 => {
                        if (datas2.balance < 0) balance = `(Rp ${formatRupiah(datas2.balance)})`;
                        else balance = `Rp ${formatRupiah(datas2.balance)}`;
                        if (datas2.je_credit > 0) credit = `(Rp ${formatRupiah(datas2.je_credit)})`;
                        else credit = `Rp ${formatRupiah(datas2.je_credit)}`;
                        body += `
                            <tr>
                                <td style="width: 15%">${datas2.je_date}</td>
                                <td style="width: 31%">${datas2.je_description}</td>
                                <td style="width: 18%" class="text-center">Rp ${formatRupiah(datas2.je_debit)}</td>
                                <td style="width: 18%" class="text-center">${credit}</td>
                                <td style="width: 18%" class="text-center">${balance}</td>
                            </tr>
                        `;
                    });

                    html += `
                        <p class="fw-bold" style="font-size: 16px">${datas[0].coa_kode} - ${datas[0].coa_nama}</p>
                        <table style="width: 100%" class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Credit</th>
                                    <th class="text-center">Balance</th>
                                </tr>
                            </thead>
                            <tbody id="table${idx}">
                                ${body}
                            </tbody>
                        </table>
                        <hr>
                    `;
                });
                $('#list').html(html);

                data = json;
                return json;
            },
            error: function (e) {
                console.log(e.responseText);
            },
        })
    }

    $(document).on("click",".btn-save",function(){
        LoadingButton(this);
        $('.is-invalid').removeClass('is-invalid');
        var url ="/admin/insertJournalEntries";
        var valid=1;
        console.log($('#je_credit').length)
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
            je_reference:$('#je_reference').val(),
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
                afterInsertJournal();
            },
            error:function(e){
                ResetLoadingButton(".btn-save", 'Save changes');
                console.log(e);
            }
        });
    });

    function afterInsertJournal() {
        $(".modal").modal("hide");
        if(mode==1)notifikasi('success', "Berhasil Insert", "Berhasil menambah Debit");
        else if(mode==2)notifikasi('success', "Berhasil Insert", "Berhasil menambah Kredit");
        refreshJournal();
    }
    
    $(document).on("keyup","#filter_je_desc",function(){
        refreshJournal();
    });
    $(document).on("change","#filter_coa",function(){
        refreshJournal();
    });
    $(document).on("change","#filter_je_date",function(){
        refreshJournal();
        console.log($(this).val())
    });


