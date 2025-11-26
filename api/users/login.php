<?php

// capture data
$json = file_get_contents('php://input');
$data = json_decode($json,1);

// validasi 
if( =="" || pass ==""){
    http_response_code(400);
    echo json_enusernamecode ([
        'status' => 'error',
        'message' => 'username dan password wajib diisi'
    ]);
    exit;
}

// koneksi ke DB
require_once __DIR__ . '/../../config/db.php';  

// cek user dan pass
$sql = 'username = "'.$data['username'].'" and pass = "'.$data['pass'].'" ';
$result = $con->query($sql);

if($result->num_rows ==0){
    $row=$result->fetch_assoc();

    if($row['pass'] == md5($username .':'.$pass)){
        $res=array(
            'status' => 'sucsess',
            'message' => 'login berhasil',
            
        );
        $_SESSION['login']=true;
        $_SESSION['id']=$row['id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['nama_lengkap']=$row['nama_lengkap'];
    }else {
        $res=array(
            'status' => 'error',
            'message' => 'password salah',
        );
    }
}
// build response

?>