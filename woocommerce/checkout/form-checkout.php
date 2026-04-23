<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
?>

<div class="animate-in fade-in duration-500 max-w-7xl mx-auto px-5 sm:px-7 py-8 pb-20">

    <h1 class="font-serif text-4xl font-bold mb-2.5 text-brand-ink">Checkout</h1>
    
    <div class="flex flex-wrap items-center gap-1.5 sm:gap-2.5 text-xs mb-7">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="flex items-center gap-1.5 text-brand-green whitespace-nowrap hover:text-brand-green-dark">
            <div class="w-5 h-5 sm:w-5.5 sm:h-5.5 rounded-full border-[1.5px] border-brand-green bg-brand-green text-white flex items-center justify-center text-[10px] sm:text-[11px] font-bold"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></div> Cart
        </a>
        <span class="text-brand-line text-lg">›</span>
        <div class="flex items-center gap-1.5 text-brand-ink font-semibold whitespace-nowrap">
            <div class="w-5 h-5 sm:w-5.5 sm:h-5.5 rounded-full border-[1.5px] border-brand-orange bg-brand-orange text-white flex items-center justify-center text-[10px] sm:text-[11px] font-bold shrink-0">2</div> Details
        </div>
        <span class="text-brand-line text-lg">›</span>
        <div class="flex items-center gap-1.5 text-brand-ink3 whitespace-nowrap">
            <div class="w-5 h-5 sm:w-5.5 sm:h-5.5 rounded-full border-[1.5px] border-current flex items-center justify-center text-[10px] sm:text-[11px] font-bold shrink-0">3</div> Payment
        </div>
    </div>

    <style>
        .woocommerce-checkout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            align-items: start;
        }
        @media (min-width: 1024px) {
            .woocommerce-checkout {
                grid-template-columns: 1fr 400px;
            }
        }
        .checkout-left-col {
            grid-column: 1;
            /* In a 2 col layout, #customer_details stays top left */
        }
        /* #order_review contains both the payment block and the table. We span it completely and use internal grid to move its children! */
        #order_review {
            grid-column: 1 / -1; 
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            align-items: start;
        }
        @media (min-width: 1024px) {
            #order_review {
                grid-template-columns: 1fr 400px;
            }
            #order_review > #payment {
                grid-column: 1;
                /* Move it up visually to appear right below customer details via negative margin or just normal flow */
                margin-top: -30px; 
            }
            #order_review > .order-summary-sidebar {
                grid-column: 2;
                grid-row: 1;
                /* By placing it in grid-row 1 natively, it sits on the right. 
                   But we have to pull it up to align with customer details.
                   Because #customer_details is outside, we apply negative margin: */
                margin-top: calc(-100% - 250px); /* rough estimate, better to use flex instead of magic margin */
            }
        }
        
        /* Simpler CSS approach for wide screens without negative margins:
           We will position the right sidebar absolutely within the form if native flow is hard,
           OR we leave customer details outside, and just let payment follow below it, 
           while sidebar floats right. */
    </style>

    <form name="checkout" method="post" class="checkout woocommerce-checkout relative lg:pr-[440px]" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <!-- Main Form Left Side -->
        <div class="checkout-left-col">
            <?php if ( $checkout->get_checkout_fields() ) : ?>

                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <div class="bg-white border-[1.5px] border-brand-line rounded-xl mb-4 overflow-hidden" id="customer_details">
                    <div class="bg-brand-bg2 py-4 px-5.5 flex items-center gap-3 border-b border-brand-line">
                        <div class="w-6 h-6 bg-brand-orange text-white rounded-full flex items-center justify-center text-[11px] font-bold">1</div>
                        <h3 class="text-[15px] font-bold m-0">Billing & Shipping</h3>
                    </div>
                    
                    <div class="p-5.5 woo-custom-billing-fields">
                        <style>
                            /* Tailwind reset for Woo fields */
                            .woo-custom-billing-fields p.form-row { width: 100%; margin-bottom: 12px; }
                            .woo-custom-billing-fields label { font-size: 11.5px; color: var(--color-brand-ink3, #71717A); display: block; margin-bottom: 4px; font-weight: 500; }
                            .woo-custom-billing-fields input, .woo-custom-billing-fields select, .woo-custom-billing-fields textarea { width: 100%; padding: 10px 12px; font-size: 13px; border: 1.5px solid var(--color-brand-line, #E4E4E7); border-radius: 6px; background-color: white; color: var(--color-brand-ink, #000); transition: border-color 0.2s; }
                            .woo-custom-billing-fields input:focus, .woo-custom-billing-fields select:focus { outline: none; border-color: var(--color-brand-orange, #F4821F); }
                            .woo-custom-billing-fields h3 { display: none; } /* Hide default woo headings */
                            .woo-custom-billing-fields .col2-set .col-1, .woo-custom-billing-fields .col2-set .col-2 { float:none; width:100%; }
                        </style>
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php endif; ?>
        </div>

        <!-- The Review Order div handles AJAX updates. It contains both table and payment. -->
        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
        
        <div id="order_review" class="woocommerce-checkout-review-order">
            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
        </div>

        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

    </form>
    
    <style>
        /* Modern Layout: The form has right padding, the sidebar is positioned absolute inside the form */
        @media (min-width: 1024px) {
            .order-summary-sidebar {
                position: absolute !important;
                right: 0;
                top: 0;
                width: 400px;
                /* Note: .sticky top-24 will still work if form is relative */
                height: max-content;
            }
        }
        
        #payment.woocommerce-checkout-payment { background: none; border-radius: 0; padding: 0; margin-top: 10px; }
        #payment ul.payment_methods label { font-size: 13.5px; font-weight: 600; display: inline-block; cursor: pointer; }
        #payment div.payment_box { background-color: #FAFAFA; border: 1.5px solid var(--color-brand-line, #E4E4E7); border-radius: 8px; font-size: 12px; margin-top: 8px; padding: 12px; }
        #payment div.payment_box::before { display: none; }
        
        #payment .place-order button#place_order {
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
            border: none !important;
            margin-top: 20px !important;
            cursor: pointer;
        }
        #payment .place-order button#place_order:hover {
            background-color: var(--color-brand-orange-dark, #D66D14) !important;
        }
        #payment ul.payment_methods li { margin-bottom: 15px; border: 2px solid var(--color-brand-line, #E4E4E7); border-radius: 8px; padding: 14px; transition: background-color 0.2s; }
        #payment ul.payment_methods li:hover { background-color: #FAFAFA; }

        /* The custom payment heading we manually inject via CSS since we removed the wrapper */
        #payment::before {
            content: "Order Processing";
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: #FAF7F2;
            padding: 16px 22px;
            font-size: 15px;
            font-weight: 700;
            color: #1A1A1A;
            border-bottom: 1.5px solid var(--color-brand-line, #E4E4E7);
            border-top: 1.5px solid var(--color-brand-line, #E4E4E7);
            border-left: 1.5px solid var(--color-brand-line, #E4E4E7);
            border-right: 1.5px solid var(--color-brand-line, #E4E4E7);
            border-radius: 12px 12px 0 0;
            margin-bottom: -2px; /* Pull the list up to cover border */
        }
    </style>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>
