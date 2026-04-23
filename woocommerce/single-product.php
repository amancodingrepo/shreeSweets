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
        margin-bottom: 2rem;
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
        font-size: 12px;
        font-weight: 600;
        color: var(--brand-dark);
        margin-bottom: 0.75rem;
        display: block;
    }

    .weight-chips {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .weight-chip {
        padding: 0.75rem 1.5rem;
        border: 1px solid var(--brand-border);
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        background: white;
        min-width: 100px;
        transition: all 0.2s;
        flex: 1;
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
    }

    .quantity-selector .quantity {
        margin: 0 !important;
        display: flex;
        align-items: center;
        height: 100%;
    }

    .qty-btn {
        width: 45px;
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
        width: 50px !important;
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
        width: 100%;
        height: 54px;
        background: var(--brand-dark);
        color: white;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
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
        /* Prevents overflow */
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

    /* Reviews Styling */
    .fake-review {
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--brand-border);
    }

    .fake-review:last-child {
        border-bottom: none;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
        flex-wrap: wrap;
    }

    .review-author {
        font-weight: 700;
        color: var(--brand-dark);
    }

    .review-date {
        font-size: 12px;
        color: var(--brand-gray);
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
            grid-template-columns: 1fr;
            gap: 1rem;
        }
    }

    @media (max-width: 480px) {
        .product-container {
            padding: 1rem;
        }

        .action-row {
            flex-direction: column;
            gap: 1rem;
        }

        .quantity-selector {
            width: 100%;
            justify-content: space-between;
            height: 54px;
        }

        .qty-input {
            width: 100%;
        }

        .btn-add-to-cart-dark {
            width: 100%;
            height: 54px;
            font-size: 16px;
        }

        .btn-buy-now {
            height: 54px;
            font-size: 16px;
            margin-bottom: 1.5rem;
        }

        .related-grid {
            grid-template-columns: repeat(2, 1fr);
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
    the_post(); ?>
    <?php
    global $product;
    $post_thumbnail_id = $product->get_image_id();
    $attachment_ids = $product->get_gallery_image_ids();

    $terms = get_the_terms($product->get_id(), 'product_cat');
    $primary_cat = ($terms && !is_wp_error($terms) && !empty($terms)) ? $terms[0]->name : 'Uncategorized';

    // Generate random review count
    $random_review_count = rand(10, 20);

    // Get dynamic attributes or fallback
    $ingredients = $product->get_attribute('ingredients');
    $nutrition = $product->get_attribute('nutrition');
    $shipping = $product->get_attribute('shipping');
    ?>

    <div id="product-<?php the_ID(); ?>" class="product-container">

        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a> / <a href="<?php echo wc_get_page_permalink('shop'); ?>">Shop</a>
            / <?php echo esc_html($primary_cat); ?> / <?php the_title(); ?>
        </div>

        <div class="product-main-layout">

            <div class="gallery-layout">
                <div class="thumbnail-list">
                    <?php if ($post_thumbnail_id): ?>
                        <div class="thumbnail-item active">
                            <?php echo wp_get_attachment_image($post_thumbnail_id, 'thumbnail', false, array('style' => 'width:100%; height:100%; object-fit:cover;')); ?>
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
                <div class="category-label"><?php echo esc_html($primary_cat); ?> ·</div>
                <h1 class="product-title"><?php the_title(); ?></h1>

                <div class="rating-row">
                    <span class="stars">★★★★★</span>
                    <span style="font-weight: 700;">4.8</span>
                    <span class="rating-count"><?php echo $random_review_count; ?> reviews</span>
                    <span class="order-count"><?php echo rand(100, 999); ?>+ orders</span>
                </div>

                <div class="price-row">
                    <span class="current-price"><?php echo wc_price(wc_get_price_to_display($product)); ?></span>
                    <?php if ($product->is_on_sale()): ?>
                        <span
                            class="original-price"><?php echo wc_price(wc_get_price_to_display($product, array('price' => $product->get_regular_price()))); ?></span>
                        <span class="discount-badge">
                            <?php echo round((($product->get_regular_price() - $product->get_price()) / $product->get_regular_price()) * 100); ?>%
                            OFF
                        </span>
                    <?php endif; ?>
                </div>

                <div class="tax-shipping-info">
                    Inclusive of all taxes - free shipping on orders above ₹499
                </div>

                <div class="short-desc">
                    <?php echo apply_filters('woocommerce_short_description', $product->get_short_description()); ?>
                </div>

                <?php if ($product->is_type('variable')): ?>
                    <?php woocommerce_variable_add_to_cart(); ?>
                <?php else: ?>
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
                                Add to Cart
                            </button>
                        </div>
                    </form>

                    <a href="<?php echo esc_url(wc_get_checkout_url() . '?add-to-cart=' . $product->get_id()); ?>"
                        class="btn-buy-now">
                        Buy Now · <?php echo wc_price(wc_get_price_to_display($product)); ?>
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
                            <b>Free shipping</b>
                            <span>Orders above ₹499</span>
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
                            <b>2-5 day delivery</b>
                            <span>Same-day in Indore</span>
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
                            <b>FSSAI certified</b>
                            <span>Made fresh daily</span>
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
                            <b>7-day freshness</b>
                            <span>Easy returns</span>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 2rem;">
                    <span class="pincode-label">Check delivery pincode</span>
                    <div class="pincode-widget">
                        <input type="text" placeholder="Enter pincode" class="pincode-input" maxlength="6" />
                        <button class="pincode-btn">Check</button>
                    </div>
                    <div class="purchase-activity">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M17.5 19.125c-1.5 1.5-3.5 2.5-6.5 2.5-4 0-7-3-7-7 0-3.5 2-6.5 4.5-8.5.5-.5 1.5-.5 2 0 1.5 1.5 2.5 3.5 2.5 6 0 1.5-.5 3-1.5 4-1 1-2 1.5-2 1.5s1 1.5 2.5 1.5c1.5 0 2.5-1 3.5-2 .5-.5 1-.5 1.5 0 .5.5.5 1 0 1.5z" />
                        </svg>
                        <?php echo rand(5, 25); ?> people bought this in the last hour
                    </div>
                </div>

            </div>
        </div>

        <div class="tabs-container">
            <ul class="tabs-list">
                <li class="active" data-tab="tab-description">Description</li>
                <?php if ($ingredients): ?>
                    <li data-tab="tab-ingredients">Ingredients</li>
                <?php endif; ?>
                <?php if ($nutrition): ?>
                    <li data-tab="tab-nutrition">Nutrition Info</li>
                <?php endif; ?>
                <?php if ($shipping): ?>
                    <li data-tab="tab-shipping">Shipping & Returns</li>
                <?php endif; ?>
                <li data-tab="tab-reviews">Reviews (<?php echo $random_review_count; ?>)</li>
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

            <div id="tab-reviews" class="tab-content" style="display: none;">
                <h3>Customer Reviews</h3>
                <?php
                $fake_names = ['Rajesh K.', 'Priya S.', 'Amit V.', 'Neha G.', 'Suresh P.', 'Anita M.', 'Rahul T.', 'Meera S.', 'Vikas R.', 'Pooja B.', 'Anand D.', 'Kavita L.', 'Ravi J.', 'Sunita N.', 'Deepak M.', 'Sneha P.', 'Manoj K.', 'Aarti C.', 'Sanjay S.', 'Renu V.'];
                $fake_comments = [
                    'Absolutely loved the quality. Will definitely order again!',
                    'Authentic taste and fresh packaging. Highly recommended.',
                    'Good product, but delivery took an extra day. Still worth it.',
                    'Exactly as described. The taste is incredibly balanced.',
                    'My family loves this! We order it every month.',
                    'Premium quality! You can really tell they use good ingredients.',
                    'Very crispy and fresh. Arrived in perfect condition.',
                    'Tastes just like the traditional ones I used to have as a kid.',
                    'Great packaging. Makes for a perfect gift too!',
                    'A bit pricey, but the quality justifies the cost.',
                    'Delicious! It vanished from the jar in just two days.',
                    'Perfect accompaniment with evening tea.',
                    'Highly satisfied with the purchase. Fresh and crunchy.',
                    'The flavor profile is spot on. Not too overpowering.',
                    'Impressive quality control. Every piece tastes consistent.'
                ];

                shuffle($fake_names);
                for ($i = 0; $i < $random_review_count; $i++) {
                    $name = isset($fake_names[$i]) ? $fake_names[$i] : 'Verified Customer';
                    $comment = $fake_comments[array_rand($fake_comments)];
                    $days_ago = rand(1, 30);
                    ?>
                    <div class="fake-review">
                        <div class="review-header">
                            <div>
                                <span class="stars" style="font-size: 12px;">★★★★★</span>
                                <span class="review-author ml-2" style="margin-left: 8px;"><?php echo $name; ?></span>
                            </div>
                            <span class="review-date"><?php echo $days_ago; ?> days ago</span>
                        </div>
                        <p style="margin-top: 8px; font-size: 13px;"><?php echo $comment; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="related-section">
            <span class="related-subtitle">YOU MIGHT ALSO LIKE</span>
            <h2 class="related-title">Customers also bought</h2>

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
        const qtyInput = document.querySelector('.qty-input');
        const qtyMinus = document.querySelector('.qty-btn.minus');
        const qtyPlus = document.querySelector('.qty-btn.plus');

        if (qtyInput && qtyMinus && qtyPlus) {
            qtyMinus.addEventListener('click', () => {
                let val = parseInt(qtyInput.value) || 1;
                let min = parseInt(qtyInput.getAttribute('min')) || 1;
                if (val > min) {
                    qtyInput.value = val - 1;
                }
            });
            qtyPlus.addEventListener('click', () => {
                let val = parseInt(qtyInput.value) || 1;
                let max = parseInt(qtyInput.getAttribute('max'));
                if (!max || val < max) {
                    qtyInput.value = val + 1;
                }
            });
        }

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
    });
</script>

<?php get_footer('shop'); ?>