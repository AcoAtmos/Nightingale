<?php
// <!-- capture payload -->
$id=get['id']
// <!-- validasi data  -->
if($id =='' or $id ==null or $id=='undifined'){
    $response['status']='failed';
    $response['message']='id kosong'
    http_response_code(500);
    die(json_encode($response));
}
if(strpos($id,"'")==true || strpos($id,"--")==true strpos($id,'"')==true){
    $response['status']='failed';
    $response['message']='id kosong'
    http_response_code(500);
    die(json_encode($response));
}
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

//masukan query hapus dan jalankan
$sql = "delete from data_pasien where id=$id";
$query = mysqli_query($con,$sql);

if ($query){
    $response['status']='sucsess';
    $response['message']='data behasil dihapus';
    http_response_code(200);

}else{
    $response ['status']='gagal';
    $response['message']='data gagal dihapus';
    http_response_code(500);
    
}
mysqli_close($con);