<?php

get_header();

// html variables
$on_sale_products_html = '';
$featured_products_html = '';
$latest_products_html = '';
$latest_products_original_price_html = '';

// Products loop
$args = array( 'post_type' => 'product', 'orderby' => 'date' );
$latestProductsCount = 0;
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();

// get product object
$product_url = get_permalink( $loop->post->ID );
$product_img_url = wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_single' );
$product_name = $product->get_name();
$product_price = $product->get_price();
$product_regular_price = $product->get_regular_price();
$product_sale_price = $product->get_sale_price();

// sale products html and part for latest products html
if ($product_sale_price){
    $on_sale_products_html .= '
    <div class="bg-light p-4">
        <div class="product-img position-relative overflow-hidden">
            <img class="img-fluid w-100" src="'.$product_img_url.'" alt="">
        </div>
        <div class="text-center py-4">
            <a class="h6 text-decoration-none text-truncate" href="'.$product_url.'">'.$product_name.'</a>
            <div class="d-flex align-items-center justify-content-center mt-2">
                <h5>$'.$product_sale_price.'</h5>
                <h6 class="text-muted ml-2">
                    <del>$'.$product_regular_price.'</del>
                </h6>
            </div>
        </div>
    </div>';

    $latest_products_original_price_html = '<h6 class="text-muted ml-2"><del>$'.$product_regular_price.'</del></h6>';
}

// featured products html
if (rand(0,1) == 1) {
    $featured_products_html .= '
    <div class="col-lg-2 col-md-4 col-sm-6 pb-1">
        <div class="product-item bg-light mb-4">
            <div class="product-img position-relative overflow-hidden">
                <img class="img-fluid w-100" src="'.$product_img_url.'" alt="">
            </div>
            <div class="text-center py-4">
                <a class="h6 text-decoration-none text-truncate" href="'.$product_url.'">'.$product_name.'</a>
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <h5>$'.$product_price.'</h5>
                </div>
            </div>
        </div>
    </div>';
}

// latest products html
if ($latestProductsCount < 20) {
    $latest_products_html .= '
    <div class="col-lg-2 col-md-4 col-sm-6 pb-1">
        <div class="product-item bg-light mb-4">
            <div class="product-img position-relative overflow-hidden">
                <img class="img-fluid w-100" src="'.$product_img_url.'" alt="">
            </div>
            <div class="text-center py-4">
                <a class="h6 text-decoration-none text-truncate" href="'.$product_url.'">'.$product_name.'</a>
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <h5>$'.$product_price.'</h5>'.$latest_products_original_price_html.'
                </div>
            </div>
        </div>
    </div>';
    $latestProductsCount++;
}

endwhile;
wp_reset_query();

?>

<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item position-relative active" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="<?php echo get_template_directory_uri() ?>/img/npenergyboosters.JPG"
                             style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Energy Boosters</h1>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="<?php echo get_site_url(); ?>/shop?cat[]=energy+boosters">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="<?php echo get_template_directory_uri() ?>/img/npweightloss.png"
                             style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Weight Loss</h1>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="<?php echo get_site_url(); ?>/shop?cat[]=whole+body+weight+loss">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="<?php echo get_template_directory_uri() ?>/img/npherbalextracts.png"
                             style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Herbal Extracts</h1>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="<?php echo get_site_url(); ?>/shop?cat[]=herbal+extracts+and+remedies">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/npfatburnerbundle.jpeg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">APPETITE SUPPRESSANT</h6>
                    <h3 class="text-white mb-3">FAT BURNER BUNDLE</h3>
                    <a href="<?php echo get_site_url(); ?>/product/extreme-slim-down-fat-burner-package-with-rapid-fat-loss-appetite-suppressant" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/npbellyfatreducers.jpeg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">KETO</h6>
                    <h3 class="text-white mb-3">BELLY FAT FLUSH</h3>
                    <a href="<?php echo get_site_url(); ?>/product/8-ounce-high-fiber-belly-fat-flush-advance-fat-loss-with-keto1200mg" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- Sale Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
            class="bg-secondary pr-3">On Sale</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <?php echo $on_sale_products_html ?>
            </div>
        </div>
    </div>
</div>
<!-- Sale End -->

<!-- Categories Start -->
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
            class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=whole+body+weight+loss">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/Weightloss.png" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Weight Loss</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=cleansers+and+detoxifiers">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/cleansers.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Cleansers & Detoxifiers</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=energy+boosters">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/energy%20boosters.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Energy Boosters</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=Aphrodisiacs%20Stamina%20Builders">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/aphrodisiacs.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Stamina Builders + Aphrodisiacs</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=herbal+extracts+and+remedies">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/HERBALTEAS.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Herbal Extracts</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=wellness+bundles">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/BUNDLES.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Wellness Bundles</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=rapid+belly+fat+reducers">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/BellyFat.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Rapid Belly Fat Reducers</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=On+Sale">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/onsale.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>On Sale</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=Women%27s+wellness+Products">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/women%20wellness.png" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Women Wellness</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=organic+powder">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/ORGANICPOWDER.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Organic Powder</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=organ+support">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/7-Day-Organ.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Organ Support</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo get_site_url(); ?>/shop?cat[]=immune+support">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/categories/immunesupport.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Immune Support</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Categories End -->


<!-- Featured Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span>
    </h2>
    <div class="row px-xl-5">
        <?php echo $featured_products_html ?>
    </div>
</div>
<!-- Featured Products End -->


<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5 align-items-center justify-content-center">
        <div class="col-md-6 align-items-center justify-content-center">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/img/npbloodninternalcleanser.jpeg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">DIETARY SUPPLEMENT</h6>
                    <h3 class="text-white mb-3">BLOOD & INTERNAL CLEANSER</h3>
                    <a href="<?php echo get_site_url(); ?>/product/blood-and-internal-cleanser" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Latest Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Latest Products</span>
    </h2>
    <div class="row px-xl-5">
        <?php echo $latest_products_html ?>
    </div>
</div>
<!-- Latest Products End -->

<?php 

get_footer();

?>
