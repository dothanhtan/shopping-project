<?php
    session_start(); // luon o tren cung
    if(!isset($_SESSION["user"])) {
      header("location:login.php");
    }
    include_once('model/user.php');
    
    $current_user = unserialize($_SESSION["user"]); 
    include_once('header.php');
    include_once('model/category.php');
    include_once('model/product.php');
    $categories = Category::getCategory();
    $product = Product::getProductByID($_REQUEST["product_id"]);
    $images = explode( ';', $product->other_images);
    $category = $product->category($product->category_id);
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
                    <form action="shop.php" method="GET" class="search">
                        <div class="input-group w-100">
                            <input name="product_info" type="text" class="form-control" placeholder="Tìm sản phẩm" autocomplete="off">
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
<section class="section-content show-product-content">
    <div class="container">
        <div class="row">
            <aside class="col-md-3">		
                <div class="card">
                    <article class="filter-group">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                                <i class="icon-control fa fa-chevron-down"></i>
                                <span class="title">Phân loại</span>
                            </a>
                        </header>
                        <div class="filter-content collapse show" id="collapse_1" style="">
                            <div class="card-body">
                                <form class="pb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm">
                                        <div class="input-group-append">
                                            <button class="btn btn-shop" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                
                                <ul class="list-menu category-list">
                                <?php foreach($categories as $key => $value){ ?>
                                    <li class="list-item py-2 d-flex">
                                        <a href="shop.php?category_id=<?php echo $value->id ?>" class="flex-fill"><i class="fa fa-tag"></i> <?php echo $value->name ?> </a>
                                        <span class="badge badge-pill badge-success float-right"><?php echo $value->quantity ?></span>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div> <!-- card-body.// -->
                        </div>
                    </article> <!-- filter-group  .// -->
                    <article class="filter-group">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
                                <i class="icon-control fa fa-chevron-down"></i>
                                <span class="title">Giới tính </span>
                            </a>
                        </header>
                        <div class="filter-content collapse show" id="collapse_2" style="">
                            <div class="card-body">
                                <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input">
                                <div class="custom-control-label">Nam  
                                    <b class="badge badge-pill badge-light float-right">120</b>  </div>
                                </label>
                                <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input">
                                <div class="custom-control-label">Nữ 
                                    <b class="badge badge-pill badge-light float-right">15</b>  </div>
                                </label>
                                <button class="btn btn-block btn-primary">Tìm kiếm</button>
                            </div> <!-- card-body.// -->
                            
                        </div>
                    </article> <!-- filter-group .// -->
                </div> <!-- card.// -->
            </aside> <!-- col.// -->

            <main class="col-md-9">
                <div class="row product-main" data-id="<?php echo $product->id ?>">
                    <div class="col-md-6 product-image mt-3 py-3">
                        <div class="main-image">
                            <img src="images/<?php echo $product->main_images ?>" alt="" class="img-fluid">
                        </div>
                        <div class="other-image pt-2 d-flex">
                            <?php foreach($images as $key => $value){ ?>
                            <div class="flex-fill">
                                <img src="images/<?php echo $value ?>" alt="" class="img-fluid">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-6 product-info mt-3 pl-4 py-3">
                        <h5 class="card-title product-name"><?php echo $product->name ?></h5>
                        <p class="text-muted">
                            <small>Phân loại: </small>
                            <small><?php echo $category->name ?></small>
                        </p>
                        <div class="product-review my-2">
                        <?php for ($i = 0; $i < $product->star; $i++) { ?>
                            <i class="fa fa-star text-warning"></i>
                        <?php } ?>
                        <?php for ($i = 0; $i < 5 - $product->star; $i++) { ?>
                            <i class="fa fa-star"></i>
                        <?php } ?>
                        <span> | </span>
                        <small class="text-muted"><?php echo(rand(10,100)) ?> reviews</small>
                        </div>
                        <div class="product-price my-3">
                            <span class="sell-price"><?php echo number_format($product->sellPrice, 0, '.', ',') ?></span>
                            <span class="price"text-muted"><?php echo number_format($product->price, 0, '.', ',') ?></span>
                            <span> | </span>
                            <span class="text-danger"> Tiết kiệm: <?php echo round((1 - $product->sellPrice/$product->price) * 100) ?>%</span>
                        </div>
                        <div class="product-description my-3">
                            <?php echo nl2br($product->description) ?>
                        </div>
                        <div class="product-quantity my-5 d-flex align-items-center">
                            <div class="change-quantity flex-fill">
                                <span>Số lượng: </span>
                                <span class="btn-action btn-shop btn-down"><i class="fa fa-minus"></i></span>
                                <span class="btn-action" id="current-quantity">1</span>
                                <span class="btn-action btn-shop btn-up"><i class="fa fa-plus"></i></span>
                                
                            </div>
                            <div class="product-action flex-fill">
                                <button class="btn btn-sm btn-secondary btn-add-to-cart"><i class="fa fa-shopping-cart"></i> <span>Thêm vào giỏ</span></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </main> <!-- col.// -->
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
<script src="js/shop.js"></script>