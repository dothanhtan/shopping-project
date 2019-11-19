<?php
    include_once("product.php"); 
    class Cart {

        static function connectToDB() {
            $con = new mysqli("localhost:3308", "root", "", "shop");
            $con->set_charset("utf8");
            if($con->connect_error)
                die("Ket noi that bai. Chi tiet: " . $con->connect_error);
            return $con;
        }

        
        static function parseCookie($cookie) {
            $arrCart = [];
            if(json_decode($cookie) != null) {
                $products = json_decode($cookie)->products;

                /* Get all id of products in cart */
                $ids = array_map(function($ele){
                    return $ele->id;
                }, $products);
                $arrayID = implode(", ", $ids);

                /* Get data from DB */
                $con = Cart::connectToDB();
                $sql = "SELECT * FROM Product WHERE ID IN ($arrayID)";
                $result = $con->query($sql);
                $objCart = new stdClass();
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $product = new Product($row["ID"], $row["Name"], $row["Description"], $row["SellPrice"], $row["Price"], $row["Star"], $row["MainImages"], $row["OtherImages"], $row["Branch"], $row["CategoryID"]);
                        $objCart = new stdClass();
                        $objCart->product = $product;

                        /* Get quantity of product_id */
                        $element = array_filter($products, function($ele) use($product){
                            return $ele->id == $product->id;
                        });
                        
                        $quantity = (array_values($element)[0])->quantity;
                        $objCart->quantity = $quantity;
                        array_push($arrCart, $objCart);
                    }
                }
                $con->close();
            }
            return $arrCart;
        }
    }

?>