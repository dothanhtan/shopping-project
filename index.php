<?php include_once("header.php") ?>    
<?php include_once("nav.php") ?>
    <div id="wrapper">
        <?php include_once("nav.php") ?>
        <?php echo '<p>Hello World</p>';
            /**
             * Tinh dien tich hinh tron
             * @param $banKinh Ban Kinh Hinh Tron
             * @return Dien tich hinh tron co ban kinh la
             */
            function DienTichHinhTron($banKinh) {
                $s = 3.14 * $banKinh * $banKinh;
                return $s;
            }
            function NgayHienTai() {
                $ten = date("w");
                var_dump($ten);
            }
            $a = 5;
            $b = 9.9;
            $c = $a + $b;
            echo  'Ket qua cua ' . $a . ' + ' . $b . ' = ' . $c;
            echo "<br>";
            echo "Ket qua cua $a + $b la $c";
            echo "<br>";
            define('PI', '3.14');
            $r = 5;
            $s = PI * $r * $r;
            echo "Dien tich la: $s";
            echo "<br>";
            echo "Dien tich la: " . DienTichHinhTron($r);
            echo NgayHienTai();
        ?>
    </div>
    <?php include_once("footer.php") ?>   