<?php 
    class Label {
        var $id;
        var $name;
        var $userID;

        function Label($id, $name, $userID) {
            $this->id = $id;
            $this->name = $name;
            $this->userID = $userID;
        }
    
        static function connectToDB() {
            $con = new mysqli("localhost:3308", "root", "", "Contact");
            $con->set_charset("utf8");
            if($con->connect_error)
                die("Ket noi that bai. Chi tiet: " . $con->connect_error);
            return $con;
        }

        static function getLabelByUser($user_id){
            $con = Label::connectToDB();

            $sql = "SELECT * FROM Label WHERE Label.UserID = $user_id";
            $result = $con->query($sql);
            $arrLabel = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $label = new Label($row["ID"], $row["Name"], $row["UserID"]);
                    array_push($arrLabel, $label);
                }
            }
            $con->close();
            return $arrLabel;
        }

        static function countContactByLabel($label_id){
            $con = Label::connectToDB();

            $sql = "SELECT * FROM Contact_Label WHERE Contact_Label.LabelID = $label_id ";
            $result = $con->query($sql);
            $con->close();
            return $result->num_rows;
        }

        static function create($name, $user_id){
            $con = Label::connectToDB();
            $res = new stdClass();

            // Check if label name is already exists
            $arrLabel = Label::getLabelByUser($user_id);
            foreach($arrLabel as $key => $value){
                if($value->name == $name) {
                    $res->status = 'Exists';
                    return $res;
                }
            }

            // INSERT TO DB
            $sql = "INSERT INTO Label (Name, UserID) VALUES ('$name', $user_id)";
            $result = $con->query($sql);            
            if($result) {
                $id = $con->insert_id;
                $label = new Label($id, $name, $user_id);
                $con->close();
                $res->status = 'Success';
                $res->label = $label;
            }
            else {
                $res->status = 'Error';
            }
            return $res;
        }
    }

?>