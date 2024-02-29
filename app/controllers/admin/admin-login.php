<?php

if( isset($_SESSION['admin_name'])){
    header("Location: ".BASE_URL."/admin-dashboard");
    sweetAlert('You are already logged in','', 'warning');
    die;

};


$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    include("app/models/Admin.model.php");

    $admin = new Admin();

    $errors = $admin::Login($_POST['username'], $_POST['password']);

    sweetAlert('Login failed! Please check details','', 'error');


}

include("app/views/admin/login.view.php");