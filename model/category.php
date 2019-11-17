<?php 
    class Category {
        var $id;
        var $name;
        var $quantity;

        function Category($id, $name, $quantity) {
            $this->id = $id;
            $this->name = $name;
            $this->quantity = $quantity;
        }
    
        static function connectToDB() {
            $con = new mysqli("localhost:3308", "root", "", "shop");
            $con->set_charset("utf8");
            if($con->connect_error)
                die("Ket noi that bai. Chi tiet: " . $con->connect_error);
            return $con;
        }

        static function getCategory(){
            $con = Category::connectToDB();

            $sql = "SELECT Category.*, COUNT(*) AS Quantity FROM Category, Product WHERE Product.CategoryID = Category.ID GROUP BY Category.Name";
            $result = $con->query($sql);
            $arrCategory = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $category = new Category($row["ID"], $row["Name"], $row["Quantity"]);
                    array_push($arrCategory, $category);
                }
            }
            $con->close();
            return $arrCategory;
        }

    }

?>