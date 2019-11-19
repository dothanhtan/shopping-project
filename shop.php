<?php
    session_start(); // luon o tren cung
    if(!isset($_SESSION["user"])) {
      header("location:login.php");
    }
    include_once('model/user.php');
    include_once('model/category.php');
    include_once('model/product.php');
    
    $current_user = unserialize($_SESSION["user"]); 
    include_once('header.php');

    $categories = Category::getCategory();
    if(isset($_REQUEST["category_id"])) {
        $products = Product::getProductByCategory($_REQUEST["category_id"]);
    }
    else if(isset($_REQUEST["product_info"])) {
        $products = Product::searchProduct($_REQUEST["product_info"]);
    }
    else {
        $products = Product::getProduct();
    }
    
?>

<header class="section-header">

    <section class="header-main border-bottom">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-lg-2 col-4">
                    <a href="http://bootstrap-ecommerce.com" class="brand-wrap">
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
                            <a href="cart" class="icon-cart"><i class="fa fa-shopping-cart"></i></a>
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
            <li class="breadcrumb-item active" aria-current="page">Shop</li>
        </ol>  
        </nav>
    </div> <!-- container //  -->
    <div class="container page-slide py-3">
        <div id="carouselProduct" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselProduct" data-slide-to="0" class="active"></li>
                <li data-target="#carouselProduct" data-slide-to="1"></li>
                <li data-target="#carouselProduct" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="images/slide1" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="images/slide2" alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="images/slide3" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselProduct" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselProduct" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content mt-5">
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

                <header class="border-bottom mb-4 pb-3 product-header">
                    <div class="form-inline">
                        <span class="title-list-product">SẢN PHẨM</span>
                        <span class="ml-2 mr-md-auto badge badge-danger"><?php echo sizeof($products) ?></span>
                        <?php if(isset($_REQUEST["product_info"])) { ?>
                        <small class="mr-md-auto">Từ khóa tìm kiếm: <?php echo $_REQUEST["product_info"] ?></small>
                        <?php } ?>
                        <select name="product_option" class="mr-2 form-control">
                            <option value="all">Tất cả</option>
                            <option value="newest">Mới nhất</option>
                            <option value="seen">Sản phẩm đã xem</option>
                            <option value="sell">Giảm giá</option>
                        </select>
                        <div class="btn-group">
                            <a href="#" class="btn btn-outline-secondary" data-toggle="tooltip" title="List view"> 
                                <i class="fa fa-bars"></i>
                            </a>
                            <a href="#" class="btn  btn-outline-secondary active" data-toggle="tooltip" title="Grid view"> 
                                <i class="fa fa-th"></i>
                            </a>
                        </div>
                    </div>
                </header><!-- sect-heading -->

                <div class="row product-list">
                    <?php foreach($products as $key => $value){ ?>
                    <div class="col-md-6 product-item" data-id="<?php echo $value->id ?>">
                        <figure class="card mb-3 py-2" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-5">
                                    <img src="images/<?php echo $value->main_images ?>" class="card-img img-fluid" alt="...">
                                </div>
                                <div class="col-md-7">
                                <div class="card-body">
                                    <div class="product-name">
                                        <h6 class="card-title" data-toggle="tooltip" data-placement="top" title="<?php echo $value->name ?>"><?php echo $value->name ?></h6>
                                    </div>    
                                    <div class="product-review">
                                    <?php for ($i = 0; $i < $value->star; $i++) { ?>
                                        <i class="fa fa-star text-warning"></i>
                                    <?php } ?>
                                    <?php for ($i = 0; $i < 5 - $value->star; $i++) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } ?>
                                    </div>
                                    <div class="product-price">
                                        <span class="sell-price"><?php echo number_format($value->sellPrice, 0, '.', ',') ?></span>
                                        <span class="price"><small class="text-muted"><?php echo number_format($value->price, 0, '.', ',') ?></small></span>
                                    </div>
                                    
                                    <div class="product-action">
                                        <button class="btn btn-sm btn-secondary btn-product btn-add-to-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                        <a href="show.php?product_id=<?php echo $value->id ?>" class="btn btn-sm btn-secondary text-white btn-icon"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </figure>
                    </div> <!-- col.// -->
                    <?php } ?>  
                </div> <!-- row end.// -->


                <nav class="mt-4" aria-label="Page navigation sample">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
                </nav>

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