
import { list_pasien } from "./list_pasien.js";
function tambah_pasien(){

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
        
        fetch('../api/pasien/simpan_pasien.php', {
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
window.tambah_pasien = tambah_pasien;