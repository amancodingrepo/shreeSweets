<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<?php if ( function_exists('WC') && WC()->cart && ! WC()->cart->is_empty() ) : ?>
    <div class="animate-in fade-in duration-500 max-w-7xl mx-auto px-7 py-8 pb-20">

        <div class="text-xs text-brand-ink3 mb-2">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-brand-orange">Home</a> /
            <span class="text-brand-ink">Cart</span>
        </div>

        <h1 class="font-serif text-4xl font-bold mb-1.5 text-brand-ink"><?php esc_html_e( 'Your Cart', 'woocommerce' ); ?></h1>
        <p class="text-[13px] text-brand-ink3 mb-9"><?php echo function_exists('WC') && WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?> items · 🎉 Free shipping eligible</p>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-10 items-start">
            
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <div class="border-[1.5px] border-brand-line rounded-xl overflow-hidden woo-custom-cart-items">
                    
                    <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                    
                    <?php
                    if ( function_exists('WC') && WC()->cart ) {
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_permalink = apply_filters( 'woocommerce_cart_item_product', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                            
                            <div class="grid grid-cols-[80px_1fr] sm:grid-cols-[100px_1fr_auto_auto] gap-4 sm:gap-5 p-4 sm:p-5 px-5 sm:px-6 border-b border-brand-line items-start sm:items-center bg-white <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                                
                                <div class="w-[80px] h-[80px] sm:w-[100px] sm:h-[100px] rounded-lg bg-gradient-to-br from-[#FDEBD0] to-[#F0A05A] shrink-0 overflow-hidden opacity-85">
                                    <?php
                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_gallery_thumbnail', array('class' => 'w-full h-full object-cover mix-blend-multiply') ), $cart_item, $cart_item_key );
                                    if ( ! $product_permalink ) {
                                        echo $thumbnail; // PHPCS: XSS ok.
                                    } else {
                                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                    }
                                    ?>
                                </div>
                                
                                <div class="min-w-0">
                                    <b class="font-serif text-sm sm:text-base font-semibold block mb-1 truncate">
                                        <?php
                                        if ( ! $product_permalink ) {
                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                        } else {
                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                        }

                                        do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                        // Meta data.
                                        echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                        // Backorder notification.
                                        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                        }
                                        ?>
                                    </b>
                                    <div class="text-xs text-brand-ink3 mb-2.5 truncate">
                                        <?php
                                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                        ?>
                                    </div>
                                    
                                    <!-- Mobile quantity & price -->
                                    <div class="flex sm:hidden items-center justify-between gap-2 mt-2 flex-wrap">
                                        <div class="flex items-center border-[1.5px] border-brand-line rounded-md overflow-hidden shrink-0 h-7 w-[84px]">
                                            <?php
                                            if ( $_product->is_sold_individually() ) {
                                                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                            } else {
                                                $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                        'input_value'  => $cart_item['quantity'],
                                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                                        'min_value'    => '0',
                                                        'product_name' => $_product->get_name(),
                                                        'classes'      => array('w-7', 'h-7', 'text-center', 'text-xs', 'font-semibold', 'bg-transparent', 'border-none', 'outline-none')
                                                    ),
                                                    $_product,
                                                    false
                                                );
                                            }
                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                            ?>
                                        </div>
                                        <div class="text-base font-bold text-brand-ink">
                                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="text-[11px] sm:text-[11.5px] text-brand-ink3 underline underline-offset-2 hover:text-brand-red mt-2 sm:mt-0" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                            esc_html__( 'Remove this item', 'woocommerce' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $_product->get_sku() )
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </div>
                                
                                <!-- Desktop Quantity -->
                                <div class="hidden sm:flex items-center border-[1.5px] border-brand-line rounded-md overflow-hidden shrink-0 h-8 w-24 product-quantity">
                                    <?php echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok. ?>
                                </div>
                                
                                <div class="hidden sm:block text-lg font-bold text-right min-w-[70px]">
                                    <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
                                </div>

                            </div>
                            <?php
                        }
                    }
                    } // End WooCommerce cart check
                    ?>
                    
                    <?php do_action( 'woocommerce_cart_contents' ); ?>
                    
                    <div class="p-3 bg-brand-bg2 flex justify-end">
                        <button type="submit" class="button px-4 py-2 bg-white border border-brand-line text-brand-ink rounded-md text-xs font-semibold hover:bg-gray-50" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                        <?php do_action( 'woocommerce_cart_actions' ); ?>
                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                    </div>

                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    
                </div>
                
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>

            <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

            <!-- Cart Totals wrapper is output dynamically by WooCommerce via hooked action -->
            <div class="cart-collaterals">
                <?php
                /**
                 * Cart collaterals hook.
                 *
                 * @hooked woocommerce_cross_sell_display
                 * @hooked woocommerce_cart_totals - 10
                 */
                do_action( 'woocommerce_cart_collaterals' );
                ?>
            </div>

        </div>
    </div>
<?php else : ?>
    <div class="animate-in fade-in duration-500 max-w-7xl mx-auto px-7 py-20 text-center">
        <h2 class="font-serif text-3xl font-bold mb-4 text-brand-ink">Your cart is empty.</h2>
        <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="py-3.5 px-6.5 bg-brand-orange text-white rounded-full text-[13px] font-semibold inline-block hover:bg-brand-orange-dark transition-colors">Return to shop</a>
    </div>
<?php return; endif; ?>


