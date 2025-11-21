<?php
//capture payload
$id =$_GET['id'];
//validasi payload

if (!isset($_GET['id']) or $_GET['id'] == ''){
    die('id not valid');
}

if(strpos($_GET['id'], "'") == true or strpos($_GET['id'], '"')==true or strpos($_GET['id'], '-')){
    die('id not valid');
}

//koneksi db
require_once __DIR__ . '/../../config/db.php';

// query update aktivasi
$sql = "update users set status_akun 'aktif' where id='$id' ";
$query = mysqli_query($con,$sql);

//notifikasi user
if ($query){
    $response['status']='sucsess';
    $response['data']= ;
    http_response_code(200);

}else{
    $response ['status']='gagal';
    $response['message']='data gagal di simpan';
    http_response_code(500);
    
}

?>