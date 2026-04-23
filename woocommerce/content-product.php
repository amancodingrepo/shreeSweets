<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 * 
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility and validity.
if ( empty( $product ) || ! is_a( $product, 'WC_Product' ) || ! $product->is_visible() ) {
	return;
}

$discountRaw = 0;
if ( $product->is_on_sale() && $product->get_regular_price() ) {
    $discountRaw = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
}

$minimal = false; // Add variable control if needed later
?>

<div <?php wc_product_class( 'product-card bg-white border-[1.5px] border-brand-line rounded-xl overflow-hidden transition-all duration-200 flex flex-col relative hover:border-brand-orange hover:shadow-[0_8px_32px_rgba(0,0,0,0.1)] hover:-translate-y-0.5 group', $product ); ?>>
    
    <a href="<?php the_permalink(); ?>" class="aspect-square bg-brand-bg2 relative overflow-hidden flex items-center justify-center">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php echo $product->get_image('woocommerce_thumbnail', array('class' => 'w-full h-full object-cover absolute inset-0 z-0', 'loading' => 'lazy')); ?>
            <div class="absolute inset-0 bg-gradient-to-br from-[#FDEBD0] to-[#F0A05A] opacity-20 z-[1] mix-blend-multiply pointer-events-none"></div>
        <?php else : ?>
            <div class="text-[9px] tracking-[0.08em] uppercase text-brand-ink3 text-center p-3 relative z-10 font-medium break-all">
                <?php echo esc_html( $product->get_slug() ); ?>.png
            </div>
        <?php endif; ?>

        <?php if ( $product->is_featured() || $product->is_on_sale() ) : ?>
            <div class="absolute top-2.5 left-2.5 flex flex-col gap-1.25 z-20 max-w-[calc(100%-40px)]">
                <?php if ( $product->is_on_sale() ) : ?>
                    <span class="py-1 px-2 text-[9px] sm:text-[10px] font-bold rounded-[4px] tracking-[0.04em] uppercase whitespace-nowrap overflow-hidden text-ellipsis bg-brand-red text-white">
                        Save <?php echo esc_html( $discountRaw ); ?>%
                    </span>
                <?php elseif ( $product->is_featured() ) : ?>
                    <span class="py-1 px-2 text-[9px] sm:text-[10px] font-bold rounded-[4px] tracking-[0.04em] uppercase whitespace-nowrap overflow-hidden text-ellipsis bg-brand-orange text-white">
                        Bestseller
                    </span>
                <?php else : ?>
                    <span class="py-1 px-2 text-[9px] sm:text-[10px] font-bold rounded-[4px] tracking-[0.04em] uppercase whitespace-nowrap overflow-hidden text-ellipsis bg-brand-green text-white">
                        New Arrival
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </a>

    <div class="p-4 sm:p-5 flex flex-col flex-1 gap-2">

        <!-- Product Name -->
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="text-[14px] sm:text-[15px] font-semibold text-[#111] leading-snug hover:text-brand-orange transition-colors line-clamp-2 block">
            <?php echo esc_html( get_the_title() ); ?>
        </a>

        <?php if ( ! $minimal ) : ?>
        <!-- Short description -->
        <p class="text-[12px] sm:text-[13px] text-[#777] leading-[1.5] line-clamp-2 m-0">
            <?php echo esc_html( wp_trim_words( get_the_excerpt(), 10, '...' ) ); ?>
        </p>

        <!-- Rating -->
        <div class="flex items-center gap-1.5 flex-wrap">
            <span class="text-brand-orange text-[11px] tracking-widest leading-none">★★★★★</span>
            <span class="text-[11px] text-[#444] font-medium"><?php echo esc_html( $product->get_average_rating() ?: '5.0' ); ?></span>
            <span class="text-[10px] text-[#aaa]">(<?php echo esc_html( $product->get_review_count() ?: '124' ); ?>)</span>
        </div>
        <?php endif; ?>

        <!-- Price + Button -->
        <div class="flex flex-col gap-2.5 mt-auto pt-2">
            <?php 
            $price = wc_get_price_to_display( $product );
            if ( $price > 0 ) : ?>
            <div class="flex items-baseline gap-2 flex-wrap">
                <span class="text-[17px] sm:text-[18px] font-bold text-[#111] leading-none">
                    <?php echo wc_price( $price ); ?>
                </span>
                <?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
                    <s class="text-[12px] text-[#aaa]"><?php echo wc_price( $product->get_regular_price() ); ?></s>
                    <span class="text-[10px] font-bold text-brand-red bg-[#FEE8E8] py-0.5 px-1.5 rounded"><?php echo $discountRaw; ?>% off</span>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="add-to-cart-wrapper w-full mt-auto">
                <?php if ( $product->is_purchasable() && $product->is_in_stock() && $product->is_type( 'simple' ) ) : ?>
                    <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" 
                       data-quantity="1" 
                       class="<?php echo esc_attr( implode( ' ', array(
                           'flex', 'items-center', 'justify-center', 'w-full', 'py-3', 'px-4',
                           'bg-brand-orange', 'text-white', 'rounded-xl', 'text-[13px]', 'font-bold',
                           'transition-all', 'hover:bg-brand-orange-dark', 'hover:shadow-lg', 'active:scale-[0.98]',
                           'add_to_cart_button', 'ajax_add_to_cart'
                       ) ) ); ?>" 
                       data-product_id="<?php echo get_the_ID(); ?>" 
                       aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>" 
                       rel="nofollow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                        Add to Cart
                    </a>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" class="flex items-center justify-center w-full py-3 px-4 bg-brand-bg3 text-brand-ink2 rounded-xl text-[13px] font-bold transition-all hover:bg-brand-line">
                        <?php echo $product->is_type( 'variable' ) ? 'Select Options' : 'View Product'; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
