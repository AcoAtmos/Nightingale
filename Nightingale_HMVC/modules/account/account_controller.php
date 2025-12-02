<?php
function login_view(){
    include ("modules/account/view/login_view.php"); 
};

function login_proses(){
    include("account_model.php");
    $data = capture_data();
    verification_account($data);
};