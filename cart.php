<?php
    session_start(); // luon o tren cung
    if(!isset($_SESSION["user"])) {
      header("location:login.php");
    }
    include_once('model/user.php');
    
    $current_user = unserialize($_SESSION["user"]); 
    include_once('header.php');
?>
<header class="section-header">

    <section class="header-main border-bottom">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-lg-2 col-4">
                    <a href="shop.php" class="brand-wrap">
                        <img src="images/branch.png" width="180">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-6 col-sm-12">
                    <form action="#" class="search">
                        <div class="input-group w-100">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                            <button class="btn btn-shop" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="widgets-wrap float-md-right row user-manage">
                        <div class="widget-header col-sm-3">
                            <a href="cart.php" class="icon-cart"><i class="fa fa-shopping-cart"></i></a>
                            <span class="badge badge-pill badge-info notify">0</span>
                        </div>
                        <div class="widget-header user-session col-sm-9">
                            <a href="#" class="icon icon-user"><i class="fa fa-user"></i></a>
                            <div class="user-session-text pl-3">
                                <span class="text-muted">Welcome!</span>
                                <div> 
                                    <a href="#">Sign in</a> |  
                                    <a href="#"> Register</a>
                                </div>
                            </div>
                        </div>

                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->
</header> <!-- section-header.// -->



<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop">
    <div class="container pt-3">
        <nav>
        <ol class="breadcrumb text-white">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>  
        </nav>
    </div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content cart-content">
    <div class="container">

        <div class="row">
            <main class="col-md-9">
                <div class="card">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted text-center">
                            <tr class="small text-uppercase">
                            <th scope="col">Product</th>
                            <th scope="col" width="120">Số lượng</th>
                            <th scope="col" width="120">Giá</th>
                            <th scope="col" class="text-right" width="200"> </th>
                            </tr>
                        </thead>
                        <tbody class="cart-list">
                            <tr class="cart-item">
                                <td>
                                    <figure class="itemside">
                                        <div class="product-img"><img src="images/sanpham1.png" class="img-sm"></div>
                                        <figcaption class="info">
                                            <a href="#" class="title text-dark product-name">Đồng hồ đeo tay</a>
                                            <p class="text-muted">
                                                <small>Đơn giá: </small>
                                                <small>32.000</small>
                                            </p>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <div class="content-item-cart w-100"> 
                                        <span class="btn-action btn-shop btn-down"><i class="fa fa-minus"></i></span>
                                        <span class="btn-action current-quantity">1</span>
                                        <span class="btn-action btn-shop btn-up"><i class="fa fa-plus"></i></span>   
                                    </div>
                                </td>
                                <td> 
                                    <div class="price-wrap content-item-cart text-center"> 
                                        <var class="price">64.000</var> 
                                    </div> <!-- price-wrap .// -->
                                </td>
                                <td class="text-right">
                                    <div class="content-item-cart"> 
                                        <a data-original-title="Save to Wishlist" title="" class="btn btn-light" data-toggle="tooltip"> <i class="fa fa-eye text-shop"></i></a> 
                                        <a class="btn btn-light"> <i class="fa fa-trash text-danger"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-body border-top">
                        <a href="#" class="btn btn-shop float-md-right"> Thanh toán <i class="fa fa-chevron-right"></i> </a>
                        <a href="shop.php" class="text-info"> <i class="fa fa-chevron-left"></i> Tiếp tục mua hàng </a>
                    </div>	
                </div> <!-- card.// -->

                <div class="alert alert-info mt-3">
                    <i class="icon text-info fa fa-truck"></i> Miễn phí vận chuyển cho đơn hàng từ 150.000 VNĐ
                </div>

            </main> <!-- col.// -->
            <aside class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>Bạn có mã giảm giá?</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="" placeholder="Nhập mã">
                                <span class="input-group-append"> 
                                    <button class="btn btn-shop">Áp dụng</button>
                                </span>
                            </div>
                        </div>
                    </form>
                    </div> <!-- card-body.// -->
                </div>  <!-- card .// -->
                <div class="card">
                    <div class="card-body">
                            <dl class="dlist-align">
                            <dt>Tổng tiền:</dt>
                            <dd class="text-right">568.000</dd>
                            </dl>
                            <dl class="dlist-align">
                            <dt>Giảm giá:</dt>
                            <dd class="text-right">200.000</dd>
                            </dl>
                            <dl class="dlist-align">
                            <dt>Thành tiền:</dt>
                            <dd class="text-right text-shop h5"><strong>368.000</strong></dd>
                            </dl>
                            <hr>
                            <p class="text-center mb-3">
                                <img src="images/payments.png" height="26">
                            </p>
                            
                    </div> <!-- card-body.// -->
                </div>  <!-- card .// -->
            </aside> <!-- col.// -->
        </div>

    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->



<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top py-3 mt-5">
	<div class="container footer-content">
		<p class="float-md-right"> 
			&copy Copyright 2019 All rights reserved
		</p>
		<p>
			<a href="#">Terms and conditions</a>
		</p>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->

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

      })
</script>