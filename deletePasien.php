<?php

ob_clean(); // hapus output sampah
header('Content-Type: application/json');

// capture payload
$id = $_GET['id'];

// validasi data
if($id == '' || $id == null || $id == 'undefined'){
    $response['status'] = 'failed';
    $response['message'] = 'id kosong';
    http_response_code(500);
    echo json_encode($response);
    exit;
}

// cek karakter berbahaya
if(
    strpos($id, "'") !== false ||
    strpos($id, "--") !== false ||
    strpos($id, '"') !== false
){
    $response['status'] = 'failed';
    $response['message'] = 'id tidak valid';
    http_response_code(500);
    echo json_encode($response);
    exit;
}

// koneksi db
$host='127.0.0.1';
$user='root';
$pass='Mysql170338';
$db_name='data_rumah_sakit';

$con = mysqli_connect($host,$user,$pass,$db_name);

if(!$con){
    $response['status'] = 'failed';
    $response['message'] = 'koneksi gagal';
    http_response_code(500);
    echo json_encode($response);
    exit;
}

// query hapus
$sql = "DELETE FROM data_pasien WHERE id='$id'";
$query = mysqli_query($con, $sql);

if ($query){
    $response['status'] = 'success';
    $response['message'] = 'data berhasil dihapus';
    http_response_code(200);
} else {
    $response['status'] = 'failed';
    $response['message'] = 'data gagal dihapus';
    http_response_code(500);
}

mysqli_close($con);

// output JSON bersih
echo json_encode($response);
exit;
