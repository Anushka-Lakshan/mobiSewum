<?php 

Class Customer
{


	public static function Reister(){

        $data = array();
        $errors = array();
        $db = Database::getInstance();

        include "app/core/Validator.php";

        $Validate = new Validator();

        if (! Validator::string($_POST['reg-name'], 1, 50)) {
            $errors[''] = 'The Name of no more than 50 characters is required.';
        }

        if (! Validator::email($_POST['reg-email'])) {
            array_push($errors, 'Please Enter Valid Email Address.');
        }

        //check email already exist
        $sql = "select * from customers where Email = :email limit 1";
        $arr['email'] = $_POST['reg-email'];

        $check = $db->read($sql,$arr);

        if(is_array($check) && count($check) > 0){
            array_push($errors, 'This email is already in use');
            // show($check);
        }

        if (! Validator::string($_POST['reg-phone'], 5, 50)) {
            array_push($errors, 'Please Enter Valid Phone number');
        }

        if (! Validator::date($_POST['reg-dob'], '1900-01-01', '2024-01-01')) {
            array_push($errors, 'Please Enter valid Date of Birth');
        }

        //check user entered the right branch number

        $branch = new Branch();
        
        if(! $branch->branch_exists($_POST['res-branch'])){
            array_push($errors, 'Please select Valid Branch');
        }

        if( ! Validator::string($_POST['NIC'], 6, 20)) {
            array_push($errors, 'Please Enter Valid NIC Number');
        }

        if( ! Validator::password($_POST['reg-pass'])) {
            array_push($errors, 'password must have more than 6 characters, must have Capital and Simple letters with numbers and special Characters');
        }

        if( $_POST['reg-pass'] !== $_POST['reg-pass2']) {
            
            array_push($errors, 'Password didn\'t match');
        }

        if( ! Validator::string($_POST['reg-Address'], 10, 300)) {
            
            array_push($errors, 'Please Enter Valid Address');
        }


        if( empty($errors)) {

            $data['Name'] = $_POST['reg-name'];
            $data['Email'] = $_POST['reg-email'];
            $data['Phone'] = $_POST['reg-phone'];
            $data['DOB'] = $_POST['reg-dob'];
            $data['PreparedBranch'] = $_POST['res-branch'];
            $data['NIC'] = $_POST['NIC'];
            $data['Password'] = $_POST['reg-pass'];
            $data['Address'] = $_POST['reg-Address'];
            $data['Reg_Date'] = date("Y-m-d H:i:s");

            //encrypt password
            $data['Password'] = hash('sha3-256',$data['Password']);

            $query = "insert into customers (Name,Email,Phone,DOB,PreparedBranch,NIC,Password,Address,Reg_Date) values
            (:Name,:Email,:Phone,:DOB,:PreparedBranch,:NIC,:Password,:Address,:Reg_Date)";

            $result = $db->write($query,$data);

            if($result){

                self::Login_to_system($data['Email'], $data['Password']);
                sweetAlert("Sign up success!","welcome to Signature Cuisine family!, Please Login to continue","success");

                header("Location: ".BASE_URL."/login");
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

        if(empty($errors)){

            if (self::Login_to_system($email, $password)){

                sweetAlert("Login success!","welcome back " . $_SESSION['Customer_Name'],"success");
                header("Location: ".BASE_URL."/");
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
        $sql = "select * from customers where Email = :email and Password = :password limit 1";
        $arr['email'] = $email;
        $arr['password'] = hash('sha3-256',$password);

        $check = $db->read($sql,$arr);


        if(is_array($check) && count($check) > 0){
           

            $_SESSION['Customer_Id'] = $check[0]['Customer_Id'];
            $_SESSION['Customer_Name'] = $check[0]['Name'];

            session_regenerate_id();
            
            return true;
        }else{
            return false;
            
        }
    }

    public static function get_customer_by_id($id)
    {
        $DB = Database::getInstance();

        return $DB->read("select * from customers where Customer_Id = :id limit 1", array('id' => $id));
    }

    public static function Update_Customer_Data() {
        $data = array();
        $errors = array();
        $db = Database::getInstance();
    
        include "app/core/Validator.php";
    
        $Validate = new Validator();
    
        if (!Validator::string($_POST['reg-name'], 1, 50)) {
            $errors[] = 'The Name of no more than 50 characters is required.';
        }
    
        if (!Validator::email($_POST['reg-email'])) {
            $errors[] = 'Please Enter a Valid Email Address.';
        }
    
        // Check if the updated email already exists but is not associated with the current customer.
        $sql = "SELECT * FROM customers WHERE Email = :email AND Customer_id != :customerId LIMIT 1";
        $arr['email'] = $_POST['reg-email'];
        $arr['customerId'] = $_SESSION['Customer_Id'];
    
        $check = $db->read($sql, $arr);
    
        if (is_array($check) && count($check) > 0) {
            $errors[] = 'This email is already in use';
        }
    
        if (!Validator::string($_POST['reg-phone'], 5, 50)) {
            $errors[] = 'Please Enter a Valid Phone number';
        }
    
        if (!Validator::date($_POST['reg-dob'], '1900-01-01', '2024-01-01')) {
            $errors[] = 'Please Enter a valid Date of Birth';
        }
    
        // Check if the user entered the right branch number
        $branch = new Branch();
    
        if (!$branch->branch_exists($_POST['res-branch'])) {
            $errors[] = 'Please select a Valid Branch';
        }
    
        if (!Validator::string($_POST['NIC'], 6, 20)) {
            $errors[] = 'Please Enter a Valid NIC Number';
        }
    
        if (!Validator::string($_POST['Address'], 10, 300)) {
            $errors[] = 'Please Enter a Valid Address';
        }
    
        if (empty($errors)) {
            $data['Name'] = $_POST['reg-name'];
            $data['Email'] = $_POST['reg-email'];
            $data['Phone'] = $_POST['reg-phone'];
            $data['DOB'] = $_POST['reg-dob'];
            $data['PreparedBranch'] = $_POST['res-branch'];
            $data['NIC'] = $_POST['NIC'];
            $data['Address'] = $_POST['Address'];
    
            $query = "UPDATE customers SET Name = :Name, Email = :Email, Phone = :Phone, DOB = :DOB, PreparedBranch = :PreparedBranch, NIC = :NIC, Address = :Address WHERE Customer_id = :customerId";
            $data['customerId'] = $_SESSION['Customer_Id'];
    
            $result = $db->write($query, $data);
    
            if ($result) {
                sweetAlert("Update success!", "Your customer data has been updated successfully.", "success");
                header("Location: " . BASE_URL . "/my-account");
                die;
            } else {
                return $errors;
            }
        } else {
            return $errors;
        }
    }

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
        return $DB->read("select customers.*, branches.Name AS 'branch_name' from customers
        inner join branches on customers.PreparedBranch = branches.Branch_Id order by customers.Customer_Id desc");
    }
    
    
	
}