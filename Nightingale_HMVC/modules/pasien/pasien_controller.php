<?php

include ("modules/pasien/pasien_model.php");

function pasien_view(){
    include ('view/list_pasien_view.php');
};

function list_pasien(){
    $data = capture_data();
    $data_str = connect_db_query_list($data);
    echo $data_str;
};

function simpan_pasien(){
    $data = capture_data();
    connect_db_query_save($data);
};

function delete_pasien(){
    delete_data_pasien();
};