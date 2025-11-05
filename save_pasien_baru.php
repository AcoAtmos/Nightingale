<?php
// <!-- capture payload -->
echo $json =file_get_contents('php://input');
$data = json_decode($json,1);

echo $data['nama'];
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

if ($err)

//     <!-- konek ke database -->
$host='127.0.0.1';
$user='root';
$pass='Mysql170338';
$db_name='data_rumah_sakit';

$con=mysqli_connect($host,$user,$pass,$db_name);

if(!$con){
    echo 'koneksi gagal';
    die();
}
// echo "koneksi berhasil";

//insert Database 
$nama =$data['nama'];
$no_telp = $data['no_telp'];
$tgl_lahir = $data['tanggal_lahir'];
$alamat = $data['alamat'];
$jenis_kelamin = $data['jenis_kelamin'];
$sql ="insert into data_pasien(nama,no_telp,tanggal_lahir,alamat,jenis_kelamin) values('$nama','$no_telp','$tgl_lahir','$alamat','$jenis_kelamin')";

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