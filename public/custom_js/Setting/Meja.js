let scale = 1;
let mapX = 0;
let mapY = 0;
let tableCount = 1;
var list_table = [];
var jenis = 1;//1= horizotal, 2= Vertikal
let clickStartPos = { x: 0, y: 0 };
var mode=1;
const $mapInner = $('#map-inner');
const $mapContainer = $('#map-container');

$(document).ready(function(){
    if(floor.meja.length>0) list_table = floor.meja;
    floor.meja.forEach(item => {
        console.log(item.m_name,item.m_kapasitas,item.m_id,item.m_x,item.m_y);
        jenis = item.m_type;
        var table = createTableBox(item.m_name,item.m_kapasitas,item.m_id,item.m_x,item.m_y);
        // SNAP to nearest 20px grid
        
        // Apply snap
        $mapInner.append(table);
        initInteract(table.get(0));
    });

});

// 🔍 Zoom Scroll
$mapContainer.on('wheel', function (e) {
    e.preventDefault();
    const delta = e.originalEvent.deltaY;
    const zoomStep = 0.1;

    // Ambil posisi kursor relatif terhadap container
    const rect = $mapContainer[0].getBoundingClientRect();
    const mouseX = e.originalEvent.clientX - rect.left;
    const mouseY = e.originalEvent.clientY - rect.top;

    // Posisi world sebelum zoom
    const worldX = (mouseX - mapX) / scale;
    const worldY = (mouseY - mapY) / scale;

    if (delta < 0) {
        scale = Math.min(3, scale + zoomStep);
    } else {
        scale = Math.max(0.5, scale - zoomStep);
    }

    // Koreksi pan agar zoom tetap fokus di titik kursor
    mapX = mouseX - worldX * scale;
    mapY = mouseY - worldY * scale;

    applyTransform();
});

// 📍 Terapkan transform
function applyTransform() {
    $mapInner.css('transform', `translate(${mapX}px, ${mapY}px) scale(${scale})`);
    $mapInner.css('transform-origin', 'top left');
}

// 🖱️ Pan
let draggingMap = false;
let startX = 0, startY = 0;

$mapContainer.on('mousedown', function (e) {
    if ($(e.target).closest('.table-box').length) return;
    draggingMap = true;
    startX = e.clientX;
    startY = e.clientY;
    clickStartPos.x = e.pageX;
    clickStartPos.y = e.pageY;
    $mapInner.css('cursor', 'grabbing');
});

$(window).on('mouseup', (e) => {
    draggingMap = false;
    $mapInner.css('cursor', 'grab');
   
});

$(document).on('blur','#floor_name', function(e){
    console.log("Test");
    
    $.ajax({
        url:"/admin/updateFloor",
        method:"post",
        data:{
            "fl_id":floor.fl_id,
            "fl_name":$('#floor_name').val()
        },
        headers: {
            'X-CSRF-TOKEN': token
        },
        success:function(e){

        },
        error:function(e){
            ResetLoadingButton(".btn-save", 'Save changes');
            console.log(e);
        }
    });
});

$(document).on('click','#btn-delete-meja', function(e){
    $.ajax({
        url:"/admin/deleteMeja",
        method:"post",
        data:{
            "m_id":$('#btn-delete-meja').attr("m_id")
        },
        headers: {
            'X-CSRF-TOKEN': token
        },
        success:function(e){
            toastr.success("Berhasil hapus meja!");
            $('.modal').hide();
            $(".table-box").each(function(){
                if($(this).attr("m_id") == e) $(this).remove();
            });
            
        },
        error:function(e){
            ResetLoadingButton(".btn-save", 'Save changes');
            console.log(e);
        }
    });
});

