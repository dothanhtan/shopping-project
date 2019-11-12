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
                <span id="btn-toggle-sidebar"><i class="fa fa-bars"></i></span>
                <img class="gb_la gb_7d" alt="" aria-hidden="true" src="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png" srcset="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png 1x, https://www.gstatic.com/images/branding/product/2x/contacts_48dp.png 2x " style="width:40px;height:40px">
                <span class="contact-title">Danh bạ</span>
            </div>
        </div>
        <div class="col-sm-9 right-hand-side">
            <div class="search-box">
                <form action="">
                    <div class="input-group mb-3 search-bar">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input name="contact_info" type="text" class="form-control" id="search-contact" placeholder="Tìm kiếm liên hệ" autocomplete="off">
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-3 left-hand-side" id="sidebar-contact">
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
                        <a class="nav-link text-black" href="danhba.php?label_id=<?php echo $value->id ?>&label_name=<?php echo $value->name ?>"><i class="fa fa-tag"></i> <span class="label-name-text"><?php echo $value->name ?></span> <span class="badge badge-primary"><?php echo Label::countContactByLabel($value->id) ?></span></a>
                        <div class="overlap-label">
                            <span class="btn-edit-label"><i class="fa fa-pencil-alt"></i></span>
                            <span class="btn-delete-label"><i class="fa fa-trash"></i></span>
                        </div>
                    </li>
                    <?php } ?>
                    
                    <li class="nav-item create-label">
                        <a class="nav-link text-black btn-create-label" href=""><i class="fa fa-plus"></i> Tạo nhãn</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-sm-9 right-hand-side main-content">
            <div class="contact-list">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Thao tác</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($_REQUEST['label_id'])) { ?>
                    <tr>
                        <td colspan="4"><?php echo $label_name ?> (<?php echo $total_contact ?>)</td>
                    </tr>
                    <?php 
                    foreach($contacts as $key => $value){
                    ?>
                    <tr data-id="<?php echo $value->id ?>">
                        <td class="contact-name">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="contact-<?php echo $value->id ?>">
                                <label class="custom-control-label name" for="contact-<?php echo $value->id ?>"><?php echo $value->name ?></label>
                            </div>
                        </td>
                        <td class="contact-email"><?php echo $value->email ?></td>
                        <td class="contact-phone"><?php echo $value->phone ?></td>
                        <td>
                            <span class="btn-edit-contact"><i class="fa fa-pencil-alt"></i></span>
                            <span class="btn-delete-contact"><i class="fa fa-trash"></i></span>
                            <span><svg width="20" height="20" viewBox="0 0 24 24" class=""><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16zM16 17H5V7h11l3.55 5L16 17z"></path></svg></span>
                            <?php if($value->isChecked) { ?>
                            <span class="btn-star"><i class="fa fa-star"></i></span>
                            <?php }else{ ?>
                            <span class="btn-star"><i class="far fa-star"></i></span>
                            <?php } ?>
                        </td>
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
                    <tr data-id="<?php echo $value->id ?>">
                        <td class="contact-name">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="contact-<?php echo $value->id ?>">
                                <label class="custom-control-label name" for="contact-<?php echo $value->id ?>"><?php echo $value->name ?></label>
                            </div>
                        </td>
                        <td class="contact-email"><?php echo $value->email ?></td>
                        <td class="contact-phone"><?php echo $value->phone ?></td>
                        <td>
                            <span class="btn-edit-contact"><i class="fa fa-pencil-alt"></i></span>
                            <span class="btn-delete-contact"><i class="fa fa-trash"></i></span>
                            <span><svg width="20" height="20" viewBox="0 0 24 24" class=""><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16zM16 17H5V7h11l3.55 5L16 17z"></path></svg></span>
                            <span class="btn-star"><i class="fa fa-star"></i></span>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    <tr>
                        <td colspan="3">DANH BẠ (<?php echo $total_contact ?>)</td>
                    </tr>
                    <?php 
                    foreach($contacts as $key => $value){
                    ?>
                    <tr data-id="<?php echo $value->id ?>">
                        <td class="contact-name">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="contact-<?php echo $value->id ?>">
                                <label class="custom-control-label name" for="contact-<?php echo $value->id ?>"><?php echo $value->name ?></label>
                            </div>
                        </td>
                        <td class="contact-email"><?php echo $value->email ?></td>
                        <td class="contact-phone"><?php echo $value->phone ?></td>
                        <td>
                            <span class="btn-edit-contact"><i class="fa fa-pencil-alt"></i></span>
                            <span class="btn-delete-contact"><i class="fa fa-trash"></i></span>
                            <span><svg width="20" height="20" viewBox="0 0 24 24" class=""><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16zM16 17H5V7h11l3.55 5L16 17z"></path></svg></span>
                            <span class="btn-star"><i class="far fa-star"></i></span>   
                        </td>
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

        // Toggle sidebar
        $('#btn-toggle-sidebar').click( function() {

            $("#sidebar-contact").toggle();
            $(".main-content").toggleClass("active-sidebar");
        });

        $(document).on("click", ".btn-create-label", function(){
          $.confirm({
            title: 'Tạo nhãn',
            content: '' +
            '<form action="" class="formLabel">' +
            '<div class="form-group">' +
            '<label>Tên nhãn</label>' +
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
            var select_label = '<select class="form-control" id="contact-label">'
            <?php foreach($labels as $key => $value){ ?>
                select_label += '<option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>'
            <?php } ?>
            select_label += '</select>'
            $.confirm({
                title: 'Tạo liên hệ mới',
                content: '<form> <div class="form-group"> <label for="contact-label"><i class="fa fa-tag"></i>Nhãn</label>' + select_label +  '</div> <div class="form-group"> <label for="contact-name"><i class="fa fa-address-card"></i> Tên liên hệ</label> <input type="text" class="form-control" id="contact-name" placeholder="contact"> </div> <div class="form-group"> <label for="contact-phone"><i class="fa fa-phone"></i> Số điện thoại</label> <input type="text" class="form-control" id="contact-phone" placeholder="0123456789"> </div> <div class="form-group"> <label for="contact-email"><i class="fa fa-envelope"></i> Email</label> <input type="email" class="form-control" id="contact-email" placeholder="contact@example.com"> </div> </form>',
                width: 600,
                useBootstrap: false,
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
                                $.ajax({
                                    url: "./controller/danhba_controller.php",
                                    method: "POST",
                                    data: {
                                        new_contact: {
                                            name: contact_name,
                                            phone: contact_phone,
                                            email: contact_email,
                                            user_id: <?php echo $current_user->id ?>,
                                            label_id: contact_label
                                        }
                                    },
                                    success: function(res){
                                        var result = JSON.parse(res);
                                        if(result.status == "Success") {
                                            
                                            $.alert("Tạo liên hệ mới thành công");
                                        }
                                        else if (result.status == "Exists") {
                                            $.alert("Số điện thoại đã tồn tại");
                                        }
                                        else {
                                            $.alert("Tạo liên hệ mới thất bại");
                                        }
                                    },
                                    error: function(){
                                        $.alert("Tạo liên hệ mới thất bại");
                                    }
                                })                       
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

        $(document).on("click", ".btn-edit-contact", function(){
            var id = $(this).parents("tr").attr("data-id");
            var name = $(this).parents("tr").find(".contact-name .name").text();
            var phone = $(this).parents("tr").find(".contact-phone").text();
            var email = $(this).parents("tr").find(".contact-email").text();
            $.confirm({
                title: 'Chỉnh sửa liên hệ',
                content: '<form data-id="' + id + '"> <div class="form-group"> <label for="contact-name"><i class="fa fa-address-card"></i> Tên liên hệ</label> <input type="text" class="form-control" id="contact-name" placeholder="contact" value="' + name + '"> </div> <div class="form-group"> <label for="contact-phone"><i class="fa fa-phone"></i> Số điện thoại</label> <input type="text" class="form-control" id="contact-phone" placeholder="0123456789" value="' + phone + '"> </div> <div class="form-group"> <label for="contact-email"><i class="fa fa-envelope"></i> Email</label> <input type="email" class="form-control" id="contact-email" placeholder="contact@example.com" value="' + email + '"> </div> </form>',
                width: 600,
                useBootstrap: false,
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
        })

        $(document).on("click", ".btn-delete-contact", function(){
            $.confirm({
                title: 'Xóa liên hệ',
                content: 'Bạn có muốn xóa liên hệ này?',
                buttons: {
                    confirm: {
                        text: 'Đồng ý',
                        btnClass: 'btn-red',
                        action: function () {

                        }
                    },
                    cancel: {
                        text: 'Hủy',
                        action: function () {
                        //close
                        }
                    }
                }
            });
        })


        $(document).on("click", ".btn-edit-label", function(){
            var lb_name = $(this).parents(".nav-item").find(".label-name-text").text();
            $.confirm({
                title: 'Chỉnh sửa nhãn',
                content: '' +
                '<form action="" class="formLabel">' +
                '<div class="form-group">' +
                '<label>Tên nhãn</label>' +
                '<input type="text" placeholder="Tên nhãn mới" class="label-name form-control" value="' + lb_name + '"/>' +
                '</div>' +
                '</form>',
                buttons: {
                formSubmit: {
                    text: 'Cập nhật',
                    btnClass: 'btn-blue',
                    action: function () {
                        
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

        $(document).on("click", ".btn-delete-label", function(){
            $.confirm({
                title: 'Xóa nhãn',
                content: 'Bạn có muốn xóa nhãn này?',
                buttons: {
                    confirm: {
                        text: 'Đồng ý',
                        btnClass: 'btn-red',
                        action: function () {

                        }
                    },
                    cancel: {
                        text: 'Hủy',
                        action: function () {
                        //close
                        }
                    }
                }
            });
        })

      })
    </script>