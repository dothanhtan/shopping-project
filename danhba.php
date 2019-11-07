<?php
    session_start(); // luon o tren cung
    if(!isset($_SESSION["user"])) {
      header("location:login.php");
    }
    include_once('model/user.php');
    include_once('model/label.php');
    include_once('model/danhba.php');
    
    $current_user = unserialize($_SESSION["user"]); 
    include_once('header.php');
    $labels = Label::getLabelByUser($current_user->id);
    if(isset($_REQUEST['label_id'])) {
        $contacts = Contact::getContactByLabel((int)$_REQUEST['label_id']);
    }
    else if (isset($_REQUEST['contact_info'])) {
        $contacts = Contact::searchContact($_REQUEST['contact_info'], $current_user->id);
    }
    else {
        $contacts = Contact::getContactByUser($current_user->id);
    }
    
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
                    <?php 
                    foreach($labels as $key => $value){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="danhba.php?label_id=<?php echo $value->id ?>"><i class="fa fa-tag"></i> <?php echo $value->name ?></a>
                    </li>
                    <?php } ?>
                    
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="fa fa-plus"></i> Tạo nhãn</a>
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
                        <input name="contact_info" type="text" class="form-control" id="search-contact" placeholder="Tìm kiếm">
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
                    <?php 
                    foreach($contacts as $key => $value){
                    ?>
                    <tr>
                        <td class="contact-name">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="contact-<?php echo $value->id ?>">
                                <label class="custom-control-label name" for="contact-<?php echo $value->id ?>"><?php echo $value->name ?></label>
                            </div>
                        </td>
                        <td><?php echo $value->email ?></td>
                        <td><?php echo $value->phone ?></td>
                    </tr>
                    <?php } ?>
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