$(document).on('mouseup','.table-box', function(e){
    const dx = Math.abs(e.pageX - clickStartPos.x);
    const dy = Math.abs(e.pageY - clickStartPos.y);

    const distance = Math.sqrt(dx * dx + dy * dy);

    // Jika pergerakan kecil (misalnya < 5px), anggap klik
    
    if (distance < 5) {
        console.log($(this).attr('m_id'));
        
        var m_id = $(this).attr('m_id');
        console.log("TABLE CLICKED: ID =", m_id);
        // 👉 Tambahkan aksi klik lainnya di sini
        // contoh: show info, open edit modal, dsb
        mode=2;
        var ada=-1;
        list_table.forEach((item,index)=> {
            if(item.m_id == m_id)ada=index;
        });
        console.log(ada);
        
        $('#table_name').val(list_table[ada].m_name);
        $('#capacity').val(list_table[ada].m_kapasitas);
        if(list_table[ada].m_type==1)selectRadioCard('1')
        else if(list_table[ada].m_type==2)selectRadioCard('2');
        $('#btn-delete-meja').show();
        $('#btn-delete-meja').attr("m_id",list_table[ada].m_id);
        $('#modalInsert .modal-title').html("Edit Table");
        $('#modalInsert').modal("show");
    }
});

$(document).on('mousedown','.table-box', (e) => {
    clickStartPos.x = e.pageX;
    clickStartPos.y = e.pageY;
});

$(window).on('mousemove', (e) => {
    if (draggingMap) {
        const dx = e.clientX - startX;
        const dy = e.clientY - startY;
        mapX += dx;
        mapY += dy;
        applyTransform();
        startX = e.clientX;
        startY = e.clientY;
    }
});


// 🧲 Drag InteractJS (akurasi dengan zoom & pan)
function initInteract(el) {
    interact(el).draggable({
        listeners: {
            start(event) {
                const target = event.target;

                target._startX = parseFloat(target.getAttribute('data-x')) || 0;
                target._startY = parseFloat(target.getAttribute('data-y')) || 0;

                const containerOffset = $mapContainer.offset();
                const mouseX = event.client.x - containerOffset.left;
                const mouseY = event.client.y - containerOffset.top;

                target._startWorldX = (mouseX - mapX) / scale;
                target._startWorldY = (mouseY - mapY) / scale;
            },
            move(event) {
                const target = event.target;
                const containerOffset = $mapContainer.offset();
                const mouseX = event.client.x - containerOffset.left;
                const mouseY = event.client.y - containerOffset.top;

                const worldX = (mouseX - mapX) / scale;
                const worldY = (mouseY - mapY) / scale;

                const deltaX = worldX - target._startWorldX;
                const deltaY = worldY - target._startWorldY;

                const newX = target._startX + deltaX;
                const newY = target._startY + deltaY;

                target.style.transform = `translate(${newX}px, ${newY}px)`;
                target.setAttribute('data-x', newX);
                target.setAttribute('data-y', newY);
            },
             end(event) {
                const target = event.target;
                let x = parseFloat(target.getAttribute('data-x')) || 0;
                let y = parseFloat(target.getAttribute('data-y')) || 0;

                // SNAP to nearest 20px grid
                const snappedX = Math.round(x / 20) * 20;
                const snappedY = Math.round(y / 20) * 20;

                // Apply snap
                target.setAttribute('data-x', snappedX);
                target.setAttribute('data-y', snappedY);
                target.style.transform = `translate(${snappedX}px, ${snappedY}px)`;
                updateKoordinatMeja(snappedX,snappedY,target.getAttribute('m_id'));
                target.classList.remove('dragging');
            }
        }
    });
}

function updateKoordinatMeja(x,y,m_id) {
    param = {
          m_id:m_id,
          m_x:x,
          m_y:y,
           _token:token
      };
      $.ajax({
          url:"/admin/updateKoordinatMeja",
          data: param,
          method:"post",
          headers: {
              'X-CSRF-TOKEN': token
          },
          success:function(e){
          },
          error:function(e){
          }
      });
    
}

