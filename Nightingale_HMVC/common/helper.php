<?php
function connect_db(){
    $host=DB_HOST;
    $user=DB_USER;
    $pass=DB_PASS;
    $db_name=DB_NAME;
    $con=mysqli_connect($host,$user,$pass,$db_name);
    //echo "<pre>".print_r($con,1)."</pre>";

    if(!$con){
        echo 'koneksi gagal';
        die();	
    }
    return $con;
}