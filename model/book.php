<?php
class Book {
    var $id;
    var $title;
    var $price;
    var $author;
    var $year;
    
    
    public function __construct($id, $title, $price, $author, $year)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
        $this->year = $year;
    }

    static function get_data() {
        return $data = file("data/book.txt");
    }

    static function get_max_id() {
        $data = Book::get_data();
        $max_id = 1;
        foreach($data as $key => $value){
            $row = explode("#",$value);
            $id = (int)$row[0];
            if($id > $max_id) $max_id = $id;
        }
        return $max_id;
    }

    static function create($title, $price, $author, $year) {
        $id = Book::get_max_id() + 1;
        $data = file_get_contents("data/book.txt");
		$data .= "\n". $id. "#". $title . "#" . $price . "#" . $author . '#' . $year;
		file_put_contents("data/book.txt", $data);
    }

    static function edit($id, $title, $price, $author, $year) {
        $id = (int)$id;
        $data = Book::get_data();
        $str_data = "";
        foreach($data as $key => $value){
            $row = explode("#",$value);
            $data_id = (int)$row[0]; 
            if( $id == $data_id) {
                if($key == sizeof($data) - 1)
                    $str_data .= $data_id. "#". $title . "#" . $price . "#" . $author . '#' . $year;
                else
                    $str_data .= $data_id. "#". $title . "#" . $price . "#" . $author . '#' . $year . "\n";
            }
            else {
                $str_data .= $value;
            }
        }
        file_put_contents("data/book.txt", $str_data);
    }

    static function delete($id) {
        $id = (int)$id;
        $data = Book::get_data();
        $str_data = "";
        foreach($data as $key => $value){
            $row = explode("#",$value);
            $data_id = (int)$row[0]; 
            if( $id != $data_id) {
                $str_data .= $value;
            }
        }
        file_put_contents("data/book.txt", $str_data);
    }

    static function getList($search = null){
        $data = file("data/book.txt");
        $arrBook = [];

        foreach($data as $key => $value){
            if (strlen($value) > 1) {
                $row = explode("#",$value);
                if(
                    strlen(strstr($row[0],$search)) || strlen(strstr($row[3],$search)) ||
                    strlen(strstr($row[1],$search)) || strlen(strstr($row[4],$search)) ||
                    strlen(strstr($row[2],$search)) || $search == null
                )
                $arrBook[] = new Book($row[0], $row[1],$row[2],$row[3],$row[4]);
            }
        }
        return $arrBook;
    }
    // static function add($id,$price,$title,$author,$year){
    //     $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
    //     $data = file("data/book.txt");
    //     $data[] = $id."#".$title."#".$price."#".$author."#".$year."\n";
    //     fwrite($myfile, $data);
    //     fclose($myfile);
    // }

    // 1#OOP in Java#20000#Nguyen Hoang Ha#2016
    // 2#OOP in C++#30000#Nguyen Van Trung Ha#2017
    // 3#OOP in PHP#40000#Nguyen Dung#2016
}