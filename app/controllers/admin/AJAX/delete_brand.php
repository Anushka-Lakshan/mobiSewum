<?php

// if(!isset($_SESSION['admin_name'])){
//     die;
// }

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    // Validate and sanitize the input
    $Brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_SANITIZE_NUMBER_INT);

    // Include the Validator class
    include "app/core/Validator.php";

    $brand_id = Validator::sanitizeInput($_POST['brand_id']);

    // Check if the brand_name is not empty
    if (!empty($brand_id)) {
        
        include "app/models/Brands.model.php";

        $brand = new Brands();

        if($brand::delete_brand($brand_id)){
            $response = array('success' => true, 'message' => 'brand Deleted successfully.');
        }else{
            $response = array('success' => false, 'message' => 'brand could not be deleted.');
        }

        // Send JSON response back to the client
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => 'brand name is empty.');
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
