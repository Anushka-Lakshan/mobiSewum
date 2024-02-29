<?php



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    // Validate and sanitize the input
    $product_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

    // sweetAlert("Success", "data received" . $product_id, "success");

    // Check if the category_name is not empty
    if (is_numeric($product_id)) {
        
        include "app/models/Food.model.php";

        $food = new Food();

        $item = $food::get_item_by_id($product_id);

        // if($item[0]['id']) {
        //     $response = array('success' => false, 'message' => 'Invalid product', 'data' => json_encode($item[0]));
        //     exit;
        // }

        $cart_item = array(
            'id' => $item[0]['id'],
            'name' => $item[0]['name'],
            'price' => $item[0]['price'],
            'quantity' => 1,
            'img' => $item[0]['img']
        );

        //check item already in cart
        $in_array =  false;
        $item_key = null;
        if(isset($_SESSION['cart'])) {

            foreach($_SESSION['cart'] as $key => $value) {
                if($value['id'] == $cart_item['id']) {
                    $in_array = true;
                    $item_key = $key;
                }
            }

            if($in_array) {
                $_SESSION['cart'][$item_key]['quantity'] += 1;
                $response = array('success' => true, 'message' => 'Item quentity increased');
            }
            else{
                array_push($_SESSION['cart'], $cart_item);
                $response = array('success' => true, 'message' => 'Item added to cart');
            }


        }else{
            $response = array('success' => false, 'message' => 'test response', 'data' => json_encode($cart_item));
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
