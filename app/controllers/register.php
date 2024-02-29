<?php

if( isset($_SESSION['Customer_Id'])){
    header("Location: ".BASE_URL."/");
    die;
}

include("app/models/Branch.model.php");

$Branch = new Branch();

$AllBranches =$Branch::get_all();

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // show($_POST);
    
    include("app/models/Customer.model.php");

    $Customer = new Customer();

    $errors = $Customer::Reister();

    sweetAlert('Sign up failed! Please check details','', 'error');


}

include("app/views/register.view.php");

