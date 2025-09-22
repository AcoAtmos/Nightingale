<?php
// <!-- capture payload -->
$json =file_get_contents('php://input');
$data = json_decode('$json,1');

// <!-- validasi data  -->
$err =false;
$msg ='';

if(!isset($data['nama']) or $data['nama']==''){
    $err = true;
    $msg.='nama wajib di isi';
}
if(!isset($data['no_telp']) or $data['no_telp']==''){
    $err = true;
    $msg.=' no telp wajib di isi';
}
if(!isset($data['tanggal_lahir']) or $data['tanggal_lahir']==''){
    $err = true;
    $msg.='tanggal lahir wajib di isi';
}
if(!isset($data['alamat_pasien']) or $data['alamat_pasien']==''){
    $err = true;
    $msg.='alamat wajib di isi';
}

// <!-- insert database -->
//     <!-- konek ke database -->
$host='localhost';
$user='root';
$pass='';
$db_name='database_antrian';

$con=mysqli_connect($host,$user,$pass,$db_name);

if(!$con){
    echo 'koneksi gagal';
    die();
}
echo "koneksi berhasil";