<?php

class Admin
{


    public static function Add_admin($data)
    {

        $errors = array();
        $db = Database::getInstance();

        include_once "app/core/Validator.php";

        $Validate = new Validator();

        if (!Validator::string($data['name'], 1, 50)) {
            $errors[''] = 'The Name of no more than 50 characters is required.';
        }

        if (!Validator::string($data['username'], 6, 30)) {
            array_push($errors, 'Username of no more than 30 characters is required.');
        }

        //check email already exist
        $sql = "select * from admins where username = :username limit 1";
        $arr['username'] = $data['username'];

        $check = $db->read($sql, $arr);

        if (is_array($check) && count($check) > 0) {
            array_push($errors, 'This Username is already in use');
            // show($check);
        }


        if (!Validator::password($data['password'])) {
            array_push($errors, 'password must have more than 6 characters, must have Capital and Simple letters with numbers and special Characters');
        }



        if (empty($errors)) {

            $DBdata = array(
                'name' => Validator::sanitizeInput($data['name']),
                'username' => Validator::sanitizeInput($data['username']),
                'password' => Validator::sanitizeInput($data['password']),
                
            );

            //encrypt password
            $DBdata['password'] = hash('sha3-256', $DBdata['password']);

            $query = "insert into admins (name,username,password) values
            (:name,:username,:password)";

            $result = $db->write($query, $DBdata);

            if ($result) {

                return array('success' => true);
            } else {
                return array('success' => false, 'errors' => $errors);
            }
        } else {
            return array('success' => false, 'errors' => $errors);
        }
    }

    public static function Login($username, $password)
    {

        $db = Database::getInstance();
        $errors = array();

        include "app/core/Validator.php";

        

        if (!Validator::string($username)) {
            $errors[''] = 'Please Enter Valid username';
        }

        if (!Validator::password($password)) {
            $errors[''] = 'Please Enter Valid Password';
        }

        $username = Validator::sanitizeInput($username);
        $password = Validator::sanitizeInput($password);

        if (empty($errors)) {


            $sql = "select * from admins where username = :username and password = :password limit 1";
            $arr['username'] = $username;
            $arr['password'] = hash('sha3-256', $password);

            $check = $db->read($sql, $arr);

            if (is_array($check) && count($check) > 0) {


                $_SESSION['admin_name'] = $check[0]['username'];
                

                session_regenerate_id();

                sweetAlert("Login success!", "welcome back " . $_SESSION['admin_name'], "success");
                header("Location: ".BASE_URL."/admin-dashboard");
                exit();
            } else {

                $errors[''] = "Invalid credentials, User not found";

                return $errors;
            }
            

        } else {
            return $errors;
        }
    }

    

    public static function get_all()
    {

        $DB = Database::getInstance();
        return $DB->read("select id,name,username from admins order by id asc");
    }

    public static function deleteAdmin($id, $uname)
    {

        $DB = Database::getInstance();
        $DBdata = array(
            'id' => $id,
            'username' => $uname
        );

        $query = "delete from admins where id = :id and username = :username limit 1";

        $result = $DB->write($query, $DBdata);

        if ($result) {
            return ['success' => true];
        }else{
            return ['success' => false , 'error' => 'failed to delete'];
        }

        
    }


    
    public static function edit_Admin($id, $name, $username, $password)
    {

        $errors = array();
        $db = Database::getInstance();

        include_once "app/core/Validator.php";

        $Validate = new Validator();

        if (!Validator::string($name, 1, 50)) {
            $errors[''] = 'The Name of no more than 50 characters is required.';
        }

        if (!Validator::string($username, 6, 30)) {
            array_push($errors, 'Username of no more than 30 characters is required.');
        }

        


        if (!Validator::password($password)) {
            array_push($errors, 'password must have more than 6 characters, must have Capital and Simple letters with numbers and special Characters');
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $DBdata = array(
            'id' => $id,
            'name' => $name,
            'username' => $username,
            'password' => $password
        );

        $DBdata['password'] = hash('sha3-256', $DBdata['password']);

        $query = "update admins set name = :name, username = :username, password = :password where id = :id";

        $result = $db->write($query, $DBdata);

        if ($result) {
            return array('success' => true);
        } else {
            return array('success' => false, 'errors' => $errors);
        }

    }

}
