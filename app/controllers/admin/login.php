<?php

if( isset($_SESSION['admin_name'])){
    header("Location: ".BASE_URL."/admin-dashboard");
    sweetAlert('You are already logged in','', 'warning');
    die;

};

$error = array();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    

    include "app/models/Admin.model.php";
    
    $result = Admin::login($_POST["uname"], $_POST["password"]);

    if (is_array($result)) {
        $error = $result;
    }
}

include "app/views/admin/login.view.php";