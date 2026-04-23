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

// Check for Pure Veg attribute or tag
$is_pure_veg = true; // Default to true for this sweets shop
$product_tags = get_the_terms( $product->get_id(), 'product_tag' );
if ( $product_tags && ! is_wp_error( $product_tags ) ) {
    foreach ( $product_tags as $tag ) {
        if ( strtolower( $tag->name ) === 'non-veg' ) {
            $is_pure_veg = false;
            break;
        }
    }
}

// Get weight variations if available
$weight_options = array();
if ( $product->is_type( 'variable' ) ) {
    $variations = $product->get_available_variations();
    foreach ( $variations as $variation ) {
        foreach ( $variation['attributes'] as $attr_name => $attr_value ) {
            if ( stripos( $attr_name, 'weight' ) !== false || stripos( $attr_name, 'size' ) !== false || stripos( $attr_name, 'pack' ) !== false ) {
                $weight_options[] = $attr_value;
            }
        }
    }
    $weight_options = array_unique( $weight_options );
}

// Default weight options for simple products
if ( empty( $weight_options ) && $product->get_weight() ) {
    $weight_options[] = $product->get_weight() . 'g';
}

$minimal = false;

// Determine badge type based on product ID for variety
$product_id = $product->get_id();
$badge_types = array('bestseller', 'save', 'bestseller', 'new_arrival');
$badge_type = $badge_types[$product_id % 4];

// Determine status indicator for variety
$status_types = array(
    array('text' => '%d bought in last hour', 'color' => 'green', 'dynamic' => rand(8, 24)),
    array('text' => 'Fresh batch today', 'color' => 'green'),
    array('text' => 'Restocked today', 'color' => 'green'),
    array('text' => 'Just launched', 'color' => 'green'),
);
$status = $status_types[$product_id % 4];
?>

