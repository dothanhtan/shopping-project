<?php 
    class Contact {
        var $id;
        var $name;
        var $email;
        var $phone;
        var $isChecked;
        var $userID;

        function Contact($id, $name, $email, $phone, $isChecked, $userID) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->phone = $phone;
            $this->isChecked = $isChecked;
            $this->userID = $userID;
        }
    
        static function connectToDB() {
            $con = new mysqli("localhost:3308", "root", "", "Contact");
            $con->set_charset("utf8");
            if($con->connect_error)
                die("Ket noi that bai. Chi tiet: " . $con->connect_error);
            return $con;
        }

        static function getContactByUser($user_id){
            $con = Contact::connectToDB();

            $sql = "SELECT * FROM Contact WHERE Contact.UserID = $user_id";
            $result = $con->query($sql);
            $arrContact = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $contact = new Contact($row["ID"], $row["Name"], $row["Email"], $row["Phone"], $row["IsChecked"], $row["UserID"]);
                    array_push($arrContact, $contact);
                }
            }
            $con->close();
            return $arrContact;
        }

        static function getContactByLabel($label_id){
            $con = Contact::connectToDB();

            $sql = "SELECT * FROM Contact, Contact_Label WHERE Contact.ID = Contact_Label.ContactID AND Contact_Label.LabelID = $label_id";
            $result = $con->query($sql);
            $arrContact = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $contact = new Contact($row["ID"], $row["Name"], $row["Email"], $row["Phone"], $row["IsChecked"], $row["UserID"]);
                    array_push($arrContact, $contact);
                }
            }
            $con->close();
            return $arrContact;
        }
        
        static function searchContact($info, $user_id) {
            $con = Contact::connectToDB();

            $sql = "SELECT * FROM Contact WHERE (Contact.Name LIKE '%$info%' OR Contact.Email LIKE '%$info%' OR Contact.Phone LIKE '%$info%') AND Contact.UserID = $user_id";
            $result = $con->query($sql);
            $arrContact = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $contact = new Contact($row["ID"], $row["Name"], $row["Email"], $row["Phone"], $row["IsChecked"], $row["UserID"]);
                    array_push($arrContact, $contact);
                }
            }
            $con->close();
            return $arrContact;
        }

        static function create($name, $phone, $email, $user_id, $label_id) {
            $con = Contact::connectToDB();
            $res = new stdClass();

            // Check if contact phone is already exists
            $arrContact = Contact::getContactByUser($user_id);
            foreach($arrContact as $key => $value){
                if($value->phone == $phone) {
                    $res->status = 'Exists';
                    return $res;
                }
            }

            // INSERT TO DB
            $sql = "INSERT INTO Contact (Name, Email, Phone, IsChecked, UserID) VALUES ('$name', '$email', '$phone', false, $user_id)";
            $result = $con->query($sql);
            $id = $con->insert_id;
            $sql2 = "INSERT INTO Contact_Label (ContactID, LabelID) VALUES ($id, $label_id)";
            $result2 = $con->query($sql2);            
            if($result && $result2) {
                $contact = new Contact($id, $name, $email, $phone, false, $user_id);
                $con->close();
                $res->status = 'Success';
                $res->contact = $contact;
            }
            else {
                $res->status = 'Error';
            }
            return $res;
        }
    }

?>