
function daftar_user(){
    // tangkap data dari form registrasi
    let nama_lengkap = document.querySelector('input[name="nama_lengkap"]').value;
    let username = document.querySelector('input[name="username"]').value;
    let password = document.querySelector('input[name="password"]').value;
    let no_wa = document.querySelector('input[name="no_wa"]').value;
    let email = document.querySelector('input[name="email"]').value;

    //validasi data
    let err =false;
    let msg =''; 
        
        if (nama_lengkap === '' || nama_lengkap === undefined || nama_lengkap === null) {
          err = true;
          msg += 'Nama lengkap Tolong diisi!\n';
        }
        if (username === '' || username === undefined || username === null) {
          err = true;
          msg += 'username tolong diisi!\n';
        }
        if (password === '' || password === undefined || password === null) {
          err = true;
          msg += 'Password harap di isi!\n';
        }
        if (no_wa === '' || no_wa === undefined || no_wa === null) {
          err = true;
          msg += 'No whats up harap di isi!\n';
        }
        if (email === '' || email === undefined || email === null) {
          err = true;
          msg += 'Email tolong diisi!\n';
        }
        if (err) {
          alert(msg);
          return;
        } 

    // payload data 
    let payload = {
        nama_lengkap : nama_lengkap,
        username : username,
        pass : password ,
        no_wa : no_wa,
        email : email
    }
    console.log(payload)

    // fetch data 
    fetch('../api/users/daftar_user.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json; charset=UTF-8'
          },
          body: JSON.stringify(payload),
        }).then(response => {
          if (response.ok) {
            response.text().then(response => {
              console.log(response);
              alert("Akun anda telah di daftarkan , cek email anda untuk mengkaktifkan");
            });
          }
        });
        
        // kelola response 
        
      return false
}
window.daftar_user = daftar_user;