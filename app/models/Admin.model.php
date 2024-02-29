<?php

class Admin
{


    public static function Add_member($data)
    {

        $errors = array();
        $db = Database::getInstance();

        include "app/core/Validator.php";

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

        if ($data['pass1'] !== $data['pass2']) {
            array_push($errors, 'Password didn\'t match');
        }

        if (!Validator::password($data['pass1'])) {
            array_push($errors, 'password must have more than 6 characters, must have Capital and Simple letters with numbers and special Characters');
        }



        if ($data['role'] !== 'admin' && $data['role'] !== 'stuff') {
            array_push($errors, 'Please select Valid Role');
        }




        if (empty($errors)) {

            $DBdata = array(
                'name' => $data['name'],
                'username' => $data['username'],
                'password' => $data['pass1'],
                'role' => $data['role'],
            );

            //encrypt password
            $DBdata['password'] = hash('sha3-256', $DBdata['password']);

            $query = "insert into admins (name,username,password,role) values
            (:name,:username,:password,:role)";

            $result = $db->write($query, $DBdata);

            if ($result) {

                sweetAlert("New Member Added", "success");

                return array('success' => true);
            } else {
                return $errors;
            }
        } else {
            return $errors;
        }
    }

    public static function Login($username, $password)
    {

        $db = Database::getInstance();
        $errors = array();

        include "app/core/Validator.php";

        $Validate = new Validator();

        if (!Validator::string($username)) {
            $errors[''] = 'Please Enter Valid username';
        }

        if (!Validator::password($password)) {
            $errors[''] = 'Please Enter Valid Password';
        }

        if (empty($errors)) {


            $sql = "select * from admins where username = :username and password = :password limit 1";
            $arr['username'] = $username;
            $arr['password'] = hash('sha3-256', $password);

            $check = $db->read($sql, $arr);

            if (is_array($check) && count($check) > 0) {


                $_SESSION['admin_name'] = $check[0]['username'];
                $_SESSION['admin_role'] = $check[0]['role'];

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
        return $DB->read("select id,name,username,role from admins order by id asc");
    }

    public static function deleteAdmin($id)
    {

        $DB = Database::getInstance();
        $DBdata = array(
            'id' => $id
        );

        $query = "delete from admins where id = :id";

        $result = $DB->write($query, $DBdata);

        if ($result) {
            return true;
        }else{
            return false;
        }

        
    }
}
