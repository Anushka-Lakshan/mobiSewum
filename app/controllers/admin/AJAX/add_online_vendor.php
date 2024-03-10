<?php

if(!isset($_SESSION['admin_name'])){
    die;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the necessary form fields are set
        if (isset($_POST["name"]) && isset($_FILES["logo"]) && isset($_POST["shop"]) && isset($_POST["link"])) {
            // Process form data
            $Name = $_POST["name"];
            $Logo = $_FILES["logo"];
            $Shop = $_POST["shop"];
            $Link = $_POST["link"];

            include "app/core/Validator.php";

            if (!Validator::string($Name, 1, 50)) {
                echo "Error: Invalid brand name.";
                die;
            }

            if (!Validator::string($Shop, 1, 50)) {
                echo "Error: Invalid shop name.";
            }

            if (!Validator::string($Link)) {
                echo "Error: Invalid link.";
            }

            $Name = Validator::sanitizeInput($Name);

            // Check if file upload is successful
            if ($Logo["error"] == UPLOAD_ERR_OK) {
                // File upload was successful


                // $file = $_FILES['image'];
                $fileExtension = pathinfo($Logo['name'], PATHINFO_EXTENSION);

                // Check if the file is an image (you can use additional checks)
                $imageInfo = @getimagesize($Logo['tmp_name']);
                if ($imageInfo === false) {
                    // array_push($errors, 'The file is not an image.');
                    echo "Error: The file is not an image.";
                    die;
                }

                // Set a maximum file size (in bytes)
                $maxFileSize = 2 * 1024 * 1024; // 5MB
                if ($Logo['size'] > $maxFileSize) {
                    // array_push($errors, 'The file is too large. (Max size is 2MB)');
                    echo "Error: The file is too large. (Max size is 2MB)";
                    die;
                }

                // Define the allowed file extensions
                $allowedExtensions = array('jpg', 'jpeg', 'png');

                // Check if the file extension is in the allowed list
                if (!in_array($fileExtension, $allowedExtensions)) {
                    // array_push($errors, 'The file extension is not allowed.');
                    echo "Error: The file extension is not allowed.";
                    die;
                }

                $newFileName = "Brand_" . uniqid() . '.' . $fileExtension;

                // Define the upload directory outside of the web root
                $uploadDirectory = './assets/images/company-logos/' . $newFileName;

                if (!move_uploaded_file($Logo['tmp_name'], $uploadDirectory)) {
                    // array_push($errors, 'Failed to upload the file.');
                    echo "Error: Failed to upload the file.";

                    return $errors;
                }

                include "app/models/OnlineVendors.model.php";

                $result = OnlineVendors::add_Vendor($Name, $newFileName, $Shop, $Link);

                if ($result) {
                    $response = array('success' => true, 'message' => 'Brand added successfully');
                } else {
                    $response = array('success' => false, 'message' => 'Brand could not be added');
                }
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                // Error occurred during file upload
                echo "Error: " . $Logo["error"];
            }
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
