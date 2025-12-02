
<script defer>
// memunculkan data saaat halaman terbuka (memanggil fungsi untuk me list pasien)
document.addEventListener('DOMContentLoaded',function(){
    list_pasien()
})

// fungsi untuk memunculkan list pasien
function list_pasien(){
    // membatasi data yang di ambil
    let req_body={
        limit:5
    }
    // mengirim limit data ke php 
    fetch('index.php?module=pasien_list', {
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
                    let no = 0;
                    r.data.forEach(function (v,k) {
                        no++;
                        html+=`<tr data_id=${v.id} class=" text-gray-700 dark:text-gray-400">
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
                            <p class="nama font-semibold">${v.nama}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                              Pasien baru
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="no_telp px-4 py-3 text-sm">
                        ${v.no_telp}
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="jenis_kelamin px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600"
                        >
                          ${v.jenis_kelamin}
                        </span>
                      </td>
                      <td class="tanggal_lahir px-4 py-3 text-sm">
                        ${v.tanggal_lahir}
                      </td>
                      <td class="alamat px-4 py-3 text-sm">
                        ${v.alamat}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <button id="openModalBtn" @click="openModal" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" onclick="edit_pasien(${v.id})">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                          </button>

                          <button  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" onclick= "delete_pasien(${v.id})">
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

// fungsi edit psien langsung ter hubung dengan list pasien
function edit_pasien(id){
    console.log('sdfsdf')
	let nama_pasien=document.querySelector(`tbody.list_pasien tr[data_id="${id}"] td p.nama`).innerHTML;
	let no_telp_pasien=document.querySelector(`tbody.list_pasien tr[data_id="${id}"]  td.no_telp`).innerHTML;
	let jenis_kelamin=document.querySelector(`tbody.list_pasien tr[data_id="${id}"] td span.jenis_kelamin`).innerHTML;
	let tanggal_lahir_pasien=document.querySelector(`tbody.list_pasien tr[data_id="${id}"]  td.tanggal_lahir`).innerHTML;
	let alamat_pasien=document.querySelector(`tbody.list_pasien tr[data_id="${id}"]  td.alamat`).innerHTML;

    console.log(nama_pasien)
    
	document.querySelector('div.form_pasien_baru .nama_pasien').value=nama_pasien;
	document.querySelector('div.form_pasien_baru .no_telp_pasien').value=no_telp_pasien.trim();
  document.querySelector('div.form_pasien_baru .tanggal_lahir_pasien').value=tanggal_lahir_pasien.trim();
	document.querySelector('div.form_pasien_baru .alamat_pasien').value=alamat_pasien.trim();
	jenis_kelamin=jenis_kelamin.trim();
	document.querySelector(`div.form_pasien_baru .jenis_kelamin[value='${jenis_kelamin}']`).setAttribute('checked','checked');

	document.querySelector('div.form_pasien_baru .pasien_id').value=id;
	// document.querySelectorAll('div.form_tambah_pasien .jenis_kelamin').forEach(function(el){
	// 	if(el.value==jenis_kelamin){
	// 		el.setAttribute('checked','checked');
	// 	}
	// });
}

// fungsi reset form untuk tambah pasien baru 
function reset_form(){
  document.querySelector('div.form_pasien_baru .nama_pasien').value='';
	document.querySelector('div.form_pasien_baru .no_telp_pasien').value=''
  document.querySelector('div.form_pasien_baru .tanggal_lahir_pasien').value='';
	document.querySelector('div.form_pasien_baru .alamat_pasien').value='';

	document.querySelector('div.form_pasien_baru .pasien_id').value='';
	document.querySelectorAll('div.form_pasien_baru .jenis_kelamin').forEach(function(el){
			el.removeAttribute('checked');
		});
}

//fungsi simpan pasien untuk edit dan tambah pasien
function tambah_pasien(){
    //ambil data
    let id=document.querySelector('.form_pasien_baru .pasien_id').value;
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
        
        let req_body = {
          id : id,
          nama : nama_pasien,
          no_telp : no_telp_pasien,
          tanggal_lahir : tanggal_lahir_pasien,
          alamat : alamat_pasien,
          jenis_kelamin :jenis_kelamin,
        }
        
        fetch('index.php?module=simpan_pasien', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json; charset=UTF-8'
          },
          body: JSON.stringify(req_body),
        }).then(response => {
          if (response.ok) {
            response.text().then(response => {
              console.log(response);
              alert("data berhasil disimpan");
              document.querySelector('.form_pasien_baru .closeModal').click();
              list_pasien();

            });
          }
        })
        
        return false;
}

// fungsi delete pasien
function delete_pasien(id){
  if(confirm('apa anda yakin akan menghapus data ini? ')){
    
    fetch(`index.php?module=delete_pasien&delete_pasien=${id}`, {
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
</script>
