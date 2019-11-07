<?php
    session_start(); // luon o tren cung
    if(!isset($_SESSION["user"])) {
      header("location:login.php");
    }
    include_once('model/user.php');
    $current_user = unserialize($_SESSION["user"]); 
    include_once('header.php');
?>

<div class="container-fluid contact">
    

    <div class="row pt-5">
        <div class="col-sm-3 left-hand-side">
            <div class="contact-header">
                <span><i class="fa fa-bars"></i></span>
                <img class="gb_la gb_7d" alt="" aria-hidden="true" src="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png" srcset="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png 1x, https://www.gstatic.com/images/branding/product/2x/contacts_48dp.png 2x " style="width:40px;height:40px">
                <span class="contact-title">Danh bạ</span>
            </div>
            <button class="btn-create-contact"><i class="fa fa-plus"></i> Tạo liên hệ</button>
            <ul class="nav flex-column menu-contact">
                <li class="nav-item list-active">
                    <a class="nav-link" href=""><i class="far fa-user"></i> Danh bạ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=""><i class="far fa-clock"></i> Thường xuyên liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=""><i class="far fa-square"></i> Liên hệ trùng lặp</a>
                </li>
            </ul>
            <div class="dropdown-divider"></div>
            
            <a class="nav-link" role="button" href="" data-toggle="collapse" data-target="#collapseLable"><i class="fa fa-chevron-up"></i> Nhãn</a>
            <div id="collapseLable" class="collapse">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-tag"></i> Người thân</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-tag"></i> Bạn bè</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-plus"></i> Tạo nhãn</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-sm-9 right-hand-side">
            <div class="search-box">
                <form action="">
                    <div class="input-group mb-3 search-bar">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input name="txtContact" type="text" class="form-control" id="search-contact" placeholder="Tìm kiếm">
                    </div>
                </form>
            </div>
            <div class="contact-list">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="contact-name">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="contact-1">
                                <label class="custom-control-label name" for="contact-1">Đức Phúc</label>
                            </div>
                        </td>
                        <td>ducphuc1202@gmail.com</td>
                        <td>0329322111</td>
                    </tr>
                    <tr>
                        <td class="contact-name">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="contact-2">
                                <label class="custom-control-label name" for="contact-2">Đình Trọng</label>
                            </div>
                        </td>
                        <td>dinhtrong1202@gmail.com</td>
                        <td>0329322322</td>
                    </tr>
                    <tr>
                        <td class="contact-name">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="contact-3">
                                <label class="custom-control-label name" for="contact-3">Văn Toàn</label>
                            </div>
                        </td>
                        <td>vantoan@gmail.com</td>
                        <td>0329322432</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Jquery confirm -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>