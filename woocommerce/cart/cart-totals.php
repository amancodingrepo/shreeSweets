<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="bg-brand-bg2 rounded-xl p-5 sm:p-6 sticky top-24 sm:top-[130px] z-10 w-full overflow-hidden <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <h3 class="text-base font-bold mb-4.5"><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h3>

    <?php if ( wc_coupons_enabled() ) : ?>
        <div class="flex gap-2 mb-4.5 cart-coupon-container hidden-default">
            <!-- Native WooCommerce coupon form is usually on cart.php, but we can keep it here mentally or let Woo handle in cart.php. -->
             <?php // We skip rebuilding coupon logic here if Woo handles it outside, or we inject it via custom hook. ?>
        </div>
    <?php endif; ?>

    <div class="flex justify-between text-[13px] text-brand-ink2 mb-2">
        <span><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
        <span><?php wc_cart_totals_subtotal_html(); ?></span>
    </div>

    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
        <div class="flex justify-between text-[13px] text-brand-ink2 mb-2 coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
            <span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
            <span class="text-brand-green"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
        </div>
    <?php endforeach; ?>

    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
        <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
        <?php wc_cart_totals_shipping_html(); ?>
        <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
    <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
        <div class="flex justify-between text-[13px] text-brand-ink2 mb-2">
            <span><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></span>
            <span><?php woocommerce_shipping_calculator(); ?></span>
        </div>
    <?php endif; ?>

    <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <div class="flex justify-between text-[13px] text-brand-ink2 mb-2">
            <span><?php echo esc_html( $fee->name ); ?></span>
            <span><?php wc_cart_totals_fee_html( $fee ); ?></span>
        </div>
    <?php endforeach; ?>

    <?php
    if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
        $taxable_address = WC()->customer->get_taxable_address();
        $estimated_text  = '';

        if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
            /* translators: %s location. */
            $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
        }

        if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
            foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                ?>
                <div class="flex justify-between text-[13px] text-brand-ink2 mb-2 tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <span><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                    <span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="flex justify-between text-[13px] text-brand-ink2 mb-2">
                <span><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                <span><?php wc_cart_totals_taxes_total_html(); ?></span>
            </div>
            <?php
        }
    }
    ?>

    <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

    <div class="flex justify-between text-[14px] font-bold text-brand-ink pt-3.5 border-t-[1.5px] border-brand-line mt-1.5 items-baseline">
        <span><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
        <b class="text-xl"><?php wc_cart_totals_order_total_html(); ?></b>
    </div>

    <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    <div class="wc-proceed-to-checkout">
        <?php do_action( 'woocommerce_proceed_to_checkout' ); // Hook outputs standard 'Proceed to checkout' button ?>
        <style>
             /* Target standard WC button inside proceed-to-checkout wrapping it into our Tailwind format */
             .wc-proceed-to-checkout a.checkout-button {
                 display: flex !important;
                 width: 100% !important;
                 height: 52px !important;
                 background-color: var(--color-brand-orange, #F4821F) !important;
                 color: white !important;
                 border-radius: 8px !important;
                 font-size: 14px !important;
                 font-weight: 700 !important;
                 align-items: center !important;
                 justify-content: center !important;
                 margin-top: 18px !important;
             }
             .wc-proceed-to-checkout a.checkout-button:hover {
                 background-color: var(--color-brand-orange-dark, #D66D14) !important;
             }
        </style>
    </div>

    <div class="text-[11px] text-brand-ink3 text-center mt-2.5">
        🔒 Safe & secure checkout · UPI · Cards · COD
    </div>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
