<?php



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    $response = array('success' => false, 'message' => 'something went wrong', 'data' => $_POST);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST['res-date'];
        $time = $_POST['res-time'];
        $persons = $_POST['res-persons'];
        $email = $_POST['res-email'];
        $fname = $_POST['res-fname'];
        $phone = $_POST['res-phone'];
        $branchID = $_POST['res-branch'];
        $msg = $_POST['res-msg'];
    
        // Now you can use these variables to perform your database operations.

        include "app/models/Branch.model.php";
        $branch = new Branch();
        $branch = $branch::get_branch_by_id($branchID);

        $seatCapacity = $branch[0]['SeatCapacity'];

        include "app/models/Reservation.model.php";
        $reservation = new Reservation();
        $reservation = $reservation::get_Persons_by_time($branchID, $date, $time);

        $totalPersons = $reservation[0]['totalPersons'];

        if ($totalPersons + $persons > $seatCapacity) {
            $response = array('success' => false, 'message' => 'seats are not available', 'data' => $seatCapacity ."##". $totalPersons ."##". $persons);
        } else {
            $response = array('success' => true, 'message' => 'seats are available', 'data' => $seatCapacity ."##". $totalPersons ."##". $persons);
        }
    }



    

    header('Content-Type: application/json');
    echo json_encode($response);
    

} else {
    // Handle non-AJAX requests if necessary
    // Redirect, display an error, or take appropriate action
    // You can also send a JSON response with an error message
    $response = array('success' => false, 'error' => 'script failed');
    echo json_encode($response);
}
