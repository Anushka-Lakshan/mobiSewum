<?php



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    $response = array('success' => false, 'message' => 'something went wrong', 'data' => $_POST['action']);


    if($_POST['action'] == 'remove') {
        $product_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

        if (is_numeric($product_id)){

        foreach($_SESSION["cart"] as $keys => $values)  
           {  
                if($values["id"] == $product_id)  
                {  
                     unset($_SESSION["cart"][$keys]);
                     $response = array('success' => true, 'message' => 'Item removed from cart');
                }  
           }
        }else{
            $response = array('success' => false, 'message' => 'Item not valid');
        }
    }

    if ($_POST['action'] == 'update') {
        $product_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_SPECIAL_CHARS);

        if (is_numeric($product_id) && is_numeric($quantity)){

            $quantity = $quantity <= 0 ? 1 : $quantity;
            $quantity = $quantity > 10 ? 10 : $quantity;

            
            foreach($_SESSION["cart"] as $keys => $values)  
            {  
                if($values["id"] == $product_id)  
                {  
                    $_SESSION["cart"][$keys]["quantity"] = $quantity;
                    $response = array('success' => true, 'message' => 'Item quantity updated');
                }  
            }
        }else{
            $response = array('success' => false, 'message' => 'Item not valid');
        }
    }

    if ($_POST['action'] == 'removeAll') {

        unset($_SESSION["cart"]);

        $_SESSION["cart"] = array();

        $response = array('success' => true, 'message' => 'Cart cleared');
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
