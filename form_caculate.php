    <?php include_once("header.php") ?>    
    <?php include_once("nav.php") ?>
    <div id="wrapper">
    <h3>Toan tu voi 2 so</h3>  
    <form action="/" method="post">
        <input name="so_a" type="text" placeholder="Nhap a" value="<?php echo $_GET["so_a"] ?? "" ?>">
        <input name="so_b" type="text" placeholder="Nhap b" value="<?php echo $_GET["so_b"] ?? "" ?>">
        <select name="toan_tu" id="">
            <option value="None" <?php echo ($_GET["toan_tu"] ?? "") == "None" ? "selected" : "" ?> >Chon toan tu</option>
            <option value="Cong" <?php echo ($_GET["toan_tu"] ?? "") == "Cong" ? "selected" : "" ?> >Cong</option>
            <option value="Tru" <?php echo ($_GET["toan_tu"] ?? "") == "Tru" ? "selected" : "" ?> >Tru</option>
            <option value="Nhan" <?php echo ($_GET["toan_tu"] ?? "") == "Nhan" ? "selected" : "" ?> >Nhan</option>
            <option value="Chia" <?php echo ($_GET["toan_tu"] ?? "") == "Chia" ? "selected" : "" ?> >Chia</option>
        </select>
        <button name="button" value="1">Submit</button>
    </form>
    <?php
        if(isset($_GET["button"])) {
            // params = var_dump($_GET) // get params
            $num_1 = $_GET["so_a"];
            $num_2 = $_GET["so_b"];
            $operator = $_GET["toan_tu"];
            $result = 0;
            switch ($operator) {
                case 'Cong':
                    $result = $num_1 + $num_2;
                    break;
                case 'Tru':
                    $result = $num_1 - $num_2;
                    break;
                case 'Nhan':
                    $result = $num_1 * $num_2;
                    break;
                case 'Chia':
                    $result = $num_1 / $num_2;
                    break;
                default:
                    $result = "Vui long chon toan tu";
            }
            echo "<h3>Ket qua la: $result</h3>";
        } 
    ?>
    </div>
    <?php include_once("footer.php") ?>  