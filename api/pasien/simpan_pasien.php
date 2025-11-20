<?php
// <!-- capture payload -->
echo $json =file_get_contents('php://input');
$data = json_decode($json,1);

echo $data['nama'];
// <!-- validasi data  -->
require_once __DIR__ . '/validasi.php';
//     <!-- konek ke database -->
require_once __DIR__ . '/../../config/db.php';

//insert Database 
$nama =$data['nama'];
$no_telp = $data['no_telp'];
$tgl_lahir = $data['tanggal_lahir'];
$alamat = $data['alamat'];
$jenis_kelamin = $data['jenis_kelamin'];
$id = $data['id'];

if($id==''){
	$sql="INSERT INTO data_pasien(nama,tanggal_lahir,no_telp,jenis_kelamin,alamat) 
	VALUES('$nama','$tgl_lahir','$no_telp','$jenis_kelamin','$alamat')";
}else{
	$sql="UPDATE data_pasien SET nama='$nama' WHERE id='$id'";
}

$query = mysqli_query($con,$sql);

if ($query){
    $response['status']='sucsess';
    $response['message']='data behasil di simpan';
    http_response_code(200);

}else{
    $response ['status']='gagal';
    $response['message']='data gagal di simpan';
    http_response_code(500);
    
}
mysqli_close($con);