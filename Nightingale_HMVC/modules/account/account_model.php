<?php
function capture_data(){
    session_start();
    
    // capture data
    $json = file_get_contents('php://input');
    $data = json_decode($json, 1);
    
    // validasi 
    if ($data["username"] == "" || $data["pass"] == "") {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'username dan password wajib diisi'
        ]);
        exit;
    }
    return $data;
}

function verification_account($data){

    // koneksi ke DB
    $con= connect_db();
    
    $username = $data['username'];
    $pass_akun = trim($data['pass']);
    // cek user berdasarkan username
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
    
        $row = $result->fetch_assoc();
    
        // cek password
        if ($row['pass'] == $pass_akun) {
    
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
    
            $res = [
                'status' => 'success',
                'message' => 'login berhasil'
            ];
    
        } else {
            echo $pass_akun;
            $res = [
                'status' => 'error',
                'message' => 'password salah'
            ];
        }
    
    } else {
        $res = [
            'status' => 'error',
            'message' => 'username tidak di temukan'
        ];
    };
    // send response JSON
    echo json_encode($res);
}
?>
