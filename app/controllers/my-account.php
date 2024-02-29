<?php

if( !isset($_SESSION['Customer_Id'])){
    header("Location: ".BASE_URL."/login");
    die;
}


include("app/models/Customer.model.php");
$customer = new Customer();
$customerData = $customer::get_customer_by_id($_SESSION['Customer_Id']);

include("app/models/Order.model.php");
$order = new Order();
$orderData = $order::get_item_by_customer($_SESSION['Customer_Id']);

include("app/models/Reservation.model.php");
$reservation = new Reservation();
$reservationData = $reservation::get_Reservation_by_customer($_SESSION['Customer_Id']);

include("app/models/Branch.model.php");
$branch = new Branch();
$branchData = $branch::get_all();

$errors = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(isset($_POST['update'])) {
        $errors = $customer::Update_Customer_Data();
    }

    if(isset($_POST['change_pass'])) {
        $errors = $customer::ChangePassword();
    }

}


include("app/views/my-account.view.php");