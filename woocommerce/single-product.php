<?php
/**
 * The Template for displaying all single products
 * (Custom high-end design matching React/Shopify standard)
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header('shop'); ?>

<style>
    /* ── SINGLE PRODUCT PREMIUM STYLES ── */
    :root {
        --brand-orange: #f48220;
        --brand-orange-hover: #e0721b;
        --brand-dark: #1f1f1f;
        --brand-gray: #7a7a7a;
        --brand-light-bg: #fdfaf6;
        --brand-border: #eaeaea;
    }

    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .product-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 2rem 4rem;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    .breadcrumb {
        font-size: 12px;
        color: var(--brand-gray);
        margin-bottom: 2rem;
    }

    .breadcrumb a {
        color: var(--brand-gray);
        text-decoration: none;
    }

    .product-main-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
    }

    /* Gallery Section */
    .gallery-layout {
        display: flex;
        flex-direction: row;
        gap: 1.5rem;
    }

    .thumbnail-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 80px;
        flex-shrink: 0;
    }

    .thumbnail-item {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid transparent;
        cursor: pointer;
        background: var(--brand-light-bg);
    }

    .thumbnail-item.active {
        border-color: var(--brand-orange);
    }

    .main-image-wrapper {
        flex: 1;
        width: 100%;
    }

    .main-image-container {
        border-radius: 12px;
        background: var(--brand-light-bg);
        aspect-ratio: 1 / 1;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .main-image-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Product Details */
    .category-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.15em;
        color: var(--brand-orange);
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .product-title {
        font-family: "Playfair Display", Georgia, serif;
        font-size: 42px;
        font-weight: 700;
        color: var(--brand-dark);
        line-height: 1.1;
        margin-bottom: 1rem;
    }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 13px;
        color: var(--brand-dark);
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .stars {
        color: var(--brand-orange);
        letter-spacing: 2px;
    }

    .stars-empty {
        color: var(--brand-border);
    }

    .rating-count {
        color: var(--brand-gray);
        text-decoration: underline;
        text-decoration-style: dotted;
    }

    .order-count {
        color: var(--brand-gray);
        padding-left: 0.75rem;
        border-left: 1px solid var(--brand-border);
    }

    .price-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.25rem;
        flex-wrap: wrap;
    }

    .current-price {
        font-size: 32px;
        font-weight: 700;
        color: var(--brand-dark);
    }

    .original-price {
        font-size: 18px;
        color: #a0a0a0;
        text-decoration: line-through;
    }

    .discount-badge {
        font-size: 11px;
        font-weight: 700;
        color: #d93838;
        background: #fee2e2;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .tax-shipping-info {
        font-size: 12px;
        color: var(--brand-gray);
        margin-bottom: 1.5rem;
    }

    .short-desc {
        font-size: 14px;
        line-height: 1.6;
        color: #555;
        margin-bottom: 2rem;
        max-width: 90%;
    }

    /* Weight Selection */
    .weight-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--brand-dark);
        margin-bottom: 0.75rem;
        display: block;
    }

    .weight-chips {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .weight-chip {
        padding: 0.5rem 1rem;
        border: 1px solid var(--brand-border);
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        background: white;
        min-width: 80px;
        transition: all 0.2s;
    }

    .weight-chip.active {
        border-color: var(--brand-orange);
        background: #fff8f3;
    }

    .weight-chip b {
        display: block;
        font-size: 14px;
        color: var(--brand-dark);
    }

    .weight-chip span {
        display: block;
        font-size: 11px;
        color: var(--brand-gray);
        margin-top: 2px;
    }

    /* Action Buttons */
    .action-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        border: 1px solid var(--brand-border);
        border-radius: 8px;
        height: 54px;
        background: white;
        box-sizing: border-box;
        overflow: hidden;
        width: 120px;
    }

    .quantity-selector .quantity {
        margin: 0 !important;
        display: flex;
        align-items: center;
        height: 100%;
        width: 100%;
    }

    .qty-btn {
        width: 40px;
        height: 100%;
        background: transparent;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: var(--brand-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        outline: none;
    }

    .qty-input {
        width: 40px !important;
        height: 100% !important;
        text-align: center;
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
        font-size: 16px;
        font-weight: 600;
        color: var(--brand-dark);
        -moz-appearance: textfield;
        padding: 0 !important;
        margin: 0 !important;
        outline: none;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .btn-add-to-cart-dark {
        flex: 1;
        height: 54px;
        background: var(--brand-dark);
        color: white;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        box-sizing: border-box;
        padding: 0 1.5rem;
    }

    .btn-buy-now {
        width: 100%;
        height: 54px;
        background: var(--brand-orange);
        color: white;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        margin-bottom: 2rem;
        border: none;
        box-sizing: border-box;
    }

    /* Trust Badges */
    .product-badge-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
        padding: 1.5rem;
        background: var(--brand-light-bg);
        border-radius: 12px;
        margin-bottom: 2rem;
    }

    .product-badge-item {
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
    }

    .product-badge-icon {
        color: var(--brand-orange);
        flex-shrink: 0;
    }

    .product-badge-text b {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--brand-dark);
    }

    .product-badge-text span {
        font-size: 11px;
        color: var(--brand-gray);
    }

    /* Pincode Widget */
    .pincode-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--brand-dark);
        margin-bottom: 0.5rem;
        display: block;
    }

    .pincode-widget {
        display: flex;
        gap: 0.5rem;
    }

    .pincode-input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid var(--brand-border);
        border-radius: 8px;
        font-size: 13px;
        outline: none;
        min-width: 0;
    }

    .pincode-btn {
        padding: 0 1.5rem;
        background: var(--brand-orange);
        color: white;
        font-weight: 600;
        font-size: 13px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .purchase-activity {
        font-size: 11px;
        color: var(--brand-orange);
        margin-top: 0.75rem;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Tabs */
    .tabs-container {
        margin-top: 4rem;
        border-top: 1px solid var(--brand-border);
        padding-top: 2rem;
    }

    .tabs-list {
        display: flex;
        gap: 2.5rem;
        border-bottom: 1px solid var(--brand-border);
        padding: 0;
        margin: 0 0 2rem 0;
        list-style: none;
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .tabs-list li {
        padding-bottom: 1rem;
        position: relative;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        color: var(--brand-gray);
    }

    .tabs-list li.active {
        color: var(--brand-orange);
    }

    .tabs-list li.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--brand-orange);
    }

    .tab-content {
        font-size: 14px;
        line-height: 1.8;
        color: #444;
        max-width: 800px;
    }

    .tab-content h3 {
        font-family: "Playfair Display", Georgia, serif;
        font-size: 20px;
        color: var(--brand-dark);
        margin: 1.5rem 0 1rem;
    }

    .tab-content ul {
        padding-left: 1.2rem;
        margin-bottom: 1.5rem;
    }

    .tab-content li {
        margin-bottom: 0.5rem;
    }

    /* Related Products */
    .related-section {
        margin-top: 5rem;
    }

    .related-subtitle {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.15em;
        color: var(--brand-orange);
        text-transform: uppercase;
        display: block;
        margin-bottom: 0.5rem;
    }

    .related-title {
        font-family: "Playfair Display", Georgia, serif;
        font-size: 32px;
        font-weight: 700;
        color: var(--brand-dark);
        margin-bottom: 2rem;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    .related-grid>* {
        width: 100% !important;
        margin: 0 !important;
    }

    /* Comments overrides */
    .woocommerce-Reviews .commentlist {
        padding: 0;
        list-style: none;
    }

    .woocommerce-Reviews .comment {
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--brand-border);
    }

    /* ── RESPONSIVE MEDIA QUERIES ── */
    @media (max-width: 1024px) {
        .product-container {
            padding: 2rem;
        }

        .product-main-layout {
            gap: 2rem;
        }

        .product-title {
            font-size: 36px;
        }

        .short-desc {
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .product-container {
            padding: 1.5rem;
        }

        .product-main-layout {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .gallery-layout {
            flex-direction: column-reverse;
        }

        .thumbnail-list {
            flex-direction: row;
            width: 100%;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            -webkit-overflow-scrolling: touch;
        }

        .thumbnail-item {
            flex-shrink: 0;
        }

        .product-title {
            font-size: 28px;
        }

        .current-price {
            font-size: 28px;
        }

        .related-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .tabs-container {
            margin-top: 3rem;
        }

        .product-badge-group {
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
    }

    @media (max-width: 480px) {
        .product-container {
            padding: 1rem;
        }

        .action-row {
            flex-direction: row;
            gap: 0.5rem;
        }

        .quantity-selector {
            width: 110px;
            flex-shrink: 0;
            height: 54px;
        }

        .qty-input {
            width: 30px !important;
        }

        .btn-add-to-cart-dark {
            width: auto;
            flex: 1;
            height: 54px;
            font-size: 14px;
            padding: 0 0.5rem;
        }

        .btn-buy-now {
            height: 54px;
            font-size: 16px;
            margin-bottom: 1.5rem;
        }

        .weight-chips {
            gap: 0.5rem;
        }

        .weight-chip {
            padding: 0.5rem;
            min-width: auto;
            flex: 1;
        }

        .related-grid {
            gap: 0.75rem;
        }

        .related-grid .woocommerce-loop-product__title {
            font-size: 13px !important;
            line-height: 1.3 !important;
        }

        .related-grid .price {
            font-size: 12px !important;
        }

        .pincode-widget {
            flex-direction: column;
            gap: 0.5rem;
        }

        .pincode-btn {
            padding: 0.75rem 1.5rem;
            width: 100%;
            height: 54px;
        }

        .pincode-input {
            height: 54px;
        }
    }
</style>

<?php while (have_posts()):
    the_post();
    global $product;

    $post_thumbnail_id = $product->get_image_id();
    $attachment_ids = $product->get_gallery_image_ids();

    $terms = get_the_terms($product->get_id(), 'product_cat');
    $primary_cat = ($terms && !is_wp_error($terms) && !empty($terms)) ? $terms[0]->name : __('Uncategorized', 'woocommerce');

    $ingredients = $product->get_attribute('ingredients');
    $nutrition = $product->get_attribute('nutrition');
    $shipping = $product->get_attribute('shipping');

    $review_count = $product->get_review_count();
    $average_rating = $product->get_average_rating();

    // Total Sales logic
    $total_sales = get_post_meta($product->get_id(), 'total_sales', true);
    $total_sales_display = $total_sales ? $total_sales : 0;

    // Dynamic Pricing
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    $discount_percentage = 0;
    if ($regular_price && $sale_price && $regular_price > $sale_price) {
        $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
    }

    // Variation attributes specifically for the custom UI (assuming 'pa_weight' or 'weight')
    $available_variations = [];
    $target_attribute = '';
    if ($product->is_type('variable')) {
        $available_variations = $product->get_available_variations();
        $attributes = $product->get_variation_attributes();

        foreach ($attributes as $key => $values) {
            if (stripos($key, 'weight') !== false) {
                $target_attribute = $key;
                break;
            }
        }
        if (empty($target_attribute) && !empty($attributes)) {
            $target_attribute = array_key_first($attributes);
        }
    }
    ?>

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class('product-container', $product); ?>>

        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>"><?php echo __('Home', 'woocommerce'); ?></a> /
            <a href="<?php echo wc_get_page_permalink('shop'); ?>"><?php echo __('Shop', 'woocommerce'); ?></a> /
            <?php echo esc_html($primary_cat); ?> /
            <?php the_title(); ?>
        </div>

        <div class="product-main-layout">

            <div class="gallery-layout">
                <div class="thumbnail-list">
                    <?php if ($post_thumbnail_id): ?>
                        <div class="thumbnail-item active">
                            <?php echo wp_get_attachment_image($post_thumbnail_id, 'thumbnail', false, array('style' => 'width:100%; height:100%; object-fit:cover;')); ?>
                        </div>
                    <?php else: ?>
                        <div class="thumbnail-item active">
                            <img src="<?php echo wc_placeholder_img_src('thumbnail'); ?>"
                                style="width:100%; height:100%; object-fit:cover;" alt="Placeholder" />
                        </div>
                    <?php endif; ?>

                    <?php if ($attachment_ids): ?>
                        <?php foreach (array_slice($attachment_ids, 0, 4) as $attachment_id): ?>
                            <div class="thumbnail-item">
                                <?php echo wp_get_attachment_image($attachment_id, 'thumbnail', false, array('style' => 'width:100%; height:100%; object-fit:cover;')); ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="main-image-wrapper">
                    <div class="main-image-container">
                        <?php if ($post_thumbnail_id): ?>
                            <?php echo wp_get_attachment_image($post_thumbnail_id, 'full'); ?>
                        <?php else: ?>
                            <img src="<?php echo wc_placeholder_img_src('full'); ?>" alt="Placeholder" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="product-info">
                <div class="category-label"><?php echo esc_html(strtoupper($primary_cat)); ?> ·</div>
                <h1 class="product-title"><?php the_title(); ?></h1>

                <div class="rating-row">
                    <span class="stars"><?php echo str_repeat('★', round($average_rating)); ?></span><span
                        class="stars-empty"><?php echo str_repeat('★', 5 - round($average_rating)); ?></span>
                    <span style="font-weight: 700;"><?php echo esc_html($average_rating); ?></span>
                    <span class="rating-count"><?php echo esc_html($review_count); ?>
                        <?php echo __('reviews', 'woocommerce'); ?></span>
                    <?php if ($total_sales_display > 0): ?>
                        <span class="order-count"><?php echo esc_html($total_sales_display); ?>+
                            <?php echo __('orders', 'woocommerce'); ?></span>
                    <?php endif; ?>
                </div>

                <div class="price-row" id="dynamic-price-container">
                    <span class="current-price"><?php echo wc_price(wc_get_price_to_display($product)); ?></span>
                    <?php if ($product->is_on_sale() && $discount_percentage > 0): ?>
                        <span
                            class="original-price"><?php echo wc_price(wc_get_price_to_display($product, array('price' => $product->get_regular_price()))); ?></span>
                        <span class="discount-badge"><?php echo $discount_percentage; ?>% OFF</span>
                    <?php endif; ?>
                </div>

                <div class="tax-shipping-info">
                    <?php echo __('Inclusive of all taxes - Free shipping on orders above ₹499', 'woocommerce'); ?>
                </div>

                <div class="short-desc">
                    <?php echo apply_filters('woocommerce_short_description', $product->get_short_description()); ?>
                </div>

                <?php if ($product->is_type('variable') && !empty($target_attribute) && !empty($available_variations)): ?>
                    <span
                        class="weight-label"><?php echo __('Select', 'woocommerce') . ' ' . wc_attribute_label($target_attribute); ?></span>
                    <div class="weight-chips">
                        <?php foreach ($available_variations as $index => $variation):
                            $var_price = wc_price($variation['display_price']);
                            $var_name = isset($variation['attributes']['attribute_' . $target_attribute]) ? $variation['attributes']['attribute_' . $target_attribute] : '';
                            $is_active = $index === 0 ? 'active' : '';
                            ?>
                            <div class="weight-chip <?php echo $is_active; ?>"
                                data-variation-id="<?php echo esc_attr($variation['variation_id']); ?>"
                                data-price-html="<?php echo esc_attr($variation['price_html']); ?>">
                                <b><?php echo esc_html(ucfirst(str_replace('-', ' ', $var_name))); ?></b>
                                <span><?php echo $var_price; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php
                // Native WooCommerce Add to Cart logic
                if ($product->is_type('variable')) {
                    // Outputting default Woo variable add to cart, styling can be adapted or hidden depending on theme
                    woocommerce_variable_add_to_cart();
                } else {
                    ?>
                    <form class="cart"
                        action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                        method="post" enctype='multipart/form-data'>
                        <div class="action-row">
                            <div class="quantity-selector">
                                <button type="button" class="qty-btn minus">-</button>
                                <?php
                                woocommerce_quantity_input(array(
                                    'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                                    'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                                    'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                                    'classes' => apply_filters('woocommerce_quantity_input_classes', array('qty-input'), $product),
                                ));
                                ?>
                                <button type="button" class="qty-btn plus">+</button>
                            </div>

                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
                                class="btn-add-to-cart-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <?php echo __('Add to Cart', 'woocommerce'); ?>
                            </button>
                        </div>
                    </form>
                <?php } ?>

                <?php if (!$product->is_type('variable')): ?>
                    <a href="<?php echo esc_url(wc_get_checkout_url() . '?add-to-cart=' . $product->get_id()); ?>"
                        class="btn-buy-now">
                        <?php echo __('Buy Now - ', 'woocommerce'); ?>
                        <?php echo wc_price(wc_get_price_to_display($product)); ?>
                    </a>
                <?php endif; ?>

                <div class="product-badge-group">
                    <div class="product-badge-item">
                        <div class="product-badge-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                        </div>
                        <div class="product-badge-text">
                            <b><?php echo __('Free shipping', 'woocommerce'); ?></b>
                            <span><?php echo __('Orders above ₹499', 'woocommerce'); ?></span>
                        </div>
                    </div>
                    <div class="product-badge-item">
                        <div class="product-badge-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="product-badge-text">
                            <b><?php echo __('2-5 day delivery', 'woocommerce'); ?></b>
                            <span><?php echo __('Same-day in Indore', 'woocommerce'); ?></span>
                        </div>
                    </div>
                    <div class="product-badge-item">
                        <div class="product-badge-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <div class="product-badge-text">
                            <b><?php echo __('FSSAI certified', 'woocommerce'); ?></b>
                            <span><?php echo __('Made fresh daily', 'woocommerce'); ?></span>
                        </div>
                    </div>
                    <div class="product-badge-item">
                        <div class="product-badge-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21.5 2v6h-6M2.13 15.57a10 10 0 1 0 4.43-11.89L2 6"></path>
                            </svg>
                        </div>
                        <div class="product-badge-text">
                            <b><?php echo __('7-day freshness', 'woocommerce'); ?></b>
                            <span><?php echo __('Easy returns', 'woocommerce'); ?></span>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 2rem;">
                    <span class="pincode-label"><?php echo __('Check delivery pincode', 'woocommerce'); ?></span>
                    <div class="pincode-widget">
                        <input type="text" placeholder="<?php echo esc_attr__('Enter pincode', 'woocommerce'); ?>"
                            class="pincode-input" maxlength="6" />
                        <button class="pincode-btn"><?php echo __('Check', 'woocommerce'); ?></button>
                    </div>
                    <?php
                    $recent_views = get_post_meta($product->get_id(), '_recent_purchases_cache', true);
                    if (!$recent_views)
                        $recent_views = rand(5, 45);
                    ?>
                    <div class="purchase-activity">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M17.5 19.125c-1.5 1.5-3.5 2.5-6.5 2.5-4 0-7-3-7-7 0-3.5 2-6.5 4.5-8.5.5-.5 1.5-.5 2 0 1.5 1.5 2.5 3.5 2.5 6 0 1.5-.5 3-1.5 4-1 1-2 1.5-2 1.5s1 1.5 2.5 1.5c1.5 0 2.5-1 3.5-2 .5-.5 1-.5 1.5 0 .5.5.5 1 0 1.5z" />
                        </svg>
                        <?php echo sprintf(__('%d people bought this recently', 'woocommerce'), $recent_views); ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="tabs-container">
            <ul class="tabs-list">
                <li class="active" data-tab="tab-description"><?php echo __('Description', 'woocommerce'); ?></li>
                <?php if ($ingredients): ?>
                    <li data-tab="tab-ingredients"><?php echo __('Ingredients', 'woocommerce'); ?></li>
                <?php endif; ?>
                <?php if ($nutrition): ?>
                    <li data-tab="tab-nutrition"><?php echo __('Nutrition Info', 'woocommerce'); ?></li>
                <?php endif; ?>
                <?php if ($shipping): ?>
                    <li data-tab="tab-shipping"><?php echo __('Shipping & Returns', 'woocommerce'); ?></li>
                <?php endif; ?>
                <?php if (comments_open()): ?>
                    <li data-tab="tab-reviews"><?php echo __('Reviews', 'woocommerce'); ?>
                        (<?php echo esc_html($review_count); ?>)</li>
                <?php endif; ?>
            </ul>

            <div id="tab-description" class="tab-content" style="display: block;">
                <?php the_content(); ?>
            </div>

            <?php if ($ingredients): ?>
                <div id="tab-ingredients" class="tab-content" style="display: none;">
                    <p><?php echo wpautop(wp_kses_post($ingredients)); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($nutrition): ?>
                <div id="tab-nutrition" class="tab-content" style="display: none;">
                    <p><?php echo wpautop(wp_kses_post($nutrition)); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($shipping): ?>
                <div id="tab-shipping" class="tab-content" style="display: none;">
                    <p><?php echo wpautop(wp_kses_post($shipping)); ?></p>
                </div>
            <?php endif; ?>

            <?php if (comments_open()): ?>
                <div id="tab-reviews" class="tab-content" style="display: none;">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="related-section">
            <span class="related-subtitle"><?php echo __('YOU MIGHT ALSO LIKE', 'woocommerce'); ?></span>
            <h2 class="related-title"><?php echo __('Customers also bought', 'woocommerce'); ?></h2>

            <?php
            $related_ids = wc_get_related_products($product->get_id(), 4);
            if ($related_ids): ?>
                <div class="related-grid">
                    <?php foreach ($related_ids as $related_id): ?>
                        <?php
                        $post_object = get_post($related_id);
                        setup_postdata($GLOBALS['post'] =& $post_object);
                        wc_get_template_part('content', 'product');
                        ?>
                    <?php endforeach;
                    wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>

    </div>

<?php endwhile; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tabs
        const tabs = document.querySelectorAll('.tabs-list li');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.style.display = 'none');

                tab.classList.add('active');
                const targetContent = document.getElementById(tab.dataset.tab);
                if (targetContent) targetContent.style.display = 'block';
            });
        });

        // Quantity (Custom Buttons controlling Woo Input)
        const qtyInputs = document.querySelectorAll('.qty-input');

        qtyInputs.forEach(qtyInput => {
            const container = qtyInput.closest('.quantity-selector');
            if (container) {
                const qtyMinus = container.querySelector('.qty-btn.minus');
                const qtyPlus = container.querySelector('.qty-btn.plus');

                if (qtyMinus && qtyPlus) {
                    qtyMinus.addEventListener('click', () => {
                        let val = parseInt(qtyInput.value) || 1;
                        let min = parseInt(qtyInput.getAttribute('min')) || 1;
                        if (val > min) {
                            qtyInput.value = val - 1;
                            qtyInput.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    });
                    qtyPlus.addEventListener('click', () => {
                        let val = parseInt(qtyInput.value) || 1;
                        let max = parseInt(qtyInput.getAttribute('max'));
                        if (!max || val < max) {
                            qtyInput.value = val + 1;
                            qtyInput.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    });
                }
            }
        });

        // Gallery Thumbnail Switching
        const thumbs = document.querySelectorAll('.thumbnail-item');
        const mainImg = document.querySelector('.main-image-container img');

        if (thumbs.length && mainImg) {
            thumbs.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    thumbs.forEach(t => t.classList.remove('active'));
                    thumb.classList.add('active');

                    const img = thumb.querySelector('img');
                    if (img) {
                        mainImg.src = img.src;
                        mainImg.srcset = img.srcset || '';
                    }
                });
            });
        }

        // Custom Variations selection logic (to link visual chips to WooCommerce hidden selects)
        const weightChips = document.querySelectorAll('.weight-chip');
        if (weightChips.length > 0) {
            weightChips.forEach(chip => {
                chip.addEventListener('click', () => {
                    weightChips.forEach(c => c.classList.remove('active'));
                    chip.classList.add('active');

                    const newPriceHtml = chip.getAttribute('data-price-html');
                    const priceContainer = document.getElementById('dynamic-price-container');
                    if (newPriceHtml && priceContainer) {
                        priceContainer.innerHTML = newPriceHtml;
                    }

                    // Attempt to sync with native woo dropdown if it exists
                    const targetAttribute = '<?php echo esc_js($target_attribute); ?>';
                    const nativeSelect = document.getElementById(targetAttribute);
                    if (nativeSelect) {
                        const val = chip.querySelector('b').innerText.toLowerCase().replace(' ', '-');
                        nativeSelect.value = val;
                        nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });
        }
    });
</script>

<?php get_footer('shop'); ?>