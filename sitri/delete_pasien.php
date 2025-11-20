<?php

//capture payload
$id=$_GET['id'];

//validasi data
if ($id=='' or $id==null or $id=='undefined') {
	$response['status']='failed';
	$response['message']='Id kosong';
	http_response_code(500);
	die(json_encode($response));
}
if(strpos($id,"'")==true || strpos($id,"--")==true || strpos($id,'"')==true){
	$response['status']='failed';
	$response['message']='Id tidak valid';
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
	$response['status']='failed';
	$response['message']='Koneksi DB gagal';
	http_response_code(500);
	die(json_encode($response));
}

// echo 'koneksi berhasil';
 
//insert database 
$sql="DELETE FROM master_pasien WHERE id=$id";

$query=mysqli_query($con,$sql);

if($query){
	// $response['data']='';
	$response['status']='success';
	$response['message']='Data berhasil dihapus';
	http_response_code(200);
}else{
	$response['status']='failed';
	// $response['data']='';
	$response['message']='Data gagal dihapus';
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