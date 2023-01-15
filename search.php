<?php

get_header();

$term = $_GET['s'];

$expTerm = explode(" ", $term);

$search = "(";
foreach($expTerm as $ek=>$ev) {
    if($ek == 0) {
        $search .= " post_title LIKE '%".$ev."%' ";
    }
    else {
        $search .= " OR post_title LIKE '%".$ev."%'";
    }
}
$search .= ")";

$query = $wpdb->get_results(" SELECT * FROM ".$wpdb->prefix."posts WHERE post_status='publish' AND $search");

$search_products_html = '';

foreach($query as $qv) {
    $product_obj = wc_get_product( $qv->ID );
    $product_url = get_permalink( $qv->ID );
    $product_img_url = wp_get_attachment_image_url( $product_obj->image_id, 'woocommerce_single' );
    $product_name = $product_obj->name;
    $product_original_price = $product_obj->price;
    $product_sale_price = $product_obj->sale_price;

    $product_price_html = '<h5>$'.$product_original_price.'</h5>';
    if ($product_sale_price) {
        $product_price_html = '<h5>$'.$product_sale_price.'</h5><h6 class="text-muted ml-2"><del>$'.$product_original_price.'</del></h6>';
    }

    $search_products_html .= '
    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
        <div class="product-item bg-light mb-4">
            <div class="product-img position-relative overflow-hidden">
                <img class="img-fluid w-100" src="'.$product_img_url.'" alt="">
            </div>
            <div class="text-center py-4">
                <a class="h6 text-decoration-none text-truncate" href="'.$product_url.'">'.$product_name.'</a>
                <div class="d-flex align-items-center justify-content-center mt-2">
                    '.$product_price_html.'
                </div>
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
                <span class="breadcrumb-item active">Search results for "<?php echo $term; ?>"</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <?php echo $search_products_html; ?>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<?php get_footer(); ?>