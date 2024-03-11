<?php

require 'vendor/autoload.php';
require_once 'functions.php';

set_time_limit(1000);



if(!isset($_SESSION['admin_name'])){
    header("Location: " .BASE_URL . "/404");
}

// Assuming 'scrap' is a subdirectory of the current directory
$scrapFolder = __DIR__ . '/scrap/';

// Get all PHP files in the 'scrap' folder
$scrapFiles = glob($scrapFolder . '*.php');

// Loop through each PHP file and include/require it
foreach ($scrapFiles as $file) {
    require_once $file;
}

$success = 'success';

// Call the 'main' function in each included file
foreach (get_defined_functions()['user'] as $function) {
    if (substr($function, 0, 4) === 'main') {
        try {
            call_user_func($function);
        } catch (Exception $e) {
            // Echo the error message and continue with the next iteration
            echo "Error in function $function: " . $e->getMessage() . PHP_EOL . 'Continue...<br>' . PHP_EOL;
            $success = 'fail';
        }
    }
}



// Get the current date and time
$currentDate = date('Y-m-d');
$currentTime = date('H-i-s');

// Existing CSV file name
$oldCsvFileName = 'scraped_data.csv';

// New CSV file name
$newCsvFileName = "scraped_data_{$currentDate}_{$currentTime}.csv";





// Destination folder
$destinationFolder = 'web_scrap/scraped_data';

// Check if the destination folder exists, if not, create it
if (!is_dir($destinationFolder)) {
    mkdir($destinationFolder);
}

// Move the file to the destination folder and rename it
if (rename($oldCsvFileName, $destinationFolder . '/' . $newCsvFileName)) {
    echo "File moved and renamed successfully. {$newCsvFileName} <br>";
    //add database log
    $con = mysqli_connect('localhost', 'root', '', 'mobisewum');

    $sql = "INSERT INTO scrap_log (file_name, status, run_by) VALUES ('{$newCsvFileName}', '{$success}', '{$_SESSION['admin_name']}');";

    if ($con->query($sql) === TRUE) {
        echo "Record inserted successfully";

        sweetAlert('Scraping Completed. {$newCsvFileName}', 'success');
    } else {
        echo "Error inserting record: " . $con->error;
    }

    $con->close();
} else {
    echo "Error moving or renaming the file.";
}

echo "<br> <a href='" . BASE_URL . "/admin-dashboard?page=scraping'><button type='button' style='margin-top: 10px; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;'>Back to Admin Panel</button> </a>";