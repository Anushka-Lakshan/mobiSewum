<?php

if( isset($_SESSION['Customer_Id'])){
    header("Location: ".BASE_URL."/");
    die;
}

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // show($_POST);
    
    include("app/models/Customer.model.php");

    $Customer = new Customer();

    $errors = $Customer::Login($_POST['email'], $_POST['password']);

    sweetAlert('Login failed! Please check details','', 'error');


}

include("app/views/login.view.php");