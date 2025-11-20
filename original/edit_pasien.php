<?php
header('Content-Type: application/json');


// CONNECT DB

$host='127.0.0.1';
$user='root';
$pass='Mysql170338';
$db_name='data_rumah_sakit';
$con=mysqli_connect($host,$user,$pass,$db_name);

if(!$con){
    echo 'koneksi gagal';
    die();
}
$data = json_decode(file_get_contents("php://input"), true);

$id = $data["id"] ?? "";
$nama = $data["nama"] ?? "";
$no_telp = $data["no_telp"] ?? "";
$tanggal_lahir = $data["tanggal_lahir"] ?? "";
$alamat = $data["alamat"] ?? "";
$jk = $data["jenis_kelamin"] ?? "";


// PREVENT SQL INJECTION

$sql = "UPDATE data_pasien 
        SET 
          nama='$nama',
          no_telp='$no_telp',
          tanggal_lahir='$tanggal_lahir',
          alamat='$alamat',
          jenis_kelamin='$jk'
        WHERE id='$id'";

$q = mysqli_query($con, $sql);

if($q){
    echo json_encode(["status"=>"success", "message"=>"Data berhasil diperbarui"]);
} else {
    http_response_code(500);
    echo json_encode(["status"=>"failed","message"=>"Gagal mengupdate data"]);
}

mysqli_close($con);
