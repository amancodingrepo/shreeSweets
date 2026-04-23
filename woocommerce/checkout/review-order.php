<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="bg-brand-bg2 rounded-xl p-5 sm:p-6 sticky top-24 z-10 w-full overflow-hidden order-summary-sidebar">
    <h3 class="text-base font-bold mb-4.5">Order Summary</h3>
<table class="shop_table woocommerce-checkout-review-order-table w-full mb-3.5 custom-checkout-summary-table">
		/* Override WooCommerce table defaults to match Tailwind grid */
		.custom-checkout-summary-table th, .custom-checkout-summary-table td { border-bottom: 1px solid var(--color-brand-line, #E4E4E7) !important; padding: 12px 0 !important; border-top: none !important; }
		.custom-checkout-summary-table tfoot th, .custom-checkout-summary-table tfoot td { font-size: 13px; color: var(--color-brand-ink2, #3F3F46); }
		.custom-checkout-summary-table tfoot .order-total th, .custom-checkout-summary-table tfoot .order-total td { font-size: 14px; font-weight: 700; color: var(--color-brand-ink, #000); border-top: 1.5px solid var(--color-brand-line, #E4E4E7) !important; margin-top: 6px; padding-top: 14px !important; }
		.custom-checkout-summary-table thead { display: none; }
	</style>
	<thead>
		<tr>
			<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					
					<td class="product-name">
						<div class="flex items-center gap-3">
							<div class="w-[60px] h-[60px] rounded-lg bg-gradient-to-br from-[#FDEBD0] to-[#F0A05A] relative shrink-0">
                                <?php
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_gallery_thumbnail', array('class' => 'w-full h-full object-cover mix-blend-multiply rounded-lg opacity-85') ), $cart_item, $cart_item_key );
                                echo $thumbnail;
                                ?>
								<div class="absolute -top-[6px] -right-[6px] min-w-[19px] h-[19px] rounded-full bg-brand-ink text-white text-[10px] font-bold flex items-center justify-center px-1">
									<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', esc_html( $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
							</div>
							<div>
								<b class="text-[13.5px] block font-semibold text-brand-ink m-0">
									<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
								</b>
								<span class="text-[11.5px] text-brand-ink3">
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</span>
							</div>
						</div>
					</td>
					
					<td class="product-total text-[13.5px] font-bold text-right align-middle">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</td>
					
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
	<tfoot>

		<tr class="cart-subtotal flex justify-between w-full">
			<th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> flex justify-between w-full text-brand-green">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee flex justify-between w-full">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> flex justify-between w-full">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total flex justify-between w-full">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total flex justify-between w-full items-baseline">
			<th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			<td><b class="text-xl"><?php wc_cart_totals_order_total_html(); ?></b></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
</table>

    <div class="text-[11px] text-brand-ink3 text-center mt-2.5">
        🔒 256-bit SSL secured · Powered by Payment Gateways
    </div>
</div>
