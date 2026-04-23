<?php
/**
 * Plugin Name: Shree Sweets Core
 * Description: Production-grade WooCommerce infrastructure (Razorpay/Shiprocket/RankMath harding).
 * Version:     1.0.0
 * Author:      Simbolo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * 1. Duplicate Orders (CRITICAL - Server Side Session Lock)
 * Prevents multiple clicks, network retries, and webhook race conditions.
 */
add_filter('woocommerce_checkout_create_order', function($order, $data) {
    if ( ! session_id() ) {
        session_start();
    }
    if ( isset( $_SESSION['shree_order_processed'] ) ) {
        throw new Exception('Duplicate order attempt blocked. Your previous order is processing.');
    }
    $_SESSION['shree_order_processed'] = true;
    return $order;
}, 10, 2);

// Cleanup session lock on successful checkout or when returning to checkout
add_action('woocommerce_before_checkout_form', function() {
    if ( ! session_id() ) {
        session_start();
    }
    if ( isset( $_SESSION['shree_order_processed'] ) ) {
        unset( $_SESSION['shree_order_processed'] );
    }
});

add_action('woocommerce_thankyou', function() {
    if ( ! session_id() ) {
        session_start();
    }
    if ( isset( $_SESSION['shree_order_processed'] ) ) {
        unset( $_SESSION['shree_order_processed'] );
    }
});

/**
 * 2. Strict Caching Prevention (Ghost Cart Fix)
 * Complements Cloudflare/CDN bypass rules by strictly enforcing headers and session cookies.
 */
add_action( 'template_redirect', function() {
    if ( function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
        if ( ! defined( 'DONOTCACHEPAGE' ) ) {
            define( 'DONOTCACHEPAGE', true );
        }
        
        // Force strict headers for CDNs like Cloudflare
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // Force WooCommerce session cookie creation immediately
        if ( function_exists('WC') && ! WC()->session->has_session() ) {
            WC()->session->set_customer_session_cookie( true );
        }
    }
}, 1 );

/**
 * 3. Cart Fragments Optimization (UX Safe)
 * Only disable on the homepage IF the cart is empty to save resources, keeping UX intact elsewhere.
 */
add_action('wp_enqueue_scripts', function() {
    if ( function_exists('is_front_page') && is_front_page() && function_exists('WC') && WC()->cart && WC()->cart->is_empty() ) {
        wp_dequeue_script('wc-cart-fragments');
    }
}, 99);

/**
 * 4. Rank Math Schema Lock (SEO Dependency Fix)
 * Only strip Woo schema if Rank Math is actively detected and functioning.
 */
add_action('init', function() {
    if ( class_exists('RankMath') ) {
        add_filter('woocommerce_structured_data_product', '__return_empty_array');
    }
});

/**
 * 5. Razorpay UX Double-Click block (Frontend UX backup)
 */
add_action( 'wp_footer', function() {
    if ( function_exists( 'is_checkout' ) && is_checkout() && ! is_wc_endpoint_url( 'order-received' ) ) {
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                jQuery(document.body).on('checkout_place_order', function() {
                    var btn = jQuery('#place_order');
                    if (btn.hasClass('shree-disabled')) {
                        return false;
                    }
                    btn.addClass('shree-disabled').css({
                        'opacity': '0.5',
                        'pointer-events': 'none'
                    }).val('Processing...');
                    return true;
                });
            });
        </script>
        <?php
    }
});
