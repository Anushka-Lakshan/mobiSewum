<?php

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST") {

    show($_POST);

    include 'app/models/Vendor.model.php';

    
    if(isset($_POST['signup'])) {
        $errors = Vendor::Reister();

    }elseif(isset($_POST['login']) && isset($_POST['l-email']) && isset($_POST['l-password'])) {
        $errors = Vendor::Login($_POST['l-email'], $_POST['l-password']);
    }
}

include 'app/views/signUp.view.php';