<?php

function load_stylesheets() {
    global $post;
    $pageSlug = array('my-account', 'checkout');

    if(in_array($post->post_name, $pageSlug)) {
        wp_register_style('woocopy-stylesheet', get_template_directory_uri() . '/css/woo.min.css', '', 1, 'all');
        wp_enqueue_style('woocopy-stylesheet');

        wp_register_style('global-styles-stylesheet', get_template_directory_uri() . '/css/global-styles.css', '', 1, 'all');
        wp_enqueue_style('global-styles-stylesheet');

        wp_register_style('block-library-stylesheet', get_template_directory_uri() . '/css/block-library.css', '', 1, 'all');
        wp_enqueue_style('block-library-stylesheet');
    } else {
        wp_register_style('stylesheet', get_template_directory_uri() . '/style.css', '', 1, 'all');
        wp_enqueue_style('stylesheet');

        wp_register_style('animate-stylesheet', get_template_directory_uri() . '/lib/animate/animate.min.css', '', 1, 'all');
        wp_enqueue_style('animate-stylesheet');

        wp_register_style('owlcarousel-stylesheet', get_template_directory_uri() . '/lib/owlcarousel/assets/owl.carousel.min.css', '', 1, 'all');
        wp_enqueue_style('owlcarousel-stylesheet');
    }
}
add_action('wp_enqueue_scripts', 'load_stylesheets');

function load_scripts() {
    wp_register_script('easing-script', get_template_directory_uri() . '/lib/easing/easing.min.js', '', 1, true);
    wp_enqueue_script('easing-script');

    wp_register_script('owlcarousel-script', get_template_directory_uri() . '/lib/owlcarousel/owl.carousel.min.js', '', 1, true);
    wp_enqueue_script('owlcarousel-script');

    wp_register_script('mail-jqbts-script', get_template_directory_uri() . '/mail/jqBootstrapValidation.min.js', '', 1, true);
    wp_enqueue_script('mail-jqbts-script');

    wp_register_script('mail-contact-script', get_template_directory_uri() . '/mail/contact.js', '', 1, true);
    wp_enqueue_script('mail-contact-script');
    wp_localize_script( 'mail-contact-script', 'WPURLS', array( 'templateUrl' => get_template_directory_uri() ) );

    wp_register_script('main-script', get_template_directory_uri() . '/js/main.js', '', 1, true);
    wp_enqueue_script('main-script');
    
}
add_action('wp_enqueue_scripts', 'load_scripts');

?>
