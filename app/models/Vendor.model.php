<?php 

Class Vendor
{


	public static function Reister(){

        $data = array();
        $errors = array();
        $db = Database::getInstance();

        include_once "app/core/Validator.php";

        $Validate = new Validator();

        if (! Validator::string($_POST['s-username'], 1, 50)) {
            $errors[''] = 'The Name of no more than 50 characters is required.';

        }

        //check username already exist
        $sql = "select * from vendors where username = :username limit 1";
        $arr['username'] = Validator::sanitizeInput($_POST['s-username']);

        $check = $db->read($sql,$arr);

        if(is_array($check) && count($check) > 0){
            array_push($errors, 'This username is already in use');
            // show($check);
        }

        if (! Validator::email($_POST['s-email'])) {
            array_push($errors, 'Please Enter Valid Email Address.');
        }

        //check email already exist
        $sql = "select * from vendors where Email = :email limit 1";
        $arrr['email'] = Validator::sanitizeInput($_POST['s-email']);

        $check = $db->read($sql,$arrr);

        if(is_array($check) && count($check) > 0){
            array_push($errors, 'This email is already in use');
            // show($check);
        }


        if( ! Validator::password($_POST['s-password'])) {
            array_push($errors, 'password must have more than 6 characters, must have Capital and Simple letters with numbers and special Characters');
        }

        if( $_POST['s-password'] !== $_POST['s-cpassword']) {
            
            array_push($errors, 'Password didn\'t match');
        }



        if( empty($errors)) {

            $data['username'] = Validator::sanitizeInput($_POST['s-username']);
            $data['Email'] = Validator::sanitizeInput($_POST['s-email']);
            $data['password'] = Validator::sanitizeInput($_POST['s-password']);
            $data['last_login'] = date("Y-m-d H:i:s");
            $data['Reg_Date'] = date("Y-m-d H:i:s");

            //encrypt password
            $data['password'] = hash('sha3-256',$data['password']);

            $query = "insert into vendors (username,Email,Password,last_login,Reg_Date) values
            (:username,:Email,:password,:last_login,:Reg_Date)";

            $result = $db->write($query,$data);

            if($result){

                self::Login_to_system($data['Email'], $data['Password']);
                sweetAlert("Sign up success!","welcome to mobisewum!, Please Login to continue","success");

                header("Location: ".BASE_URL."/create_shop");
                die;
                
            }
            else{
                return $errors;
            }
        }
        else{
            return $errors;
        }


    }

    public static function Login($email, $password){

        $data = array();
        $errors = array();

        include "app/core/Validator.php";

        $Validate = new Validator();

        if (! Validator::email($email)) {
            $errors[''] = 'Please Enter Valid Email Address.';
        }

        if( ! Validator::password($password)) {
            $errors[''] = 'Please Enter Valid Password';
        }

        // $password = Validator::sanitizeInput($password);
        $email = Validator::sanitizeInput($email);

        if(empty($errors)){

            if (self::Login_to_system($email, $password)){

                sweetAlert("Login success!","welcome back " . $_SESSION['Customer_Name'],"success");
                header("Location: ".BASE_URL."/vendor-dashboard");
                die;
            }else{
                $errors[''] = "Invalid credentials, User not found";

                return $errors;
            }

        }else{
            return $errors;
        }

        
    }

    public static function Login_to_system($email, $password){

        $data = array();
        $errors = array();
        $db = Database::getInstance();

        //check user exist
        $sql = "select * from vendors where Email = :email and password = :password limit 1";
        $arr['email'] = $email;
        $arr['password'] = hash('sha3-256',$password);

        show($arr);

        $check = $db->read($sql,$arr);


        if(is_array($check) && count($check) > 0){
           

            $_SESSION['Vendor_id'] = $check[0]['id'];
            $_SESSION['username'] = $check[0]['username'];
            $_SESSION['have_shop'] = $check[0]['have_shop'] == 1 ? true : false;

            session_regenerate_id();
            
            return true;
        }else{
            return false;
            
        }
    }

    public static function get_customer_by_id($id)
    {
        $DB = Database::getInstance();

        return $DB->read("select * from vendors where id = :id limit 1", array('id' => $id));
    }

    // public static function Update_Customer_Data() {
    //     $data = array();
    //     $errors = array();
    //     $db = Database::getInstance();
    
    //     include "app/core/Validator.php";
    
    //     $Validate = new Validator();
    
    //     if (!Validator::string($_POST['reg-name'], 1, 50)) {
    //         $errors[] = 'The Name of no more than 50 characters is required.';
    //     }
    
    //     if (!Validator::email($_POST['reg-email'])) {
    //         $errors[] = 'Please Enter a Valid Email Address.';
    //     }
    
    //     // Check if the updated email already exists but is not associated with the current customer.
    //     $sql = "SELECT * FROM customers WHERE Email = :email AND Customer_id != :customerId LIMIT 1";
    //     $arr['email'] = $_POST['reg-email'];
    //     $arr['customerId'] = $_SESSION['Customer_Id'];
    
    //     $check = $db->read($sql, $arr);
    
    //     if (is_array($check) && count($check) > 0) {
    //         $errors[] = 'This email is already in use';
    //     }
    
    //     if (!Validator::string($_POST['reg-phone'], 5, 50)) {
    //         $errors[] = 'Please Enter a Valid Phone number';
    //     }
    
    //     if (!Validator::date($_POST['reg-dob'], '1900-01-01', '2024-01-01')) {
    //         $errors[] = 'Please Enter a valid Date of Birth';
    //     }
    
    //     // Check if the user entered the right branch number
    //     $branch = new Branch();
    
    //     if (!$branch->branch_exists($_POST['res-branch'])) {
    //         $errors[] = 'Please select a Valid Branch';
    //     }
    
    //     if (!Validator::string($_POST['NIC'], 6, 20)) {
    //         $errors[] = 'Please Enter a Valid NIC Number';
    //     }
    
    //     if (!Validator::string($_POST['Address'], 10, 300)) {
    //         $errors[] = 'Please Enter a Valid Address';
    //     }
    
    //     if (empty($errors)) {
    //         $data['Name'] = $_POST['reg-name'];
    //         $data['Email'] = $_POST['reg-email'];
    //         $data['Phone'] = $_POST['reg-phone'];
    //         $data['DOB'] = $_POST['reg-dob'];
    //         $data['PreparedBranch'] = $_POST['res-branch'];
    //         $data['NIC'] = $_POST['NIC'];
    //         $data['Address'] = $_POST['Address'];
    
    //         $query = "UPDATE customers SET Name = :Name, Email = :Email, Phone = :Phone, DOB = :DOB, PreparedBranch = :PreparedBranch, NIC = :NIC, Address = :Address WHERE Customer_id = :customerId";
    //         $data['customerId'] = $_SESSION['Customer_Id'];
    
    //         $result = $db->write($query, $data);
    
    //         if ($result) {
    //             sweetAlert("Update success!", "Your customer data has been updated successfully.", "success");
    //             header("Location: " . BASE_URL . "/my-account");
    //             die;
    //         } else {
    //             return $errors;
    //         }
    //     } else {
    //         return $errors;
    //     }
    // }

    public static function ChangePassword() {
        $data = array();
        $errors = array();
        $db = Database::getInstance();

        $customerId = $_SESSION['Customer_Id'];
    
        include "app/core/Validator.php";
    
        $Validate = new Validator();
    
        // Validate the current password
        $currentPassword = $_POST['current_pass'];
        $newPassword = $_POST['new_pass'];
        $confirmPassword = $_POST['confirm_pass'];
    
        // Verify the current password
        $userData  = self::get_customer_by_id($_SESSION['Customer_Id']);
        $currentPassword = hash('sha3-256', $currentPassword);

        if( $userData[0]['Password'] !== $currentPassword) {
            $errors[] = 'Current password is incorrect';
        }
        
    
        if (!Validator::password($newPassword)) {
            $errors[] = 'New password must have more than 6 characters, must have capital and simple letters with numbers and special characters';
        }
    
        if ($newPassword !== $confirmPassword) {
            $errors[] = 'New password and confirm password do not match';
        }
    
        if (empty($errors)) {
            // Hash and update the new password in the database (You may need to modify this logic based on your system's password hashing mechanism).
            $hashedPassword = hash('sha3-256', $newPassword);
            $data['Password'] = $hashedPassword;
            $data['customerId'] = $customerId;
    
            $query = "UPDATE customers SET Password = :Password WHERE Customer_id = :customerId";
    
            $result = $db->write($query, $data);
    
            if ($result) {
                sweetAlert("Password changed!", "Your password has been successfully changed.", "success");
                header("Location: " . BASE_URL . "/my-account"); // Redirect to the profile page or any desired page.
                die;
            } else {
                return $errors;
            }
        } else {
            return $errors;
        }
    }

    public static function get_all() {
        
        $DB = Database::getInstance();
        return $DB->read("select * from vendors");
    }
    
    
	
}