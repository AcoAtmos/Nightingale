<?php
//capture payload
$json = file_get_contents('php://input');
$data = json_decode($json,1);

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

$page = $data['page'];
$limit = $data['limit'];

//get data pasien database 
$sql="SELECT * FROM master_pasien LIMIT $page,$limit";

$query=mysqli_query($con,$sql);

while($row=mysqli_fetch_assoc($query)){
	$data_db[]=$row;
}

if($query){
	// $response['data']='';
	$response['status']='success';
	$response['data']=$data_db;
	$response['message']='Data berhasil disimpan';
	http_response_code(200);
}else{
	$response['status']='failed';
	$response['data']='';
	$response['message']='Data gagal disimpan';
	http_response_code(500);
}

echo json_encode($response);

mysqli_close($con);
























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