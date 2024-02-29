<?php

if(!isset($_SESSION['admin_name'])){
    die;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    // Validate and sanitize the input
    $category_name = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);

    // Include the Validator class
    include "app/core/Validator.php";

    // Check if the category_name is not empty
    if (Validator::string($category_name, 1, 20)) {
        
        include "app/models/Category.model.php";

        $category = new Category();

        if($category::edit_category($category_id, $category_name)){
            $response = array('success' => true, 'message' => 'Category Edited successfully.');
        }else{
            $response = array('success' => false, 'message' => 'Category could not be Edited.');
        }

        // Send JSON response back to the client
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => 'Category name is empty.');
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
