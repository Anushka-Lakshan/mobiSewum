<?php

include("app/models/Branch.model.php");

$branch = new Branch();

$branches = $branch::get_all();

$errors = "";


if($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['full-name'];
    $email = $_POST['email'];
    $message = $_POST['res-msg'];

    if(!empty($name) && !empty($email) && !empty($message)) {
        
        include("app/models/Contact.model.php");

        $contact = new Contact();

        $errors = $contact::add_new($name, $email, $message);
    }

}

include("app/views/contact.view.php");