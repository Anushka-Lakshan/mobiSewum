<?php

if(!isset($_SESSION['admin_name'])){
    die;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    // Validate and sanitize the input
    $food_id = filter_input(INPUT_POST, 'food_id', FILTER_SANITIZE_NUMBER_INT);


    // Check if the category_name is not empty
    if (!empty($food_id)) {
        
        include "app/models/Food.model.php";

        $food = new Food();

        if($food = $food::delete_food_item($food_id)){
            $response = array('success' => true, 'message' => 'Item Deleted successfully.');
        }else{
            $response = array('success' => false, 'message' => 'Item could not be deleted.');
        }

        // Send JSON response back to the client
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => 'item name is empty.');
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
