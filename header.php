<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Nutraflax Products</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="<?php echo get_template_directory_uri() ?>/img/nutreglologosmall.avif" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body>

<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="<?php echo get_site_url(); ?>/about-us">About</a>
                <a class="text-body mr-3" href="<?php echo get_site_url(); ?>/contact">Contact</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php
                            if(is_user_logged_in()) {
                                echo '
                                <a href="'.get_permalink( wc_get_page_id('myaccount') ).'" >
                                    <button class="dropdown-item" type="button">Dashboard</button>
                                </a>
                                <a href="'.get_permalink( wc_get_page_id('myaccount') ).'/orders" >
                                    <button class="dropdown-item" type="button">Orders</button>
                                </a>
                                <a href="'.get_permalink( wc_get_page_id('myaccount') ).'/edit-address" >
                                    <button class="dropdown-item" type="button">Addresses</button>
                                </a>
                                <a href="'.get_permalink( wc_get_page_id('myaccount') ).'/edit-account" >
                                    <button class="dropdown-item" type="button">Account Details</button>
                                </a>
                                <a href="'.wp_logout_url('my-account').'" >
                                    <button class="dropdown-item" type="button">Logout</button>
                                </a>';
                            } else {
                                echo '
                                <a href="'.get_permalink( wc_get_page_id('myaccount') ).'" >
                                    <button class="dropdown-item" type="button">Login/Sign up</button>
                                </a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="<?php echo get_site_url(); ?>/cart" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle"
                          style="padding-bottom: 2px;"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="<?php echo get_site_url(); ?>" class="text-decoration-none">
                <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/nutreglologosmall.avif" alt="">
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form id="search-form" method="get" action="<?php print site_url( ); ?>">
                <div class="input-group">
                    <input type="text" name="s" class="form-control" placeholder="Search for products">
                    <div id="search-btn" class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Topbar End -->

<?php
// get all categories
global $categories;
$categories = array();
$category_objs = get_terms( ['taxonomy' => 'product_cat'] );
$categories_html = '';
foreach ($category_objs as $category) {
    $categories_html .= '<a href="'.get_site_url().'/shop?'.http_build_query(array('cat[]' => $category->name)).'" class="nav-item nav-link">'.strtoupper($category->name).'</a>';
    $categories[$category->name] = $category->count;
}
?>

<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
               href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                 id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    <?php echo  $categories_html; ?>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="<?php echo get_site_url(); ?>" class="text-decoration-none d-block d-lg-none" aria-label="Homepage">
                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/nutreglologosmall.avif" alt="">
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" aria-label="Menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <!-- add "active" class for color -->
                        <a href="<?php echo get_site_url(); ?>" class="nav-item nav-link">Home</a>
                        <a href="<?php echo get_site_url(); ?>/shop" class="nav-item nav-link">Shop</a>
                        <a href="<?php echo get_site_url(); ?>/recipes" class="nav-item nav-link">Recipes</a>
                        <a href="https://buynutregloproductswholesale.com/" class="nav-item nav-link">Wholesale</a>
                        <a href="<?php echo get_site_url(); ?>/about-us" class="nav-item nav-link">About Us</a>
                        <a href="<?php echo get_site_url(); ?>/contact" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="<?php echo get_site_url(); ?>/cart" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle"
                                  style="padding-bottom: 2px;"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
