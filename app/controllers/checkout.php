<?php

//check cart is empty

if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){

    sweetAlert("Attention!", "Your cart is empty", "warning");
    header("Location: ".BASE_URL."/cart");
    die;
}


// check if customer is logged in
if(!isset($_SESSION['Customer_Id'])){

    sweetAlert("Attention!", "Please login to Checkout your order", "warning");
    header("Location: ".BASE_URL."/cart");
    die;
}

$errors = [];

if($_SERVER['REQUEST_METHOD'] == "POST") {

    include "app/controllers/handleOrder.php";

    $status = handleOrder();

    if(isset($status['success']) && $status['success'] == true){
        sweetAlert("Success!", 'Your order has been placed', "success");
        $_SESSION['cart'] = [];
        header("Location: ".BASE_URL."/");
        die;
    }else{
        $errors = $status;
    }


}

// get branch details
include("app/models/Branch.model.php");

$Branch = new Branch();

$AllBranches =$Branch::get_all();

// get customer details
include("app/models/Customer.model.php");

$Customer = new Customer();

$customer = $Customer::get_customer_by_id($_SESSION['Customer_Id']);





include("app/views/checkout.view.php");