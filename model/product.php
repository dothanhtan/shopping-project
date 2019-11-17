<?php 
    class Product {
        var $id;
        var $name;
        var $description;
        var $sellPrice;
        var $price;
        var $star;
        var $main_images;
        var $other_images;
        var $branch;
        var $category_id;

        function Product($id, $name, $description, $sellPrice, $price, $star, $main_images, $other_images, $branch, $category_id) {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->sellPrice = $sellPrice;
            $this->price = $price;
            $this->star = $star;
            $this->main_images = $main_images;
            $this->other_images = $other_images;
            $this->branch = $branch;
            $this->category_id = $category_id;
        }
    
        static function connectToDB() {
            $con = new mysqli("localhost:3308", "root", "", "shop");
            $con->set_charset("utf8");
            if($con->connect_error)
                die("Ket noi that bai. Chi tiet: " . $con->connect_error);
            return $con;
        }

        static function getProduct(){
            $con = Product::connectToDB();

            $sql = "SELECT * FROM Product";
            $result = $con->query($sql);
            $arrProduct = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $product = new Product($row["ID"], $row["Name"], $row["Description"], $row["SellPrice"], $row["Price"], $row["Star"], $row["MainImages"], $row["OtherImages"], $row["Branch"], $row["CategoryID"]);
                    array_push($arrProduct, $product);
                }
            }
            $con->close();
            return $arrProduct;
        }

        static function getProductByID($id) {
            $con = Product::connectToDB();

            $sql = "SELECT * FROM Product WHERE Product.ID = $id";
            $result = $con->query($sql);
            $product = null;
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $product = new Product($row["ID"], $row["Name"], $row["Description"], $row["SellPrice"], $row["Price"], $row["Star"], $row["MainImages"], $row["OtherImages"], $row["Branch"], $row["CategoryID"]);
                }
            }
            $con->close();
            return $product;
        }

        static function getProductByCategory($category_id) {
            $con = Product::connectToDB();

            $sql = "SELECT * FROM Product WHERE Product.CategoryID = $category_id";
            $result = $con->query($sql);
            $arrProduct = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $product = new Product($row["ID"], $row["Name"], $row["Description"], $row["SellPrice"], $row["Price"], $row["Star"], $row["MainImages"], $row["OtherImages"], $row["Branch"], $row["CategoryID"]);
                    array_push($arrProduct, $product);
                }
            }
            $con->close();
            return $arrProduct;
        }

        static function searchProduct($info) {
            $con = Product::connectToDB();

            $sql = "SELECT * FROM Product WHERE (Product.Name LIKE '%$info%' OR Product.Description LIKE '%$info%' OR Product.Branch LIKE '%$info%')";
            $result = $con->query($sql);
            $arrProduct = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $product = new Product($row["ID"], $row["Name"], $row["Description"], $row["SellPrice"], $row["Price"], $row["Star"], $row["MainImages"], $row["OtherImages"], $row["Branch"], $row["CategoryID"]);
                    array_push($arrProduct, $product);
                }
            }
            $con->close();
            return $arrProduct;
        }

        function category($id) {
            $con = Product::connectToDB();

            $sql = "SELECT * FROM Category WHERE ID = $id";
            $result = $con->query($sql);
            $category = null;
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $category = new category($row["ID"], $row["Name"], null);
                }
            }
            $con->close();
            return $category;
        }

    }

?>