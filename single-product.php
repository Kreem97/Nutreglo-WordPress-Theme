<?php

get_header();

// product info
$product_id = get_the_ID();
$product_obj = wc_get_product( $product_id );
$product_img_url = wp_get_attachment_image_url( $product_obj->get_image_id(), 'woocommerce_single' );
$product_name = $product_obj->get_name();
$product_regular_price = $product_obj->get_regular_price();
$product_sale_price = $product_obj->get_sale_price();
$product_description = $product_obj->get_description();
$product_short_description = $product_obj->get_short_description();

// related products html
$related_products_html = '';
$product_related_products = $product_obj->get_related();
foreach($product_related_products as $related_product_id){
    $related_product_obj = wc_get_product( $related_product_id );
    $related_product_img_url = wp_get_attachment_image_src( $related_product_obj->get_image_id(), 'woocommerce_single' );
    $related_product_name = $related_product_obj->get_name();
    $related_product_regular_price = $related_product_obj->get_regular_price();
    $related_product_sale_price = $related_product_obj->get_sale_price();

    $product_price_html = '';
    if($related_product_sale_price) {
        $product_price_html = '
        <h5>$'.$related_product_sale_price.'</h5><h6 class="text-muted ml-2"><del>$'.$related_product_regular_price.'</del></h6>
        ';
    } else {
        $product_price_html = '
        <h5>$'.$related_product_regular_price.'</h5>
        ';
    }

    $related_products_html .= '
    <div class="product-item bg-light">
        <div class="product-img position-relative overflow-hidden">
            <img class="img-fluid w-100" src="'.$related_product_img_url.'" alt="">
        </div>
        <div class="text-center py-4">
            <a class="h6 text-decoration-none text-truncate" href="">'.$related_product_name.'</a>
            <div class="d-flex align-items-center justify-content-center mt-2">
                '.$product_price_html.'
            </div>
        </div>
    </div>
    ';
}

?>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="<?php echo get_site_url(); ?>">Home</a>
                    <a class="breadcrumb-item text-dark" href="<?php echo get_site_url(); ?>/shop">Shop</a>
                    <span class="breadcrumb-item active"><?php echo $product_name; ?></span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-4 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="<?php echo $product_img_url; ?>" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?php echo $product_name; ?></h3>
                    <?php
                        if($product_sale_price) {
                            echo '
                            <h3 class="font-weight-semi-bold">$'.$product_sale_price.'</h3>
                            <h6 class="text-muted mb-4"><del>$'.$product_regular_price.'</del></h6>
                            ';
                        } else {
                            echo '
                            <h3 class="font-weight-semi-bold">$'.$product_regular_price.'</h3>
                            ';
                        }

                        if($product_short_description) {
                            echo '
                            <p class="mb-4">'.$product_short_description.'</p>
                            ';
                        }
                    ?>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="add-to-cart-quantity" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" onclick="addToCart(<?php echo $product_id; ?>)"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if($product_description) {
                echo '
                <div class="row px-xl-5">
                    <div class="col">
                        <div class="bg-light p-30">
                            <div class="nav nav-tabs mb-4">
                                <a class="nav-item nav-link text-dark active" data-toggle="tab">Description</a>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-pane-1">
                                    <h4 class="mb-3">Product Description</h4>
                                    <p>'.$product_description.'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
        ?>
    </div>
    <!-- Shop Detail End -->


    <!-- Related Products Start -->
    <?php
    if(!empty($related_products_html)) {
        echo '
        <div class="container-fluid py-5">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="owl-carousel related-carousel">
                    '.$related_products_html.'
                    </div>
                </div>
            </div>
        </div>
        ';
    }
    ?>
    <!-- Related Products End -->

<?php get_footer(); ?>