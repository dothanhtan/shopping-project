<?php include_once("header.php") ?>    
<?php include_once("nav.php") ?>
<?php 
    $maSinhVien = $ho = $ten = $ngaySinh = $email = "";
    // var_dump($_SERVER);
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        # get value
        $maSinhVien = $_REQUEST["maSinhVien"];
        $ho = $_REQUEST["ho"];
        $ten = $_REQUEST["ten"];
        $ngaySinh = $_REQUEST["ngaySinh"];
        $email = $_REQUEST["email"];

        # validate email
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Ban da nhap email dung dinh dang";
        }
        // var_dump($_FILES);

        # save file to folder: uploads
        if($_FILES["avt"]["name"] != "")
            move_uploaded_file($_FILES["avt"]["tmp_name"], "uploads/avatar.png");
    }
?>
    <div id="wrapper">
    <div class="container">
    <h3 class="text-center"> <strong>Thong tin sinh vien</strong> </h3>
    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group">
            <label for="msv">Ma Sinh Vien</label>
            <input name="maSinhVien" value="<?php echo $maSinhVien ?>" type="text" required class="form-control" id="msv" placeholder="Nhap ma sinh vien">
        </div>
        <div class="form-group">
            <label for="ho">Ho</label>
            <input name="ho" value="<?php echo $ho ?>" type="text" required class="form-control" id="ho" placeholder="Nhap ho">
        </div>
        <div class="form-group">
            <label for="ten">Ten</label>
            <input name="ten" value="<?php echo $ten ?>" type="text" require class="form-control" id="ten" placeholder="Nhap ten">
        </div>
        <div class="form-group">
            <label for="dob">Ngay sinh</label>
            <input name="ngaySinh" value="<?php echo $ngaySinh ?>" type="date" required class="form-control" id="dob" placeholder="Ngay sinh">
        </div>
        <div class="form-group">
            <label for="mail">Email</label>
            <input name="email" value="<?php echo $email ?>" type="email" required class="form-control" id="mail" placeholder="Nhap email">
        </div>
        <div class="form-group">
            <label for="avt">Anh dai dien</label>
            <input name="avt" type="file" class="form-control" id="avt" placeholder="Anh dai dien">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" id="#btn-sub" value="Submit">
        </div>
    </form>
    </div>
    </div>
<?php include_once("footer.php") ?>  