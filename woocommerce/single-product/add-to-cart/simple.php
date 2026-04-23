<?php
/**
 * Simple product add to cart
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! $product || ! is_a( $product, 'WC_Product' ) || ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

    <span class="text-xs font-semibold text-brand-ink block mb-2.5">Quantity</span>

	<form class="cart flex flex-wrap sm:flex-nowrap gap-2.5 mb-3.5" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		
        <div class="flex items-center border-[2px] border-brand-line rounded-lg overflow-hidden shrink-0">
            <?php
            // Output normal Woo quantity input, but wrap it so we can style.
            woocommerce_quantity_input(
                array(
                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                    'classes'     => apply_filters( 'woocommerce_quantity_input_classes', array( 'w-12', 'h-[50px]', 'text-center', 'text-[15px]', 'font-semibold', 'border-none', 'bg-transparent', 'outline-none', 'focus:outline-none' ), $product ),
                )
            );
            ?>
        </div>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt flex-1 w-full sm:w-auto h-[50px] bg-brand-ink text-white rounded-lg text-sm font-semibold flex items-center justify-center gap-2.5 transition-colors hover:bg-[#333]">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
        </button>

	</form>

<?php endif; ?>
