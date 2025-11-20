import { list_pasien } from "./list_pasien.js";
function delete_pasien(id){
  if(confirm('apa anda yakin akan menghapus data ini? ')){
    
    fetch(`../api/pasien/hapus_pasien.php?id=${id}`, {
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
window.delete_pasien = delete_pasien;