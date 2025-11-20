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
    fetch('../api/pasien/list_pasien.php', {
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

export { list_pasien };
