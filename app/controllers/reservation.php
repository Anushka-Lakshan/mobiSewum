<?php

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $date = $_POST['res-date'];
    $time = $_POST['res-time'];
    $persons = $_POST['res-persons'];
    $email = $_POST['res-email'];
    $fname = $_POST['res-fname'];
    $phone = $_POST['res-phone'];
    $branchID = $_POST['res-branch'];
    $msg = $_POST['res-msg'];

    include "app/models/Reservation.model.php";
    $reservation = new Reservation();
    $reservation = $reservation::add_reservation($branchID, $date, $time, $persons, $email, $fname, $phone, $msg);

    if ($reservation) {
        sweetAlert("Reservation has been made successfully", "Our staff will contact you shortly! thank you", "success");
        header("Location: ".BASE_URL."/");
        die;
    }
    else{
        sweetAlert("Something went wrong", "Please try again", "error");

    }
}

include("app/models/Branch.model.php");
$branch = new Branch();
$branches = $branch::get_all();

include("app/views/reservation.view.php");