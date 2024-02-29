<?php

if(!isset($_SESSION['admin_name'])){
    die;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    // Validate and sanitize the input
    $category_id = filter_input(INPUT_POST, 'branch_id', FILTER_SANITIZE_NUMBER_INT);

    // Include the Validator class
    include "app/core/Validator.php";

    // Check if the category_name is not empty
    if (!empty($category_id)) {
        
        include "app/models/Branch.model.php";

        $category = new Branch();

        if($category::delete_branch($category_id)){
            $response = array('success' => true, 'message' => 'Branch Deleted successfully.');
        }else{
            $response = array('success' => false, 'message' => 'Branch could not be deleted.');
        }

        // Send JSON response back to the client
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => 'Branch name is empty.');
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
