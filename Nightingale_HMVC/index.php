<?php 
include('./common/constant.php');
include('./common/helper.php');
$module=$_GET['module'];

switch($module){
    case "login":
        include "modules/account/account_controller.php";
        login_view();
        break;
    case "login_proses":
        include "modules/account/account_controller.php";
        login_proses();
        break;
    case "pasien_list": //Mengeluarkan list pasien 
        include "modules/pasien/pasien_controller.php";
        list_pasien();
        break;
    case "pasien_view": //menampilkan halaman master pasien
        include "modules/pasien/pasien_controller.php";
        pasien_view();
        break;
    case "simpan_pasien":
        include "modules/pasien/pasien_controller.php";
        simpan_pasien();
        break;
    case "delete_pasien":
        include "modules/pasien/pasien_controller.php";
        delete_pasien();
        break;
    default:
        include "common/view/404_view.php";
        break;
};