// 🔨 Fungsi Bikin Meja Baru
function createTableBox(name,capacity,m_id,mj_x=null,mj_y=null) {
    var initialX = 100;
    var initialY = 100;
    var width=50;
    var height =50;
    var jumDuduk1 = Math.ceil(capacity/2);
    var jumDuduk2 = Math.floor(capacity/2);
    var dudukAtas = "",dudukBawah = "",dudukKiri = "",dudukKanan = "";

    if(jenis==1){//horizontal
        width=50*capacity;
        height =100;
        var jarak = parseFloat((width-30)/(jumDuduk1+1));
        var pos = 0;
        for (let i = 0; i < jumDuduk1; i++) {
            pos+=jarak;
            console.log("POS : "+pos);
            
            dudukAtas +=`<div class="kursi kursi-top" style="left:${pos}px"></div>`;
        
        }
        pos = 0;
        for (let i = 0; i < jumDuduk2; i++) {
            pos+=jarak;
            console.log("POS : "+pos);
            
            dudukBawah +=`<div class="kursi kursi-bottom" style="left:${pos}px"></div>`;
        
        }
    }
    else{//vertikal
        width=100;
        height =50*capacity;

        var jarak = parseFloat((height-30)/(jumDuduk1+1));
        var pos = 0;
        for (let i = 0; i < jumDuduk1; i++) {
            pos+=jarak;
            console.log("POS : "+pos);
            
            dudukAtas +=`<div class="kursi kursi-left" style="top:${pos}px"></div>`;
        
        }
        pos = 0;
        for (let i = 0; i < jumDuduk2; i++) {
            pos+=jarak;
            console.log("POS : "+pos);
            
            dudukBawah +=`<div class="kursi kursi-right" style="top:${pos}px"></div>`;
        
        }
    }

    if(mj_x!=null&&mj_y!=null){
        initialX = mj_x;   
        initialY = mj_y;   
    }

    return $(`
        <div class="table-box"  m_id="${m_id}"  data-x="${initialX}" data-y="${initialY}" style="transform: translate(${initialX}px, ${initialY}px);height:${height}px;width:${width}px">
            ${dudukAtas}
            ${dudukBawah}
            <div class="meja p-2" style="height:${height}px;width:${width}px">
                <div class="text-end fw-bold text-light">
                    ${capacity}
                </end>
                <h6 class="fw-bold mt-2 text-center text-light">${name}</h6>
            </div>
        </div>
    `);
}

// 🔘 Tombol Tambah Meja dari Modal
$(document).on('click', '.btn-add-meja', function () {
    $('#modalInsert input').val("");
    $('#modalInsert #capacity').val(2);
    selectRadioCard(1);
     $('#btn-delete-meja').hide();
    $('#modalInsert').modal("show");
});

$(document).on('click', '.btn-save', function () {
    const name = $('#table_name').val() ? $('#table_name').val() : `Table ${tableCount++}`;
    
   
    param = {
          m_name:name,
          m_kapasitas:$('#capacity').val(),
          m_type:jenis,
          fl_id:floor.fl_id,
          m_x:100,
          m_y:100,
           _token:token
      };
      LoadingButton($(this));
      $.ajax({
          url:"/admin/insertMeja",
          data: param,
          method:"post",
          headers: {
              'X-CSRF-TOKEN': token
          },
          success:function(e){
            list_table.push(e)
            ResetLoadingButton(".btn-save", 'Save changes');
            const table = createTableBox(name,$('#capacity').val(),e.m_id);
            $mapInner.append(table);
            initInteract(table.get(0));
            $('.modal').modal("hide");
            toastr.success("Berhasil tambah meja!");
          },
          error:function(e){
              ResetLoadingButton(".btn-save", 'Save changes');
              console.log(e);
          }
      });
    
});


const selectRadioCard = (cardNo) => {
    /**
     * Loop through all radio cards, and remove the class "selected" from those elements.
     */
    const allRadioCards = document.querySelectorAll(".radio-card");
    allRadioCards.forEach((element, index) => {
        element.classList.remove(["selected"]);
    });
    jenis = cardNo;
    /**
     * Add the class "selected" to the card which user has clicked on.
     */
    const selectedCard = document.querySelector(".radio-card-" + cardNo);
    selectedCard.classList.add(["selected"]);
};