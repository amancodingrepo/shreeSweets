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
    
    // Check for Pure Veg
    $is_pure_veg = true;
    $product_tags = get_the_terms( $product->get_id(), 'product_tag' );
    if ( $product_tags && ! is_wp_error( $product_tags ) ) {
        foreach ( $product_tags as $tag ) {
            if ( strtolower( $tag->name ) === 'non-veg' ) {
                $is_pure_veg = false;
                break;
            }
        }
    }
    ?>

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'animate-in fade-in duration-500 max-w-full mx-auto px-6 md:px-16 lg:px-20 py-6 pb-20', $product ); ?>>
        
        <!-- Breadcrumbs -->
        <div class="text-xs text-brand-ink3 mb-6">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-brand-orange">Home</a> /
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="hover:text-brand-orange">Shop</a> /
            <span class="text-brand-ink"><?php the_title(); ?></span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">
            
            <!-- Gallery Section -->
            <div class="flex flex-col gap-4 min-w-0 w-full mb-auto">
                <?php
                $post_thumbnail_id = $product->get_image_id();
                $attachment_ids = $product->get_gallery_image_ids();
                ?>
                
                <!-- Main Image -->
                <div class="rounded-2xl aspect-square flex items-center justify-center relative bg-gradient-to-br from-[#FEF3E8] to-[#FDEBD0] w-full overflow-hidden">
                    <?php if ( $post_thumbnail_id ) : ?>
                        <?php echo wp_get_attachment_image( $post_thumbnail_id, 'large', false, array( 'class' => 'w-full h-full object-contain p-4' ) ); ?>
                    <?php else : ?>
                        <div class="text-[10px] tracking-widest uppercase text-brand-ink3 text-center">No Image</div>
                    <?php endif; ?>
                    
                    <?php if ( $product->is_on_sale() ) : ?>
                    <span class="absolute top-4 left-4 py-1.5 px-3 text-[11px] font-bold rounded-lg bg-brand-red text-white">
                        <?php echo $discount_raw; ?>% OFF
                    </span>
                    <?php endif; ?>
                </div>
                
                <!-- Thumbnail Gallery -->
                <?php if ( $attachment_ids || $post_thumbnail_id ) : ?>
                <div class="flex gap-3 overflow-x-auto no-scrollbar pb-2">
                    <?php if ( $post_thumbnail_id ) : ?>
                    <div class="w-20 h-20 border-2 border-brand-orange rounded-xl overflow-hidden cursor-pointer shrink-0 bg-brand-bg2">
                        <?php echo wp_get_attachment_image( $post_thumbnail_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( $attachment_ids ) : ?>
                        <?php foreach ( $attachment_ids as $attachment_id ) : ?>
                        <div class="w-20 h-20 border-2 border-brand-line rounded-xl overflow-hidden cursor-pointer shrink-0 bg-brand-bg2 hover:border-brand-orange transition-colors">
                            <?php echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Info Section -->
            <div class="py-2 single-product-info-wrapper">
                
                <!-- Pure Veg Badge -->
                <?php if ( $is_pure_veg ) : ?>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-5 h-5 border-2 border-green-600 rounded flex items-center justify-center">
                        <span class="w-2.5 h-2.5 bg-green-600 rounded-full"></span>
                    </span>
                    <span class="text-[12px] text-green-600 font-semibold">Pure Veg</span>
                </div>
                <?php endif; ?>
                
                <!-- Product Title -->
                <h1 class="text-2xl md:text-3xl font-bold text-brand-ink mb-2 font-serif"><?php the_title(); ?></h1>
                
                <!-- Short Description -->
                <?php if ( $product->get_short_description() ) : ?>
                <p class="text-[14px] text-[#666] leading-relaxed mb-4"><?php echo wp_strip_all_tags( $product->get_short_description() ); ?></p>
                <?php endif; ?>
                
                <!-- Rating -->
                <div class="flex items-center gap-2 mb-5">
                    <span class="text-brand-orange text-[14px] tracking-wide">★★★★★</span>
                    <span class="text-[14px] text-[#333] font-semibold"><?php echo esc_html( $product->get_average_rating() ?: '4.8' ); ?></span>
                    <span class="text-[13px] text-[#888]">(<?php echo esc_html( $product->get_review_count() ?: '423' ); ?>)</span>
                </div>
                
                <!-- Weight/Size Variants -->
                <div class="mb-5">
                    <span class="text-[12px] font-semibold text-brand-ink block mb-3">Select Size</span>
                    <div class="flex items-center gap-3 flex-wrap">
                        <button class="text-[13px] font-semibold text-white bg-brand-orange py-2.5 px-5 rounded-full border-2 border-brand-orange transition-all">200g</button>
                        <button class="text-[13px] font-semibold text-[#555] bg-white py-2.5 px-5 rounded-full border-2 border-brand-line hover:border-brand-orange transition-all">400g</button>
                        <button class="text-[13px] font-semibold text-[#555] bg-white py-2.5 px-5 rounded-full border-2 border-brand-line hover:border-brand-orange transition-all">1kg</button>
                    </div>
                </div>
                
                <!-- Price -->
                <div class="flex items-baseline gap-3 mb-5">
                    <span class="text-[28px] font-bold text-brand-ink"><?php echo wc_price( wc_get_price_to_display( $product ) ); ?></span>
                    <?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
                    <s class="text-[16px] text-[#aaa]"><?php echo wc_price( $product->get_regular_price() ); ?></s>
                    <span class="text-[13px] font-bold text-brand-orange bg-orange-50 py-1 px-2 rounded"><?php echo $discount_raw; ?>% off</span>
                    <?php endif; ?>
                </div>
                
                <!-- Add to Cart -->
                <div class="flex items-center gap-4 mb-5">
                    <div class="flex items-center border-2 border-brand-line rounded-xl overflow-hidden">
                        <button class="w-12 h-12 flex items-center justify-center text-xl font-semibold text-brand-ink hover:bg-brand-bg2 transition-colors">-</button>
                        <span class="w-12 h-12 flex items-center justify-center text-[15px] font-semibold">1</span>
                        <button class="w-12 h-12 flex items-center justify-center text-xl font-semibold text-brand-ink hover:bg-brand-bg2 transition-colors">+</button>
                    </div>
                    <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="flex-1 h-12 bg-brand-orange text-white rounded-xl text-[14px] font-bold flex items-center justify-center gap-2 hover:bg-brand-orange-dark transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                        Add to Cart
                    </a>
                </div>
                
                <!-- Fresh Batch Indicator -->
                <div class="flex items-center gap-2 mb-6">
                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                    <span class="text-[13px] text-green-600 font-medium">Fresh batch today</span>
                </div>
                
                <!-- Trust Badges -->
                <div class="grid grid-cols-2 gap-4 p-5 bg-brand-bg2 rounded-xl mb-5">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-orange mt-0.5 shrink-0"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        <div>
                            <b class="text-[13px] block font-semibold">Free shipping</b>
                            <span class="text-[11px] text-brand-ink3">Orders above ₹499</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-orange mt-0.5 shrink-0"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <div>
                            <b class="text-[13px] block font-semibold">2-5 day delivery</b>
                            <span class="text-[11px] text-brand-ink3">Same-day in Indore</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-orange mt-0.5 shrink-0"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
                        <div>
                            <b class="text-[13px] block font-semibold">FSSAI certified</b>
                            <span class="text-[11px] text-brand-ink3">Made fresh daily</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-orange mt-0.5 shrink-0"><circle cx="12" cy="12" r="10"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                        <div>
                            <b class="text-[13px] block font-semibold">7-day freshness</b>
                            <span class="text-[11px] text-brand-ink3">Easy returns</span>
                        </div>
                    </div>
                </div>

                <div class="text-[12px] text-brand-orange font-medium flex items-center gap-2 mb-4">
                    <div class="relative flex h-2 w-2 shrink-0">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-orange opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-orange"></span>
                    </div>
                    <?php echo rand(8, 24); ?> people bought this in the last hour
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
        do_action( 'woocommerce_after_single_product_summary' );
        ?>

    </div>

<?php endwhile; ?>

<?php
get_footer( 'shop' );
