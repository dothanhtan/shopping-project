<?php 
    include_once('../model/danhba.php');
    include_once('../model/label.php');

    // Create label
    if(isset($_REQUEST["new_label"])) {
        $user_id = $_REQUEST["new_label"]["user_id"];
        $name = $_REQUEST["new_label"]["name"];
        $label = Label::create($name, $user_id);
        echo json_encode($label);
    }
    

    // Create contact
    if(isset($_REQUEST["new_contact"])) {
        $user_id = $_REQUEST["new_contact"]["user_id"];
        $label_id = $_REQUEST["new_contact"]["label_id"];
        $name = $_REQUEST["new_contact"]["name"];
        $phone = $_REQUEST["new_contact"]["phone"];
        $email = $_REQUEST["new_contact"]["email"];

        $contact = Contact::create($name, $phone, $email, $user_id, $label_id);
        echo json_encode($contact);
    }
?>