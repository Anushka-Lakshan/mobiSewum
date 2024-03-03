<?php
include_once 'functions.php';




// Connect to MySQL
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the latest successful scrap log entry
$query = "SELECT * FROM scrap_log WHERE status = 'success' ORDER BY DateTime DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $csvFilename = $row['file_name'];


    // Assuming CSV file is in the 'scraped_data' folder
    $csvFilePath = "web_scrap/scraped_data/{$csvFilename}";

    // Read CSV file and insert data into 'products' table
    if (file_exists($csvFilePath)) {
        $csvData = array_map('str_getcsv', file($csvFilePath));

        // Insert data into 'products' table
        $insertQuery = "INSERT INTO online_mobiles (name, price,price_int, img, link, shop, in_stock) 
        VALUES ";
        
        // Assuming CSV file structure: name, price, img_url, link, shop, in_stock
        foreach ($csvData as $row) {
            $name = htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8');
            $price = htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8');;
            $priceInt = $row[2];
            $img_url = $row[3];
            $link = $row[4];
            $shop = $row[5];
            $in_stock = $row[6] === '1' ? 1 : 0;

            $insertQuery .= "('$name', '$price', $priceInt, '$img_url', '$link', '$shop', $in_stock), ";

            
        }

        $insertQuery = rtrim($insertQuery, ', ');

        $deleteQuery = 'DELETE FROM online_mobiles';


        try {
            // Delete all previous data
            if ($conn->query($deleteQuery) === TRUE) {
                echo "Old data deleted successfully. <br>";
            }
            
            // Insert new data
            if ($conn->query($insertQuery) === TRUE) {
                echo "Latest Data inserted into 'products' table successfully.";
            }

            
        } catch (Exception $e) {
            echo "Error inserting data into 'products' table: " . $e->getMessage();
        }

        
    } else {
        echo "CSV file not found.";
    }
} else {
    echo "No successful scrap log entry found.";
}

// Close database connection
$conn->close();

?>
