<?php 

Class Contact
{


	public static function get_all()
	{

		$DB = Database::getInstance();
		return $DB->read("select * from contact_us order by id desc");

	}

	public static function add_new($name, $email, $message){

        $DB = Database::getInstance();

        include "app/core/Validator.php";

        $errors = array();

        if (!Validator::string($name, 5, 50)) {
            array_push($errors, 'The Name of no more than 50 characters is required.');
        }

        if (!Validator::email($email)) {
            array_push($errors, 'Please Enter Valid Email.');
        }

        if(!Validator::string($message, 5, 800)) {
            array_push($errors, 'The Message of no more than 800 characters is required.');
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $data = array(
            'name' => $name,
            'email' => $email,
            'msg' => $message
        );

        $query = "insert into contact_us (name, email, msg) values
        (:name, :email, :msg)";

        $result = $DB->write($query,$data);

        if($result){
            sweetAlert("Your Response submited successfully", "Our team will get back to you, soon", "success");
        }
    }

	
}