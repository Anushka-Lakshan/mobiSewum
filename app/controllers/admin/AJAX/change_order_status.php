<?php

if(!isset($_SESSION['admin_name'])){
    die;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    // Validate and sanitize the input
    $order_id = filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_NUMBER_INT);
    $status = $_POST['status'];

    // Include the Validator class
    include "app/core/Validator.php";
    if(!Validator::string($status)){
        $response = array('success' => false, 'error' => 'Status is invalid.');
        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }


    // Check if the category_name is not empty
    if (!empty($order_id)) {
        
        include "app/models/Order.model.php";

        $order = new Order();

        $changeBy = $_SESSION['admin_name'];

        $updateResult = Order::update_order_status($order_id, $status,$changeBy);

        if($updateResult['success']){
            $response = array('success' => true, 'message' => 'Order status updated successfully.');
        }else{
            $response = array('success' => false, 'message' => 'Order status could not be updated.');
        }

        // Send JSON response back to the client
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => 'Order ID is required.');
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // Handle non-AJAX requests if necessary
    // Redirect, display an error, or take appropriate action
    // You can also send a JSON response with an error message
    $response = array('success' => false, 'error' => 'script failed');
    echo json_encode($response);
}
