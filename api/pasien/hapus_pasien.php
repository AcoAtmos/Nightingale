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
require_once __DIR__ . '/../../config/db.php';

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
