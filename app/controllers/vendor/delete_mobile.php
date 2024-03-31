<?php

if (!isset($_SESSION['Vendor_id']) || !isset($_SESSION['admin_name'])) {
    
    die();
}

include "app/core/Validator.php";

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the necessary form fields are set
        if (isset($_POST["m_id"])) {
            // Process form data

            $id = Validator::sanitizeInput($_POST["m_id"]);

            $id = (int)$id;

            if($id < 1){
                echo "Error: Invalid ID.";
                die;
            }

            include "app/models/VendorProducts.model.php";

            $result = VendorProducts::delete_mobile($id);

            if ($result) {
                $response = array('success' => true);
            } else {
                $response = array('success' => false, 'message' => 'Failed to delete vendor product.');
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // Required form fields are not set
            echo "Error: Missing form data.";
        }
    } else {
        // Form is not submitted using POST method
        echo "Error: Form not submitted.";
    }
} else {
    // Handle non-AJAX requests if necessary
    // Redirect, display an error, or take appropriate action
    // You can also send a JSON response with an error message
    $response = array('success' => false, 'error' => 'script failed');
    echo json_encode($response);
}
