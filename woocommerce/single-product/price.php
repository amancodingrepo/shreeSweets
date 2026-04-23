<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
    return;
}
?>
<div class="flex items-baseline gap-3 mb-1.5 flex-wrap <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
    
    <b class="text-4xl font-bold text-brand-ink">
        <?php echo wc_price( wc_get_price_to_display( $product ) ); ?>
    </b>

    <?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
        <s class="text-base text-brand-ink3"><?php echo wc_price( $product->get_regular_price() ); ?></s>
        <?php
        $discount_raw = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
        ?>
        <span class="py-1 px-2.5 bg-[#FEE8E8] text-brand-red text-[11px] font-bold rounded capitalize tracking-[0.04em]"><?php echo esc_html( $discount_raw ); ?>% OFF</span>
    <?php endif; ?>

</div>

<p class="text-[11.5px] text-brand-ink3 mb-4.5 mt-2">Inclusive of all taxes · Free shipping on orders above ₹499</p>

<!-- Excerpt Output Override included logically after price mirroring React -->
<div class="text-sm leading-[1.7] text-brand-ink2 mb-6">
    <?php echo esc_html( get_the_excerpt() ); ?>
</div>
