<?php

function handleOrder(){

    $errors = [];

    $cartData = "";
    $location = "";

    if(count($_SESSION['cart']) == 0) {
        array_push($errors, 'The Cart is empty.');
    }else{
        $items = [];

            // Calculate the total, delivery, and sub_total
            $total = 0;
            $delivery = 300; // Adjust as needed
            $sub_total = 0;

            foreach ($_SESSION['cart'] as $item) {
                $name = $item["name"];
                $price = $item["price"];
                $quantity = $item["quantity"];

                $total += $price * $quantity;

                $items[] = [
                    "name" => $name,
                    "price" => $price,
                    "quantity" => $quantity,
                ];
            }

            $sub_total = $total + $delivery;

            // Create an array with the desired structure
            $data = [
                "items" => $items,
                "total" => $total,
                "delivery" => $delivery,
                "sub_total" => $sub_total,
            ];

            // Convert the array to JSON
            $cartData = json_encode($data);
    }

    if(isset($_POST['latitude']) && isset($_POST['longitude'])) {
        if(is_numeric($_POST['latitude']) && is_numeric($_POST['longitude'])) {
            $location = array(
                "latitude" => $_POST['latitude'],
                "longitude" => $_POST['longitude'],
            );

            $location = json_encode($location);
        }
    }

    if(count($errors) > 0) {
        return $errors;
    } else {
        include "app/models/Order.model.php";

        $order = new Order();

        $errors = $order::add_order($cartData, $location);

        if(isset($errors['success']) && $errors['success'] == true) {
            return array('success' => true);
        }else{
            return $errors;
        }
    }


}