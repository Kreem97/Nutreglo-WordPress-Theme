<?php

get_header();

// html variables
$shop_products_html = '';

// Products loop args
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$qp_cat = $_GET['cat'];
$qp_sort = $_GET['sort'];
$args = array(
    'post_type' => 'product',
    'paged' =>  $paged,
);
if(!empty($qp_cat)) {
    $tax_query_arr = array('relation' => 'OR');
    for($i = 0; $i < count($qp_cat); $i++) {
        array_push($tax_query_arr, array(
            'taxonomy' => 'product_cat',
            'field' => 'name',
            'terms' => $qp_cat[$i]
        ));
    }

    $args['tax_query'] = $tax_query_arr;
}
if(!empty($qp_sort)) {
    switch ($qp_sort) {
        case 'latest':
            $args['orderby']  = array( 'date' =>'DESC' );
            break;
        case 'atoz':
            $args['orderby']  = 'title';
            $args['order']    = 'ASC';
            break;
        case 'lowtohigh':
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'ASC';
            $args['meta_key'] = '_price';
            break;
        case 'hightolow':
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'DESC';
            $args['meta_key'] = '_price';
            break;
    }
}

// rebuild current query for cat
$curr_cat_query = http_build_query(array('cat' => $qp_cat));

// Products loop
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();

// count num products for categories
$product_category_objs = get_the_terms( $loop->post->ID, 'product_cat' );
$product_categories = "";
foreach ($product_category_objs as $product_category_obj) {
    if(array_key_exists($product_category_obj->name, $categories)) {
        $product_categories .= ' ' . $product_category_obj->name;
    }
}

// shop products html
$product_url = get_permalink( $loop->post->ID );
$product_img_url = wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_single' );
$product_name = $product->get_name();
$product_regular_price = $product->get_regular_price();
$product_sale_price = $product->get_sale_price();

$product_price_html = '<h5>$'.$product_regular_price.'</h5>';
if ($product_sale_price) {
    $product_price_html = '<h5>$'.$product_sale_price.'</h5><h6 class="text-muted ml-2"><del>$'.$product_regular_price.'</del></h6>';
}

$shop_products_html .= '
<div class="col-lg-3 col-md-6 col-sm-6 pb-1 shop-prod-obj" data-categories="'.$product_categories.'">
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

endwhile;

wp_reset_query();

// categories filter html
$categories_filter_html = '';
$categoryCount = 1;
foreach ($categories as $category => $numProducts) {
    $isChecked = '';
    if(!empty($qp_cat)) { $isChecked = in_array(addslashes($category), $qp_cat) ? ' checked' : ''; }
    $categories_filter_html .= '
    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
        <input type="checkbox" class="custom-control-input shop-cat-checkbox" id="category-'.$categoryCount.'" data-category="'.$category.'" onchange="toggleCheckbox(\''.$qp_sort.'\')"'.$isChecked.'>
        <label class="custom-control-label" for="category-'.$categoryCount.'">'.strtoupper($category).'</label>
        <span class="badge border font-weight-normal">'.$numProducts.'</span>
    </div>';
    $categoryCount++;
}

?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="<?php echo get_site_url(); ?>">Home</a>
                <span class="breadcrumb-item active">Shop</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Categories Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by category</span>
            </h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <?php echo $categories_filter_html; ?>
                </form>
            </div>
            <!-- Categories End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4 float-right">
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown"><?php
                                    if(!empty($qp_sort)) {
                                        switch ($qp_sort) {
                                            case 'latest':
                                                echo 'Latest';
                                                break;
                                            case 'atoz':
                                                echo 'A - Z';
                                                break;
                                            case 'lowtohigh':
                                                echo 'Price: Low to High';
                                                break;
                                            case 'hightolow':
                                                echo 'Price: High to Low';
                                                break;
                                            default:
                                                echo 'Sorting';
                                        }
                                    } else {
                                        echo 'Sorting';
                                    }
                                ?></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?php echo get_site_url() . '/shop?' . $curr_cat_query . '&sort=latest'; ?>">Latest</a>
                                    <a class="dropdown-item" href="<?php echo get_site_url() . '/shop?' . $curr_cat_query . '&sort=atoz'; ?>">A - Z</a>
                                    <a class="dropdown-item" href="<?php echo get_site_url() . '/shop?' . $curr_cat_query . '&sort=lowtohigh'; ?>">Price: Low to High</a>
                                    <a class="dropdown-item" href="<?php echo get_site_url() . '/shop?' . $curr_cat_query . '&sort=hightolow'; ?>">Price: High to Low</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $shop_products_html; ?>
                <div class="col-12">
                    <nav>
                        <div>
                            <?php
                                echo paginate_links( [
                                    'type'      => 'list',
                                    'total'     => $loop->max_num_pages,
                                    'prev_text' => __( 'Prev', 'advanced-woocommerce-theme' ),
                                    'next_text' => __( 'Next', 'advanced-woocommerce-theme' ),
                                ] );
                            ?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<?php get_footer(); ?>