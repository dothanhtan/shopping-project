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
        $label_name = $_REQUEST['label_name'];
        $contacts = Contact::getContactByLabel((int)$_REQUEST['label_id']);
    }
    else if (isset($_REQUEST['contact_info'])) {
        $contacts = Contact::searchContact($_REQUEST['contact_info'], $current_user->id);
    }
    else {
        $contacts = Contact::getContactByUser($current_user->id);
    }

    $total_contact = sizeof($contacts);
    $all_contact = sizeof(Contact::getContactByUser($current_user->id));
    $count_star_contact = 0;
    foreach($contacts as $key => $value){
        if($value->isChecked == "1")
            $count_star_contact += 1;
    }
    
?>

<div class="container contact">
    

    <div class="row pt-5">
        <div class="col-sm-3 left-hand-side">
            <div class="contact-header">
                <span><i class="fa fa-bars"></i></span>
                <img class="gb_la gb_7d" alt="" aria-hidden="true" src="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png" srcset="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png 1x, https://www.gstatic.com/images/branding/product/2x/contacts_48dp.png 2x " style="width:40px;height:40px">
                <span class="contact-title">Danh bạ</span>
            </div>
            <button class="btn-create-contact"><i class="fa fa-plus"></i> <span>Tạo liên hệ</span> </button>
            <ul class="nav flex-column menu-contact">
                <li class="nav-item list-active">
                    <a class="nav-link" href="danhba.php"><i class="far fa-user"></i> Danh bạ <span class="badge badge-primary"><?php echo $all_contact ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=""><i class="far fa-clock"></i> Thường xuyên liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=""><i class="far fa-square"></i> Liên hệ trùng lặp</a>
                </li>
            </ul>
            <div class="dropdown-divider"></div>
            
            <a class="nav-link text-black" role="button" href="" data-toggle="collapse" data-target="#collapseLable"><i class="fa fa-chevron-up"></i> Nhãn</a>
            <div id="collapseLable" class="collapse show">
                <ul class="nav flex-column">
                    <?php 
                    foreach($labels as $key => $value){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="danhba.php?label_id=<?php echo $value->id ?>&label_name=<?php echo $value->name ?>"><i class="fa fa-tag"></i> <?php echo $value->name ?> <span class="badge badge-primary"><?php echo Label::countContactByLabel($value->id) ?></span></a>
                        
                    </li>
                    <?php } ?>
                    
                    <li class="nav-item create-label">
                        <a class="nav-link text-black btn-create-label" href=""><i class="fa fa-plus"></i> Tạo nhãn</a>
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
                    <?php if(isset($_REQUEST['label_id'])) { ?>
                    <tr>
                        <td colspan="3"><?php echo $label_name ?> (<?php echo $total_contact ?>)</td>
                    </tr>
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
                    <?php } else { ?>
                    <tr>
                        <td colspan="3">NGƯỜI LIÊN HỆ CÓ GẮN DẤU SAO (<?php echo $count_star_contact ?>)</td>
                    </tr>
                    <?php 
                    foreach($contacts as $key => $value){
                        if($value->isChecked == "1") {
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
                    <?php } ?>
                    <tr>
                        <td colspan="3">DANH BẠ (<?php echo $total_contact ?>)</td>
                    </tr>
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
  <script>
      $(document).ready(function(){

        $(document).on("click", ".btn-create-label", function(){
          $.confirm({
            title: 'Tạo nhãn',
            content: '' +
            '<form action="" class="formLabel">' +
            '<div class="form-group">' +
            '<label>Nhập tên label</label>' +
            '<input type="text" placeholder="Tên nhãn mới" class="label-name form-control"/>' +
            '</div>' +
            '</form>',
            buttons: {
              formSubmit: {
                  text: 'Tạo',
                  btnClass: 'btn-blue',
                  action: function () {
                    label_name = this.$content.find('.label-name').val();
                    if(label_name != null && label_name != "") {
                        $.ajax({
                            url: "./controller/danhba_controller.php",
                            method: "POST",
                            data: {
                                new_label: {
                                    name: label_name,
                                    user_id: <?php echo $current_user->id ?>
                                }
                            },
                            success: function(res){
                                var result = JSON.parse(res);
                                if(result.status == "Success") {
                                    content = '<li class="nav-item">'
                                    content += '<a class="nav-link" href="danhba.php?label_id=' + result.label.id + '"><i class="fa fa-tag"></i>'
                                    content += " " + result.label.name + " "
                                    content += '<span class="badge badge-primary">0</span></a></li>'
                                    $( content ).insertBefore( $( ".create-label" ) );
                                    $.alert("Tạo nhãn mới thành công");
                                }
                                else if (result.status == "Exists") {
                                    $.alert("Tên nhãn đã tồn tại");
                                }
                                else {
                                    $.alert("Tạo nhãn mới thất bại");
                                }
                                
                            },
                            error: function(){
                                $.alert("Tạo nhãn mới thất bại");
                            }
                        })
                        
                    } else {
                        $.alert("Tên nhãn không thể để trống");
                        return false;
                    }
                  }
              },
              cancel: {
                text: 'Hủy',
                action: function () {
                  //close
                }
              }
            },
            onContentReady: function () {
            // bind to events
              var jc = this;
              this.$content.find('.formLabel').on('submit', function (e) {
                  // if the user submits the form by pressing enter in the field.
                  e.preventDefault();
                  jc.$$formSubmit.trigger('click'); // reference the button and click it
              });
            }
            });
          return false;
        })

        $(document).on("click", ".btn-create-contact", function(){
          $.confirm({
            title: 'Tạo liên hệ mới',
            content: '<form> <div class="form-group"> <label for="contact-label">Nhãn</label> <select class="form-control" id="contact-label"> <option value="1">Bạn bè</option> <option value="2">Người thân</option> </select> </div> <div class="form-group"> <label for="contact-name">Tên liên hệ</label> <input type="text" class="form-control" id="contact-name" placeholder="contact"> </div> <div class="form-group"> <label for="contact-phone">Số điện thoại</label> <input type="text" class="form-control" id="contact-phone" placeholder="0123456789"> </div> <div class="form-group"> <label for="contact-email">Email</label> <input type="email" class="form-control" id="contact-email" placeholder="contact@example.com"> </div> </form>',
            width: 300,
            buttons: {
              formSubmit: {
                  text: 'Tạo',
                  btnClass: 'btn-green',
                  action: function () {
                    contact_name = this.$content.find('#contact-name').val();
                    contact_phone = this.$content.find('#contact-phone').val();
                    contact_email = this.$content.find('#contact-email').val();
                    contact_label = this.$content.find('#contact-label').val();
                    if(contact_name != null && contact_name != "" && contact_phone != null && contact_phone != "") {
                        // do something here
                        if(contact_phone.length != 10) {
                          $.alert("Số điện thoại không hợp lệ");
                          return false;
                        }
                        else {
                          // do something here
                          $.alert("Tạo liên hệ mới thành công");
                        }

                    } else {
                        $.alert("Tên và số điện thoại không thể để trống");
                        return false;
                    }
                  }
              },
              cancel: {
                text: 'Hủy',
                action: function () {
                  //close
                }
              }
            },
            onContentReady: function () {
            // bind to events
              var jc = this;
              this.$content.find('.formLabel').on('submit', function (e) {
                  // if the user submits the form by pressing enter in the field.
                  e.preventDefault();
                  jc.$$formSubmit.trigger('click'); // reference the button and click it
              });
            }
            });
          return false;
        })

      })
    </script>