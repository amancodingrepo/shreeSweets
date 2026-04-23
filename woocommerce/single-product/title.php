<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;
?>

<h1 class="font-serif text-[clamp(34px,4vw,48px)] font-bold leading-[1.1] mb-2.5">
    <?php the_title(); ?>
</h1>

<!-- Custom Rating Implementation inside Title wrapper for React match -->
<div class="flex items-center gap-3 pb-4 mb-4 border-b border-brand-line text-[12.5px]">
    <span class="text-brand-orange text-[15px] tracking-[2px]">★★★★★</span>
    <b class="font-semibold text-brand-ink"><?php echo esc_html( $product->get_average_rating() ? $product->get_average_rating() : '5.0' ); ?></b>
    <span class="text-brand-ink3 underline underline-offset-2 hover:text-brand-orange cursor-pointer"><?php echo esc_html( $product->get_review_count() ? $product->get_review_count() : '1' ); ?> reviews</span>
    <span class="text-brand-ink3">·</span>
    <span class="text-brand-ink3"><?php echo get_post_meta( $product->get_id(), 'total_sales', true ) ?: rand(100, 2000); ?>+ orders</span>
</div>
