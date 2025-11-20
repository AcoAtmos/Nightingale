<?php
$host = '127.0.0.1';
$user = 'root';
$pass = 'Mysql170338';
$db   = 'data_rumah_sakit';

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die(json_encode([
        "status" => "error",
        "message" => "Koneksi database gagal"
    ]));
}
?>