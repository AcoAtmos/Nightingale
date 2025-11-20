<?php


//capture payload
$json = file_get_contents('php://input');
$data = json_decode($json,1);

//validasi data
$err=false;
$msg='';
if (!isset($data['nama']) or $data['nama']=='') {
	$err=true;
	$msg.=' Nama wajib di isi';
}

if (!isset($data['tgl_lahir']) or $data['tgl_lahir']=='') {
	$err=true;
	$msg.=' Tgl Lahir wajib di isi';
}

if (!isset($data['jenis_kelamin']) or $data['jenis_kelamin']=='') {
	$err=true;
	$msg.=' Jenis kelamin wajib di isi';
}

if (!isset($data['no_telp']) or $data['no_telp']=='') {
	$err=true;
	$msg.=' No Telp wajib di isi';
}

if (!isset($data['alamat']) or $data['alamat']=='') {
	$err=true;
	$msg.=' Alamat wajib di isi';
}

if ($err) {
	$response['status']='failed';
	$response['message']=$msg;
	http_response_code(500);
	die(json_encode($response));
}

//koneksi ke database
$host='127.0.0.1'; 
$user='root';
$pass='qweasd123';
$db_name='antrian_db';

$con=mysqli_connect($host,$user,$pass,$db_name);
//echo "<pre>".print_r($con,1)."</pre>";

if(!$con){
	echo 'koneksi gagal';
	die();	
}

// echo 'koneksi berhasil';

$nama = $data['nama'];
$tgl_lahir = $data['tgl_lahir'];
$no_telp = $data['no_telp'];
$jenis_kelamin = $data['jenis_kelamin'];
$alamat = $data['alamat'];
$id = $data['id'];



//insert database 
if($id==''){
	$sql="INSERT INTO master_pasien(nama,tgl_lahir,no_telp,jenis_kelamin,tgl_daftar,alamat) 
	VALUES($nama','$tgl_lahir','$no_telp','$jenis_kelamin',NOW(),'$alamat')";
}else{
	$sql="UPDATE master_pasien SET nama='$nama' WHERE id='$id'";
}

$query=mysqli_query($con,$sql);

if($query){
	// $response['data']='';
	$response['status']='success';
	$response['message']='Data berhasil disimpan';
	http_response_code(200);
}else{
	$response['status']='failed';
	// $response['data']='';
	$response['message']='Data gagal disimpan';
	http_response_code(500);
}

echo json_encode($response);

mysqli_close($con);
// echo "save_pasien.php123 $json";





























// echo $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Konfigurasi koneksi
// $host     = "127.0.0.1";   // atau IP server database
// $user     = "root";        // username database
// $password = "qweasd123";            // password database
// $database = "antrian_db"; // nama database

// // Membuat koneksi
// $conn = mysqli_connect($host, $user, $password, $database);

// // Mengecek koneksi
// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }

// echo "Koneksi berhasil!";

// echo print_r($data,1);