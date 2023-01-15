<?php

// dec cart item and return if dec-cart-item query param passed
$qp_update_cart_item = $_GET['update-cart-item'];
$qp_update_quantity = $_GET['update-quantity'];
if(!empty($qp_update_cart_item) && !empty($qp_update_quantity)) {
    WC()->cart->set_quantity( $qp_update_cart_item, $qp_update_quantity );
    return;
}

get_header();

// cart items html
$cart_items_html = '';
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    $product = $cart_item['data'];
    $product_id = $cart_item['product_id'];
    $product_obj = wc_get_product( $product_id );
    $product_img_url = wp_get_attachment_image_url( $product_obj->get_image_id() );
    $product_name = $product_obj->get_name();
    $product_price = WC()->cart->get_product_price( $product );
    $product_quantity = $cart_item['quantity'];
    $product_subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
    $cart_item_remove_url = wc_get_cart_remove_url( $cart_item_key );

    $cart_items_html .= '
    <tr>
        <td class="align-middle"><img src="'.$product_img_url.'" alt="" style="width: 50px;"> '.$product_name.'</td>
        <td class="align-middle">'.$product_price.'</td>
        <td class="align-middle">
            <div class="input-group quantity mx-auto" style="width: 100px;">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-primary btn-minus" onclick="decCartItem(\''.$cart_item_key.'\', '.$product_quantity.')">
                    <i class="fa fa-minus"></i>
                    </button>
                </div>
                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center cart-item-quantity" value="'.$product_quantity.'" data-cart-item-key="'.$cart_item_key.'">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-primary btn-plus" onclick="incCartItem('.$product_id.')">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </td>
        <td class="align-middle">'.$product_subtotal.'</td>
        <td class="align-middle"><button class="btn btn-sm btn-danger" onclick="removeFromCart(\''.$cart_item_remove_url.'\')"><i class="fa fa-times"></i></button></td>
    </tr>
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
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php echo $cart_items_html; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6><?php echo WC()->cart->get_cart_subtotal(); ?></h6>
                    </div>
                    <!-- <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div> -->
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>$<?php echo WC()->cart->total; ?></h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" onclick="location.href='<?php echo wc_get_checkout_url(); ?>';">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

<?php get_footer(); ?>