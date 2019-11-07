<?php 

    // Create label
    include_once('../model/label.php');
    $user_id = $_REQUEST["new_label"]["user_id"];
    $name = $_REQUEST["new_label"]["name"];
    $label = Label::create($name, $user_id);
    echo json_encode($label);
?>