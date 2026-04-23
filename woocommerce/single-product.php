<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
    <?php 
    global $product;
    $discount_raw = 0;
    if ( $product->is_on_sale() && $product->get_regular_price() ) {
        $discount_raw = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
    }
    
    // Custom logic to fetch category for the breadcrumbs/tags
    $terms = get_the_terms($product->get_id(), 'product_cat');
    $primary_cat = ( $terms && !is_wp_error($terms) && !empty($terms) ) ? $terms[0]->name : 'Shop';
    ?>

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'animate-in fade-in duration-500 max-w-7xl mx-auto px-7 py-6 pb-20', $product ); ?>>
        
        <!-- Breadcrumbs -->
        <div class="text-xs text-brand-ink3 mb-6">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-brand-orange">Home</a> /
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="hover:text-brand-orange">Shop</a> /
            <span class="text-brand-ink"><?php the_title(); ?></span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-16 items-start">
            
            <!-- Gallery Section -->
            <div class="flex flex-col-reverse md:grid md:grid-cols-1 gap-3 min-w-0 w-full mb-auto woo-custom-gallery">
                <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action( 'woocommerce_before_single_product_summary' );
                ?>
            </div>

            <!-- Info Section -->
            <div class="py-2 single-product-info-wrapper">
                <div class="text-[10.5px] font-bold tracking-[0.15em] uppercase text-brand-orange mb-2">
                    <?php echo esc_html( $primary_cat ); ?> 
                    <?php if ( $product->is_featured() ) : ?>
                        · Bestseller #1
                    <?php elseif ( ! $product->is_featured() && ! $product->is_on_sale() ) : ?>
                        · Fresh Batch
                    <?php endif; ?>
                </div>

                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5 (Overridden)
                 * @hooked woocommerce_template_single_rating - 10 (Custom output directly here for exact match OR native)
                 * @hooked woocommerce_template_single_price - 10 (Overridden)
                 * @hooked woocommerce_template_single_excerpt - 20 
                 * @hooked woocommerce_template_single_add_to_cart - 30 (Overridden)
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 */
                do_action( 'woocommerce_single_product_summary' );
                ?>
                
                <!-- Trust Badges (Copied exactly from React UI) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-4.5 bg-brand-bg2 rounded-xl mt-5 mb-5">
                    <div class="flex items-start gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-orange mt-0.5 shrink-0"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        <div><b class="text-[12.5px] block font-semibold">Free shipping</b><span class="text-[11px] text-brand-ink3">Orders above ₹499</span></div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-orange mt-0.5 shrink-0"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <div><b class="text-[12.5px] block font-semibold">2–5 day delivery</b><span class="text-[11px] text-brand-ink3">Same-day in Indore</span></div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-orange mt-0.5 shrink-0"><path d="m12 22-8-4.5v-6l8-4.5 8 4.5v6Z"/><path d="m12 13 8-4.5"/><path d="M12 13v9"/><path d="M12 13 4 8.5"/><path d="m9 11.5 3 1.5 3-1.5"/></svg>
                        <div><b class="text-[12.5px] block font-semibold">FSSAI certified</b><span class="text-[11px] text-brand-ink3">Made fresh daily</span></div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-orange mt-0.5 shrink-0"><circle cx="12" cy="12" r="10"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                        <div><b class="text-[12.5px] block font-semibold">7-day freshness</b><span class="text-[11px] text-brand-ink3">Easy returns</span></div>
                    </div>
                </div>

                <div class="text-[11px] text-brand-orange mt-2.5 font-medium flex items-center gap-1.5 shrink-0 line-clamp-1 break-all mb-4">
                    <div class="relative flex h-1.5 w-1.5 shrink-0">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-orange opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-brand-orange"></span>
                    </div>
                    🔥 <?php echo rand(8, 24); ?> people bought this in the last hour
                </div>

            </div>
        </div>

        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        // Standard WooCommerce tabs will load here. We will need to style standard Woo tables through global CSS or a custom tabs template.
        do_action( 'woocommerce_after_single_product_summary' );
        ?>

    </div>

<?php endwhile; // end of the loop. ?>

<?php
get_footer( 'shop' );
