<?php

if(!isset($_SESSION['admin_name'])){
    die;
}

include "app/core/Validator.php";

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the necessary form fields are set
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["id"])) {
            // Process form data

            $username = Validator::sanitizeInput($_POST["username"]);
            $password = Validator::sanitizeInput($_POST["password"]);
            $name = Validator::sanitizeInput($_POST["name"]);
            $id = Validator::sanitizeInput($_POST["id"]);


            if (!Validator::string($username, 1, 50)) {
                echo "Error: Invalid brand name.";
                die;
            }

            if (!Validator::string($name, 1, 50)) {
                echo "Error: Invalid name.";
                die;
            }


            include "app/models/Admin.model.php";

            

            $result = Admin::edit_Admin($id, $name, $username, $password);

            if ($result['success']) {
                $response = array('success' => true,);
            } else {
                $response = array('success' => false, 'message' => $result['errors']);
                
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