<div <?php wc_product_class( 'product-card bg-white border-[1.5px] border-brand-line rounded-xl overflow-hidden transition-all duration-200 flex flex-col relative hover:border-brand-orange hover:shadow-[0_8px_32px_rgba(0,0,0,0.1)] hover:-translate-y-0.5 group', $product ); ?>>
    
    <a href="<?php the_permalink(); ?>" class="aspect-square bg-brand-bg2 relative overflow-hidden flex items-center justify-center">
        
        <!-- Top Left Badge -->
        <?php if ( $badge_type === 'bestseller' ) : ?>
            <span class="absolute top-3 left-3 z-10 bg-brand-orange text-white text-[10px] font-bold uppercase tracking-wide px-2.5 py-1.5 rounded">BESTSELLER</span>
        <?php elseif ( $badge_type === 'save' && $discountRaw > 0 ) : ?>
            <span class="absolute top-3 left-3 z-10 bg-[#E53935] text-white text-[10px] font-bold uppercase tracking-wide px-2.5 py-1.5 rounded">SAVE <?php echo $discountRaw; ?>%</span>
        <?php elseif ( $badge_type === 'new_arrival' ) : ?>
            <span class="absolute top-3 left-3 z-10 bg-[#27AE60] text-white text-[10px] font-bold uppercase tracking-wide px-2.5 py-1.5 rounded">NEW ARRIVAL</span>
        <?php endif; ?>
        <?php if ( has_post_thumbnail() ) : ?>
            <?php echo $product->get_image('woocommerce_thumbnail', array('class' => 'w-full h-full object-cover absolute inset-0 z-0', 'loading' => 'lazy')); ?>
            <div class="absolute inset-0 bg-gradient-to-br from-[#FDEBD0] to-[#F0A05A] opacity-20 z-[1] mix-blend-multiply pointer-events-none"></div>
        <?php else : ?>
            <div class="text-[9px] tracking-[0.08em] uppercase text-brand-ink3 text-center p-3 relative z-10 font-medium break-all">
                <?php echo esc_html( $product->get_slug() ); ?>.png
            </div>
        <?php endif; ?>
    </a>

    <div class="p-4 flex flex-col flex-1 gap-1.5">

        <!-- Pure Veg Badge -->
        <?php if ( $is_pure_veg ) : ?>
        <div class="flex items-center gap-1.5 mb-1">
            <span class="w-4 h-4 border-2 border-green-600 rounded flex items-center justify-center">
                <span class="w-2 h-2 bg-green-600 rounded-full"></span>
            </span>
            <span class="text-[11px] text-green-600 font-medium">Pure Veg</span>
        </div>
        <?php endif; ?>

        <!-- Product Name -->
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="text-[14px] sm:text-[15px] font-semibold text-[#111] leading-snug hover:text-brand-orange transition-colors line-clamp-1 block">
            <?php echo esc_html( get_the_title() ); ?>
        </a>

        <?php if ( ! $minimal ) : ?>
        <!-- Short description -->
        <p class="text-[12px] sm:text-[13px] text-[#777] leading-[1.5] line-clamp-1 m-0">
            <?php echo esc_html( wp_trim_words( get_the_excerpt(), 8, '...' ) ); ?>
        </p>

        <!-- Rating -->
        <div class="flex items-center gap-1.5 flex-wrap">
            <span class="text-brand-orange text-[11px] tracking-widest leading-none">★★★★★</span>
            <span class="text-[12px] text-[#444] font-semibold"><?php echo esc_html( $product->get_average_rating() ?: '4.8' ); ?></span>
            <span class="text-[11px] text-[#999]">(<?php echo esc_html( $product->get_review_count() ?: '423' ); ?>)</span>
        </div>

        <!-- Weight Variants -->
        <?php if ( ! empty( $weight_options ) || $product->is_type( 'simple' ) ) : 
            // Vary number of weight options based on product ID
            $has_third_option = ($product_id % 3 !== 0);
            $third_option = ($product_id % 2 === 0) ? '1kg' : '500g';
        ?>
        <div class="flex items-center gap-2 flex-wrap mt-1">
            <span class="text-[11px] font-semibold text-white bg-brand-orange py-1.5 px-3 rounded-full">200g</span>
            <span class="text-[11px] font-medium text-[#555] bg-white py-1.5 px-3 rounded-full border border-brand-line hover:border-brand-orange cursor-pointer transition-colors">400g</span>
            <?php if ( $has_third_option ) : ?>
            <span class="text-[11px] font-medium text-[#555] bg-white py-1.5 px-3 rounded-full border border-brand-line hover:border-brand-orange cursor-pointer transition-colors"><?php echo $third_option; ?></span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <!-- Price + Button Row -->
        <div class="flex items-center justify-between gap-3 mt-auto pt-3">
            <?php 
            $price = wc_get_price_to_display( $product );
            if ( $price > 0 ) : ?>
            <div class="flex items-baseline gap-2 flex-wrap">
                <span class="text-[18px] sm:text-[20px] font-bold text-[#111] leading-none">
                    <?php echo wc_price( $price ); ?>
                </span>
                <?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
                    <s class="text-[12px] text-[#aaa]"><?php echo wc_price( $product->get_regular_price() ); ?></s>
                    <span class="text-[10px] font-bold text-brand-orange"><?php echo $discountRaw; ?>% off</span>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="add-to-cart-wrapper shrink-0">
                <?php if ( $product->is_purchasable() && $product->is_in_stock() && $product->is_type( 'simple' ) ) : ?>
                    <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" 
                       data-quantity="1" 
                       class="<?php echo esc_attr( implode( ' ', array(
                           'flex', 'items-center', 'justify-center', 'py-2.5', 'px-4',
                           'bg-brand-orange', 'text-white', 'rounded-lg', 'text-[13px]', 'font-bold',
                           'transition-all', 'hover:bg-brand-orange-dark', 'hover:shadow-lg', 'active:scale-[0.98]',
                           'add_to_cart_button', 'ajax_add_to_cart', 'gap-1.5'
                       ) ) ); ?>" 
                       data-product_id="<?php echo get_the_ID(); ?>" 
                       aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>" 
                       rel="nofollow">
                        <span class="text-[15px] leading-none">+</span> Add
                    </a>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" class="flex items-center justify-center py-2.5 px-4 bg-brand-orange text-white rounded-lg text-[13px] font-bold transition-all hover:bg-brand-orange-dark gap-1.5">
                        <span class="text-[15px] leading-none">+</span> Add
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Status Indicator -->
        <div class="flex items-center gap-1.5 mt-2">
            <?php 
            $status_color_dot = $status['color'] === 'green' ? 'bg-green-500' : 'bg-orange-500';
            $status_color_text = $status['color'] === 'green' ? 'text-green-600' : 'text-orange-600';
            $status_text = isset($status['dynamic']) ? sprintf($status['text'], $status['dynamic']) : $status['text'];
            ?>
            <span class="w-2 h-2 <?php echo $status_color_dot; ?> rounded-full"></span>
            <span class="text-[11px] <?php echo $status_color_text; ?> font-medium"><?php echo esc_html($status_text); ?></span>
        </div>

    </div>
</div>
