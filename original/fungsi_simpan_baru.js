
// proses  menampilkan data list ke dalam html dari database
  // memunculkan data saaat halaman terbuka (memanggil fungsi untuk me list pasien)
document.addEventListener('DOMContentLoaded',function(){
    list_pasien();
})

  // fungsi untuk memunculkan list pasien
function list_pasien(){
    // membatasi data yang di ambil
    req_body={

        limit:5
    }
    // mengirim limit data ke php 
    fetch(`list_pasien.php`, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json; charset=UTF-8'
            },
            body: JSON.stringify(req_body),
        }).then(response => {
            if (response.ok) {
                response.text().then(response => {
                    let r =JSON.parse(response);
                    let html='';
                    console.log(r.data);
                    let no = 0;
                    r.data.forEach(function (v,k) {
                        no++;
                        html+=`<tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div>
                            <p class="font-semibold" id="${v.id}">${no}</p></p>
                            
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">

                          <div>
                            <p class="font-semibold">${v.nama}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                              Pasien baru
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        ${v.no_telp}
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600"
                        >
                          ${v.jenis_kelamin}
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        ${v.tanggal_lahir}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        ${v.alamat}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <button id="openModalBtn" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" onclick="openEditModal(
    '${v.id}', 
    '${v.nama}', 
    '${v.no_telp}', 
    '${v.tanggal_lahir}',
    '${v.alamat}',
    '${v.jenis_kelamin}'
  )">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                          </button>

                          <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" onclick= "delete_pasien(${v.id})">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                      </td>
                    </tr>`;
                    })

                    document.querySelector('tbody.list_pasien').innerHTML = html;
                });
            }
        });
}

function delete_pasien(id){
  if(confirm('apa anda yakin akan menghapus data ini? ')){
    
    fetch(`deletePasien.php?id=${id}`, {
      method: 'GET'
    })
    .then(response => {
      if(response.ok){
        return response.text();
      }
    })
    .then(resText => {
      try{
        let r = JSON.parse(resText);
        alert(r.message);
        list_pasien();
      }catch(err){
        console.error("JSON error:", err);
        console.log("Response:", resText);
        alert("Terjadi kesalahan pada server");
      }
    })
    .catch(err => {
      console.error(err);
      alert("Gagal menghubungi server");
    });

  }
}

// edit pasien
  //data terisi otomatis saat di buka 
function openEditModal(id, nama, no_telp, tgl_lahir, alamat, jk) {

  document.querySelector(".edit_id").value = id;
  document.querySelector(".edit_nama").value = nama;
  document.querySelector(".edit_telp").value = no_telp;
  document.querySelector(".edit_tgl").value = tgl_lahir;
  document.querySelector(".edit_alamat").value = alamat;

  // Check radio gender
  document.querySelectorAll("input[name='edit_jk']").forEach(el => {
    el.checked = (el.value === jk);
  });

  // Show modal
  document.getElementById("modal_edit_pasien").classList.remove("hidden");
}
  // tutup modal
  function closeEditModal() {
  document.getElementById("modal_edit_pasien").classList.add("hidden");
}
  //simpan perubahan dan validasi dan fetch
function simpanPerubahanPasien() {
  
  let id = document.querySelector(".edit_id").value;
  let nama = document.querySelector(".edit_nama").value;
  let no_telp = document.querySelector(".edit_telp").value;
  let tanggal_lahir = document.querySelector(".edit_tgl").value;
  let alamat = document.querySelector(".edit_alamat").value;

  let jenis_kelamin;
  document.querySelectorAll("input[name='edit_jk']").forEach(el => {
    if(el.checked) jenis_kelamin = el.value;
  });


  let req_body = {
    id,
    nama,
    no_telp,
    tanggal_lahir,
    alamat,
    jenis_kelamin
  };


  fetch("edit_pasien.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(req_body)
  })
  .then(async res => {
    const text = await res.text();
    console.log("RAW RESPONSE:", text); 
    try{
        return JSON.parse(text);
    }catch(e){
        console.error("JSON PARSE ERROR:", e);
        throw e;
    }
})
.then(res => {
    console.log("Parsed:", res);
    alert(res.message);

    if(res.status === "success"){
      closeEditModal();
      list_pasien();
    }
});
}
//  proses menyimpan dat pasien baru
function simpan_data_pasien_baru(){
  
  let nama_pasien=document.querySelector('.form_pasien_baru .nama_pasien').value;
  let no_telp_pasien=document.querySelector('.form_pasien_baru .no_telp_pasien').value;
  let tanggal_lahir_pasien=document.querySelector('.form_pasien_baru .tanggal_lahir_pasien').value;
  let alamat_pasien=document.querySelector('.form_pasien_baru .alamat_pasien').value;
  let jenis_kelamin;
  document.querySelectorAll('.form_pasien_baru .jenis_kelamin').forEach(function(el){
    if(el.checked == true){
      jenis_kelamin =el.value;
    }
        })
        // validasi Data
        let err =false;
        let msg =''; 
        
        if (nama_pasien === '' || nama_pasien === undefined || nama_pasien === null) {
          err = true;
          msg += 'Nama lengkap Tolong diisi!\n';
        }
        if (no_telp_pasien === '' || no_telp_pasien === undefined || no_telp_pasien === null) {
          err = true;
          msg += 'No telp tolong diisi!\n';
        }
        if (jenis_kelamin === '' || jenis_kelamin === undefined || jenis_kelamin === null) {
          err = true;
          msg += 'jenis kelamin tolong diisi!\n';
        }
        if (tanggal_lahir_pasien === '' || tanggal_lahir_pasien === undefined || tanggal_lahir_pasien === null) {
          err = true;
          msg += 'Tanggal Lahir tolong diisi!\n';
        }
        if (alamat_pasien === '' || alamat_pasien === undefined || alamat_pasien === null) {
          err = true;
          msg += 'Alamat tolong diisi!\n';
        }
        if (err) {
          alert(msg);
          return;
        }   
        
        //alert(`data anda adalah ${nama_pasien} dengan no telp ${no_telp_pasien} tgl ${tanggal_lahir_pasien} dan beralamat di ${alamat_pasien}`);
        
        
        let req_body = {
          nama : nama_pasien,
          no_telp : no_telp_pasien,
          tanggal_lahir : tanggal_lahir_pasien,
          alamat : alamat_pasien,
          jenis_kelamin :jenis_kelamin,
        }
        
        fetch(`save_pasien_baru.php`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json; charset=UTF-8'
          },
          body: JSON.stringify(req_body),
        }).then(response => {
          if (response.ok) {
            response.text().then(response => {
              console.log(response);
              open_notif1("Master Pasien", response);
              document.querySelector('.form_pasien_baru .closeModal').click();
              list_pasien();
            });
          }
        });
    
        return false;
      }
      
