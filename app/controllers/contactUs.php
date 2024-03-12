<?php

$errors = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $tel = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    include_once 'app/models/Contact.model.php';

    $errors = Contact::add_new($name, $tel, $email, $message);

}

include_once 'app/views/contact.view.php';