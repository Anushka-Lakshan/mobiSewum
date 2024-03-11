<?php


if (!isset($_SESSION['Vendor_id']) && !isset($_SESSION['username'])) {
    header("Location: " . BASE_URL . "/List_prices");
    die();
}

if ($_SESSION['have_shop'] == true) {
    header("Location: " . BASE_URL . "/vendor-dashboard");
    die();
}

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    

    


    if (!isset($_POST['business_name']) && empty($_POST['business_name'])) {
        array_push($errors, "Please enter business name");
    }
    if (!isset($_POST['business_email']) && empty($_POST['business_email'])) {
        array_push($errors, "Please enter business email");
    }
    if (!isset($_POST['business_registration']) && empty($_POST['business_registration'])) {
        array_push($errors, "Please enter business registration number");
    }
    if (!isset($_POST['business_telephone']) && empty($_POST['business_telephone'])) {
        array_push($errors, "Please enter business telephone");
    }


    include_once "app/core/Validator.php";

    if (!Validator::email($_POST['business_email'])) {
        array_push($errors, "Please enter valid business email");
    }

    $name = Validator::sanitizeInput($_POST['business_name']);
    $email = Validator::sanitizeInput($_POST['business_email']);
    $registration = Validator::sanitizeInput($_POST['business_registration']);
    $telephone = Validator::sanitizeInput($_POST['business_telephone']);

    // Check if file upload is successful
    if ($_FILES["business_logo"]["error"] == UPLOAD_ERR_OK && $_FILES["shop_image"]["error"] == UPLOAD_ERR_OK) {
        // File upload was successful


        // $file = $_FILES['image'];
        $fileExtension1 = pathinfo($_FILES["business_logo"]['name'], PATHINFO_EXTENSION);
        $fileExtension2 = pathinfo($_FILES["shop_image"]['name'], PATHINFO_EXTENSION);

        // Check if the file is an image (you can use additional checks)
        $imageInfo = @getimagesize($_FILES["business_logo"]['tmp_name']);
        $imageInfo2 = @getimagesize($_FILES["shop_image"]['tmp_name']);

        if ($imageInfo === false || $imageInfo2 === false) {
            array_push($errors, 'The file is not an image.');
        }

        // Set a maximum file size (in bytes)
        $maxFileSize = 2 * 1024 * 1024; // 2MB
        if ($_FILES["business_logo"]['size'] > $maxFileSize || $_FILES["shop_image"]['size'] > $maxFileSize) {
            array_push($errors, 'The file is too large. (Max size is 2MB)');
        }

        // Define the allowed file extensions
        $allowedExtensions = array('jpg', 'jpeg', 'png');

        // Check if the file extension is in the allowed list
        if (!in_array($fileExtension1, $allowedExtensions) || !in_array($fileExtension2, $allowedExtensions)) {
            array_push($errors, 'The file extension is not allowed.');
        }

        $newLogoName = "logo_" . uniqid() . '.' . $fileExtension1;
        $newShopName = "shop_" . uniqid() . '.' . $fileExtension2;

        // Define the upload directory outside of the web root
        $uploadDirectory = './assets/images/business/logos/' . $newLogoName;
        $uploadDirectory2 = './assets/images/business/shops/' . $newShopName;

        if (!move_uploaded_file($_FILES["business_logo"]['tmp_name'], $uploadDirectory)) {
            array_push($errors, 'Failed to upload the file.');
        }
        if (!move_uploaded_file($_FILES["shop_image"]['tmp_name'], $uploadDirectory2)) {
            array_push($errors, 'Failed to upload the file.');
        }
    } else {
        array_push($errors, 'Failed to upload the files.');
    }

    
    if (empty($errors)) {
        include_once "app/models/Shop.model.php";

        $result = Shop::add_shop($name, $email, $telephone, $registration, $newLogoName, $newShopName);

        if ($result) {
            $_SESSION['have_shop'] = true;
            header('Location: ' . BASE_URL . '/vendor-dashboard');
        } else {
            array_push($errors, "Shop could not be created, please try again");
        }
    }
}


include 'app/views/create_shop.view.php';
