<?php

class Order
{


    public static function get_all()
    {

        $DB = Database::getInstance();
        return $DB->read("select orders.*, branches.Name AS 'branch_name', customers.Name AS 'customer_name' from orders
        inner join branches on orders.branch_id = branches.Branch_Id inner join customers on orders.customer_id = customers.Customer_Id order by orders.id desc");
    }

    public static function get_item_by_id($id)
    {
        $DB = Database::getInstance();

        return $DB->read("select orders.*, branches.Name AS 'branch_name', customers.Name AS 'customer_name' from orders
        inner join branches on orders.branch_id = branches.Branch_Id inner join customers on orders.customer_id = customers.Customer_Id where orders.id = :id limit 1", array('id' => $id));
    }

    public static function get_item_by_customer($id)
    {
        $DB = Database::getInstance();

        return $DB->read("SELECT orders.*, branches.Name AS 'branch_name' FROM orders INNER JOIN branches ON orders.branch_id = branches.Branch_Id WHERE orders.customer_id = :id ORDER BY orders.id DESC", array('id' => $id));
    }

    public static function add_order($cartData, $location = [])
    {
        $DB = Database::getInstance();

        $errors = array();

        include "app/core/Validator.php";

        if (!Validator::string($_POST['ord-name'], 1, 50)) {
            array_push($errors, 'The Name of no more than 50 characters is required.');
        }

        if (!Validator::string($_POST['ord-Address'], 1, 200)) {
            array_push($errors, 'The Address of no more than 200 characters is required.');
        }

        if (!Validator::string($_POST['ord-note'], 0, 400)) {
            array_push($errors, 'The Note of no more than 400 characters');
        }

        if (!Validator::string($_POST['payment'], 1, 50) && ($_POST['payment'] == "Cash" || $_POST['payment'] == "Online")) {
            array_push($errors, 'The Payment method is required.');
            
        }

        if(is_numeric($_POST['ord-branch'])) {
            
            include "app/models/Branch.model.php";
            $branch = new Branch();

            if($branch::branch_exists($_POST['ord-branch'])) {
                array_push($errors, 'The Branch is not exist.');
            }
        }
        else{
            array_push($errors, 'The Branch is required.');
        }

        
        
        if(count($errors) > 0) {
            return $errors;
        }
        else{

            $DBdata = array(
                'customer_id' => $_SESSION['Customer_Id'],
                'name' => $_POST['ord-name'],
                'branch_id' => $_POST['ord-branch'],
                'order_details' => $cartData,
                'status' => 'Pending',
                'ordered_dt' => date('Y-m-d H:i:s'),
                'location' => $location,
                'user_note' => $_POST['ord-note'],
                'payment_method' => $_POST['payment'],
                'address' => $_POST['ord-Address'],
                'admin_note' => ""
            );

            $query = "insert into orders 
                (customer_id, name, branch_id, order_details, status, ordered_dt, location, user_note, payment_method, address, admin_note) values 
                (:customer_id, :name, :branch_id, :order_details, :status, :ordered_dt, :location, :user_note,:payment_method, :address, :admin_note)";

            $result = $DB->write($query, $DBdata);

            if($result) {
                return array('success' => true);
            } else {
                return array('Failed to add the item.');
            }
                
        }


    }

    public static function update_order_status($orderId, $newStatus,$change_by) {
        $DB = Database::getInstance();
    
        $query = "UPDATE orders SET status = :new_status , last_change = :change_by WHERE id = :order_id";
        $params = array('new_status' => $newStatus, 'order_id' => $orderId, 'change_by' => $change_by);
    
        $result = $DB->write($query, $params);
    
        if($result) {
            return array('success' => true);
        } else {
            return array('Failed to update order status.');
        }
    }
    

}
