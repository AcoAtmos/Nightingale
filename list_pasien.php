<?php
$json = file_get_contents('php://input');
$data = json_decode($json,1);

// koneksi ke database
$host='127.0.0.1';
$user='root';
$pass='Mysql170338';
$db_name='data_rumah_sakit';

$con=mysqli_connect($host,$user,$pass,$db_name);

if(!$con){
    echo 'koneksi gagal';
    die();
}

$page = $data['page'];
$limit = $data['limit'];


//insert Database 
$sql = "select * from data_pasien limit $page, $limit";

$query = mysqli_query($con,$sql);

while ($row=mysqli_fetch_assoc($query)){
    $data_db[]=$row;
}

if ($query){
    $response['status']='sucsess';
    $response['data']= $data_db;
    http_response_code(200);

}else{
    $response ['status']='gagal';
    $response['message']='data gagal di simpan';
    http_response_code(500);
    
}

echo json_encode($response);
mysqli_close($con);