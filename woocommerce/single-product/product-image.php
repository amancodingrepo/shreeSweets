<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( wc_get_theme_support( 'gallery_lightbox' ) ? 4 : 1 ),
	'images',
) );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="4">
    <!-- Our Custom Tailwind Layout -->
    <div class="flex flex-col-reverse md:grid md:grid-cols-[80px_minmax(0,1fr)] gap-3 min-w-0 w-full mb-auto">
        
        <?php if ( $attachment_ids && $post_thumbnail_id ) : ?>
        <div class="flex flex-row md:flex-col gap-2 overflow-x-auto no-scrollbar pb-2 md:pb-0">
            <?php foreach ( $attachment_ids as $attachment_id ) : ?>
                <div class="w-16 h-16 md:w-20 md:h-20 border-[2px] border-brand-line rounded-lg overflow-hidden cursor-pointer transition-colors shrink-0 bg-brand-bg2 hover:border-brand-orange">
                    <?php echo wp_get_attachment_image( $attachment_id, 'woocommerce_gallery_thumbnail', false, array( 'class' => 'w-full h-full object-cover mix-blend-multiply' ) ); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="rounded-xl aspect-square flex items-center justify-center relative bg-gradient-to-br from-[#FDEBD0] to-[#F0A05A] w-full overflow-hidden opacity-85">
            <?php
            $image_html = $product->get_image();
            if ( $image_html ) {
                echo $image_html;
            } else {
                echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/placeholder.png' ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="w-full h-full object-cover" />';
            }
            ?>
        </div>

    </div>
</div>
