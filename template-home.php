<?php
/**
 * Template Name: Custom Homepage
 * The template for displaying the front page (Converted from Home.tsx)
 */
get_header();

// ACF shim — stubs all ACF functions when the plugin is not active,
// preventing fatal errors on PHP 8.1+ (Hostinger default).
if (!function_exists('get_field')) {
    function get_field($selector, $post_id = false, $format_value = true)
    {
        return false;
    }
}
if (!function_exists('get_sub_field')) {
    function get_sub_field($selector, $format_value = true)
    {
        return false;
    }
}
if (!function_exists('have_rows')) {
    function have_rows($selector, $post_id = false)
    {
        return false;
    }
}
if (!function_exists('the_row')) {
    function the_row()
    {
    }
}
?>



<main id="primary" class="site-main">



    <!-- Hero Banner -->
    <div class="relative bg-brand-bg2 overflow-hidden min-h-[280px] md:min-h-[380px] animate-slide-in-up"
        style="animation-delay: 0.2s; animation-fill-mode: both;">
        <?php
        $badge = get_field('badge') ?: '';
        $badge_color = get_field('badge_color') ?: 'bg-brand-orange';
        $title = get_field('title') ?: 'Authentic Ratlami Sev from the heart of Indore';
        $subtitle = get_field('subtitle') ?: '';
        $description = get_field('description') ?: 'Hand-crafted in small batches every morning. No preservatives. Packed fresh, delivered to your door.';
        $button_text = get_field('button_text') ?: 'Shop Now ›';
        $button_link = get_field('button_link') ?: home_url('/shop/');
        $background_image = get_field('background_image');
        $discount = get_field('discount') ?: '';
        $gradient_start = get_field('gradient_start') ?: '#FEF3E8';
        $gradient_end = get_field('gradient_end') ?: '#F4821F';
        ?>
        <div class="absolute inset-0"
            style="background: linear-gradient(to right, <?php echo esc_attr($gradient_start); ?>, <?php echo esc_attr($gradient_end); ?>);">
        </div>
        <div
            class="relative z-10 max-w-full mx-auto px-6 md:px-16 lg:px-20 w-full flex items-center justify-between py-8 md:py-12 min-h-[280px] md:min-h-[380px]">
            <div>
                <?php if ($badge): ?>
                    <div
                        class="inline-block text-white text-[10px] font-bold tracking-[0.12em] uppercase py-1.5 px-3 rounded mb-3.5 <?php echo esc_attr($badge_color); ?>">
                        <?php echo esc_html($badge); ?>
                    </div>
                <?php endif; ?>

                <h1
                    class="font-serif text-[clamp(36px,4.5vw,58px)] font-bold leading-[1.1] text-brand-ink mb-3 max-w-[440px]">
                    <?php echo wp_kses_post($title); ?>
                    <?php if ($subtitle): ?>
                        <span class="block text-[clamp(20px,2.5vw,32px)] font-semibold text-[#555] mt-1">
                            <?php echo esc_html($subtitle); ?>
                        </span>
                    <?php endif; ?>
                </h1>
                <p class="text-sm text-brand-ink2 leading-relaxed max-w-[380px] mb-6">
                    <?php echo esc_html($description); ?>
                </p>
                <div class="flex gap-3 flex-wrap">
                    <a href="<?php echo esc_url($button_link); ?>" class="btn-primary text-sm">
                        <?php echo esc_html($button_text); ?>
                    </a>
                </div>
            </div>
            <div class="relative w-[340px] shrink-0 flex items-center justify-center hidden md:flex">
                <div
                    class="w-[300px] h-[300px] rounded-full flex items-center justify-center relative shadow-lg bg-white/25">
                    <?php if ($background_image): ?>
                        <?php echo wp_get_attachment_image($background_image, 'large', false, array('class' => 'w-full h-full object-contain absolute z-10 drop-shadow-2xl', 'loading' => 'eager', 'fetchpriority' => 'high')); ?>
                    <?php else: ?>
                        <div
                            class="absolute inset-0 rounded-full flex items-center justify-center flex-col gap-2 p-5 text-center">
                            <span class="text-[10px] tracking-widest uppercase text-white/70">No Image Uploaded</span>
                        </div>
                    <?php endif; ?>

                    <?php if ($discount): ?>
                        <div
                            class="absolute -top-2.5 -right-2.5 w-[88px] h-[88px] rounded-full bg-brand-red text-white flex flex-col items-center justify-center text-center -rotate-[8deg] shadow-[0_2px_12px_rgba(0,0,0,0.07)] z-20">
                            <b class="text-[26px] font-bold leading-none">
                                <?php echo esc_html($discount); ?>
                            </b>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Delivery Strip -->
    <div class="bg-brand-ink text-white animate-slide-in-up" style="animation-delay: 0.4s; animation-fill-mode: both;">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 py-5 grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-brand-orange/20 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                        stroke="#F4821F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13" />
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                        <circle cx="5.5" cy="18.5" r="2.5" />
                        <circle cx="18.5" cy="18.5" r="2.5" />
                    </svg>
                </div>
                <div>
                    <b class="text-[12px] block font-semibold leading-tight">Free shipping</b>
                    <span class="text-[10.5px] text-white/55 leading-tight">Orders above ₹499</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-brand-orange/20 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                        stroke="#F4821F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </div>
                <div>
                    <b class="text-[12px] block font-semibold leading-tight">Same-day delivery</b>
                    <span class="text-[10.5px] text-white/55 leading-tight">Order before 2 PM</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-brand-orange/20 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                        stroke="#F4821F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        <path d="M9 12l2 2 4-4" />
                    </svg>
                </div>
                <div>
                    <b class="text-[12px] block font-semibold leading-tight">FSSAI certified</b>
                    <span class="text-[10.5px] text-white/55 leading-tight">Lic. 10012345678901</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-brand-orange/20 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                        stroke="#F4821F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5" />
                        <line x1="12" y1="1" x2="12" y2="3" />
                        <line x1="12" y1="21" x2="12" y2="23" />
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                        <line x1="1" y1="12" x2="3" y2="12" />
                        <line x1="21" y1="12" x2="23" y2="12" />
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                    </svg>
                </div>
                <div>
                    <b class="text-[12px] block font-semibold leading-tight">7-day freshness</b>
                    <span class="text-[10.5px] text-white/55 leading-tight">Easy returns</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Categories from Backend -->
    <section class="home-section">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20">
            <div class="flex items-end justify-between mb-7 md:mb-10 gap-4">
                <div>
                    <span class="section-label">Browse by category</span>
                    <h2 class="section-heading">
                        <?php echo esc_html((function_exists('get_field') && get_field('cat_heading')) ? get_field('cat_heading') : 'Shop by craving'); ?>
                    </h2>
                </div>
                <a href="<?php echo esc_url(home_url('/shop/')); ?>"
                    class="text-[13px] font-medium text-[#555] hover:text-brand-orange transition-colors">View all
                    &rarr;</a>
            </div>

            <?php
            if (class_exists('WooCommerce')):
                $terms = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                ));

                if (!empty($terms) && !is_wp_error($terms)): ?>
                    <div
                        class="flex w-full justify-between gap-6 sm:gap-8 md:gap-10 lg:gap-16 overflow-x-auto pb-6 no-scrollbar flex-nowrap items-start snap-x">
                        <?php
                        $gradients = ['from-[#FDEBD0] to-[#F0A05A]', 'from-[#F9EBEA] to-[#C0786A]', 'from-[#EBF5FB] to-[#6AAED6]', 'from-[#E9F7EF] to-[#6AAD8A]', 'from-[#FDF9E3] to-[#D4A860]', 'from-[#F5EEF8] to-[#A070B0]'];
                        $i = 0;
                        foreach ($terms as $term):
                            if ($term->slug === 'uncategorized')
                                continue;
                            $link = get_term_link($term);
                            $gradient = $gradients[$i % count($gradients)];
                            $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                            $image = wp_get_attachment_url($thumbnail_id);
                            ?>
                            <a href="<?php echo esc_url($link); ?>"
                                class="flex flex-col items-center gap-4 cursor-pointer shrink-0 snap-start group min-w-[86px] md:min-w-[140px]">
                                <div
                                    class="w-[82px] h-[82px] md:w-[130px] md:h-[130px] rounded-full bg-brand-bg2 border-[4px] border-white shadow-sm overflow-hidden flex items-center justify-center relative transition-all duration-500 group-hover:border-brand-orange group-hover:scale-110 group-hover:shadow-xl bg-gradient-to-br <?php echo esc_attr($gradient); ?>">
                                    <?php if ($image): ?>
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($term->name); ?>"
                                            class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <span
                                            class="text-[12px] md:text-[14px] tracking-[0.1em] font-bold uppercase text-white drop-shadow-md text-center p-2">
                                            <?php echo esc_html(substr($term->name, 0, 1)); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="text-center">
                                    <div class="text-[12px] font-semibold text-[#111]">
                                        <?php echo esc_html($term->name); ?>
                                    </div>
                                    <div class="text-[10px] text-[#888]">
                                        <?php echo esc_html($term->count); ?> items
                                    </div>
                                </div>
                            </a>
                            <?php $i++;
                        endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="p-10 border-2 border-dashed border-brand-line rounded-xl text-center text-brand-ink3">
                        <p>No categories found. Please add product categories in WooCommerce.</p>
                    </div>
                <?php endif;
            endif;
            ?>
        </div>
    </section>

    <!-- Bestsellers Section -->
    <section class="home-section">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20">
            <div class="flex items-end justify-between mb-7 md:mb-10 gap-4">
                <div>
                    <span class="section-label">Most loved this week</span>
                    <h2 class="section-heading">
                        <?php echo esc_html((function_exists('get_field') && get_field('best_heading')) ? get_field('best_heading') : 'Bestsellers'); ?>
                    </h2>
                </div>
                <a href="<?php echo esc_url(home_url('/shop/')); ?>"
                    class="inline-flex items-center gap-1 text-[13px] font-semibold text-brand-orange border border-brand-orange rounded-full px-5 py-2 hover:bg-brand-orange hover:text-white transition-all">All
                    <?php echo function_exists('wp_count_posts') ? wp_count_posts('product')->publish : '89'; ?>
                    products &rarr;
                </a>
            </div>

            <?php
            if (class_exists('WooCommerce')) {
                $bestsellers = wc_get_products(array('limit' => 4, 'orderby' => 'meta_value_num', 'meta_key' => 'total_sales', 'status' => 'publish'));

                if (!empty($bestsellers)) {
                    echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">';
                    foreach ($bestsellers as $product_obj) {
                        $post_object = get_post($product_obj->get_id());
                        setup_postdata($GLOBALS['post'] =& $post_object);
                        global $product;
                        $product = wc_get_product($product_obj->get_id());
                        wc_get_template_part('content', 'product');
                    }
                    echo '</div>';
                } else {
                    echo '<div class="p-10 bg-brand-bg2 rounded-xl text-center text-brand-ink3"><p>Products will appear here once you add them to your store.</p></div>';
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </section>

    <!-- Promo Banners -->
    <section class="home-section">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
                <?php
                if (have_rows('promo_banners')):
                    while (have_rows('promo_banners')):
                        the_row();
                        $tag = get_sub_field('tag') ?: '';
                        $title = get_sub_field('title') ?: '';
                        $btn_text = get_sub_field('btn_text') ?: '';
                        $btn_link = get_sub_field('btn_link') ?: '';
                        $bg_color = get_sub_field('bg_color') ?: '#FEF3E8';
                        $circle_color = get_sub_field('circle_color') ?: '#F4821F';
                        $image = get_sub_field('image');
                        ?>
                        <div class="rounded-xl p-8 py-8 px-9 flex items-center justify-between gap-5 relative overflow-hidden min-h-[160px]"
                            style="background: linear-gradient(to bottom right, <?php echo esc_attr($bg_color); ?>, <?php echo esc_attr($bg_color); ?>90);">
                            <div>
                                <?php if ($tag): ?>
                                    <div class="text-[10.5px] font-bold tracking-[0.12em] uppercase text-brand-orange mb-2">
                                        <?php echo esc_html($tag); ?>
                                    </div>
                                <?php endif; ?>
                                <h3 class="font-serif text-2xl font-bold text-brand-ink mb-2.5 leading-[1.2]">
                                    <?php echo esc_html($title); ?>
                                </h3>
                                <?php if ($btn_text && $btn_link): ?>
                                    <a href="<?php echo esc_url($btn_link); ?>"
                                        class="inline-flex items-center gap-1.5 py-2.5 px-5 bg-brand-orange text-white rounded-lg text-xs font-semibold hover:bg-brand-orange-dark transition-colors">
                                        <?php echo esc_html($btn_text); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php if ($image): ?>
                                <div class="w-[130px] h-[130px] rounded-full flex items-center justify-center shrink-0"
                                    style="background: linear-gradient(to bottom right, <?php echo esc_attr($circle_color); ?>, <?php echo esc_attr($circle_color); ?>80);">
                                    <?php echo wp_get_attachment_image($image, 'medium', false, array('class' => 'w-full h-full object-cover rounded-full')); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                    endwhile;
                else:
                    ?>
                    <div
                        class="rounded-xl p-8 py-8 px-9 flex items-center justify-between gap-5 relative overflow-hidden bg-gradient-to-br from-[#FEF3E8] to-[#FDEBD0] min-h-[160px]">
                        <div>
                            <div class="text-[10.5px] font-bold tracking-[0.12em] uppercase text-brand-orange mb-2">Diwali
                                Special</div>
                            <h3 class="font-serif text-2xl font-bold text-brand-ink mb-2.5 leading-[1.2]">Gift Packs
                                starting at ₹499</h3>
                            <a href="<?php echo esc_url(home_url('/shop/?category=Gift+Packs')); ?>"
                                class="inline-flex items-center gap-1.5 py-2.5 px-5 bg-brand-orange text-white rounded-lg text-xs font-semibold hover:bg-brand-orange-dark transition-colors">Shop
                                Gift Packs →</a>
                        </div>
                        <div
                            class="w-[130px] h-[130px] rounded-full flex items-center justify-center shrink-0 bg-gradient-to-br from-[#FDEBD0] to-brand-orange">
                            <div class="text-[9px] tracking-wider uppercase text-white/70 text-center">
                                giftbox.png<br />260×260</div>
                        </div>
                    </div>

                    <div
                        class="rounded-xl p-8 py-8 px-9 flex items-center justify-between gap-5 relative overflow-hidden bg-gradient-to-br from-[#F2EBE0] to-[#E8DDD0] min-h-[160px]">
                        <div>
                            <div class="text-[10.5px] font-bold tracking-[0.12em] uppercase text-brand-red mb-2">Limited
                                Time</div>
                            <h3 class="font-serif text-2xl font-bold text-brand-ink mb-2.5 leading-[1.2]">Buy 2 get 1 free
                                on all Sev</h3>
                            <a href="<?php echo esc_url(home_url('/shop/?category=Indori+Sev')); ?>"
                                class="inline-flex items-center gap-1.5 py-2.5 px-5 bg-brand-red text-white rounded-lg text-xs font-semibold hover:bg-[#a93226] transition-colors">Shop
                                Sev →</a>
                        </div>
                        <div
                            class="w-[130px] h-[130px] rounded-full flex items-center justify-center shrink-0 bg-gradient-to-br from-[#F9EBEA] to-brand-red">
                            <div class="text-[9px] tracking-wider uppercase text-white/70 text-center">
                                sev-pack.png<br />260×260</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="home-section">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20">
            <div class="flex items-end justify-between mb-7 md:mb-10 gap-4">
                <div>
                    <span class="section-label">Just added</span>
                    <h2 class="section-heading">
                        <?php echo esc_html((function_exists('get_field') && get_field('new_heading')) ? get_field('new_heading') : 'New arrivals'); ?>
                    </h2>
                </div>
                <a href="<?php echo esc_url(home_url('/shop/')); ?>"
                    class="text-[13px] font-medium text-[#555] hover:text-brand-orange transition-colors">View all
                    &rarr;</a>
            </div>

            <?php
            if (class_exists('WooCommerce')) {
                $new_arrivals = wc_get_products(array('limit' => 4, 'orderby' => 'date', 'order' => 'DESC', 'status' => 'publish'));

                if (!empty($new_arrivals)) {
                    echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">';
                    foreach ($new_arrivals as $product_obj) {
                        $post_object = get_post($product_obj->get_id());
                        setup_postdata($GLOBALS['post'] =& $post_object);
                        global $product;
                        $product = wc_get_product($product_obj->get_id());
                        wc_get_template_part('content', 'product');
                    }
                    echo '</div>';
                } else {
                    echo '<div class="p-10 bg-brand-bg2 rounded-xl text-center text-brand-ink3"><p>New arrivals will appear here once you add products.</p></div>';
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </section>

    <!-- Our Story Section (Dark Section) -->
    <?php
    // FIX: Normalize $story to [] so all $story['key'] ?? 'fallback' are safe on PHP 8.1+
    $story = (function_exists('get_field') ? get_field('our_story') : null) ?: [];
    ?>
    <section class="home-section bg-brand-ink text-white overflow-hidden">
        <div
            class="max-w-full mx-auto px-6 md:px-16 lg:px-20 grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">

            <div>
                <span class="section-label">Our Story</span>
                <h2 class="font-serif font-bold leading-[1.1] text-white mb-6 text-[clamp(36px,4vw,58px)]">
                    <?php echo wp_kses_post($story['title'] ?? 'From Sarafa Bazaar to<br><em class="text-brand-orange italic">your doorstep.</em>'); ?>
                </h2>
                <p class="text-[15px] leading-relaxed text-white/55 mb-8 max-w-[500px]">
                    <?php echo esc_html($story['copy'] ?? 'In 1989, Ramesh Bhai started frying sev in a tiny shop on Sarafa Bazaar, Indore. He ground besan fresh every morning, roasted masalas in-house, and tested every batch himself. Three generations later, the recipes are the same — only the packaging has changed.'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/about-us/')); ?>"
                    class="text-brand-orange font-semibold text-sm hover:underline">
                    Read our story →
                </a>

                <hr class="border-t border-white/10 my-10">

                <div class="grid grid-cols-2 gap-x-12 gap-y-8">
                    <?php if (!empty($story['stats'])): ?>
                        <?php foreach ($story['stats'] as $stat): ?>
                            <div>
                                <b class="text-4xl md:text-5xl font-extrabold text-brand-orange block leading-none mb-2">
                                    <?php echo esc_html($stat['value']); ?>
                                </b>
                                <span class="text-[10px] text-white/35 tracking-[0.2em] uppercase font-bold">
                                    <?php echo esc_html($stat['label']); ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div>
                            <b class="text-4xl md:text-5xl font-extrabold text-brand-orange block leading-none mb-2">37</b>
                            <span class="text-[10px] text-white/35 tracking-[0.2em] uppercase font-bold">Years of
                                tradition</span>
                        </div>
                        <div>
                            <b
                                class="text-4xl md:text-5xl font-extrabold text-brand-orange block leading-none mb-2">12k+</b>
                            <span class="text-[10px] text-white/35 tracking-[0.2em] uppercase font-bold">Families
                                served</span>
                        </div>
                        <div>
                            <b
                                class="text-4xl md:text-5xl font-extrabold text-brand-orange block leading-none mb-2">148kg</b>
                            <span class="text-[10px] text-white/35 tracking-[0.2em] uppercase font-bold">Fried every
                                morning</span>
                        </div>
                        <div>
                            <b
                                class="text-4xl md:text-5xl font-extrabold text-brand-orange block leading-none mb-2">4.9★</b>
                            <span class="text-[10px] text-white/35 tracking-[0.2em] uppercase font-bold">Average
                                rating</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Image -->
            <div
                class="rounded-3xl overflow-hidden bg-white/5 border border-white/10 min-h-[400px] md:min-h-[520px] flex items-center justify-center relative shadow-2xl">
                <?php
                // FIX: Safe access now that $story is guaranteed to be an array
                $story_image = $story['image'] ?? '';
                $image_url = !empty($story_image) ? $story_image : get_template_directory_uri() . '/assets/images/kitchen.png';
                $image_path_exists = !empty($story_image) || file_exists(get_template_directory() . '/assets/images/kitchen.png');
                ?>
                <?php if ($image_path_exists): ?>
                    <img src="<?php echo esc_url($image_url); ?>" class="w-full h-full object-cover absolute inset-0"
                        alt="Our Kitchen" loading="lazy">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-brand-ink/70 via-transparent to-transparent pointer-events-none">
                    </div>
                <?php else: ?>
                    <div class="flex flex-col items-center justify-center gap-3 text-white/30 p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2" />
                            <path d="M7 2v20" />
                            <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7" />
                        </svg>
                        <span class="text-sm font-medium">Our Kitchen &mdash; Photo Coming Soon</span>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <!-- Reviews Section -->
    <section class="home-section bg-brand-bg2">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-7 md:mb-10 gap-3 md:gap-4">
                <div>
                    <span class="section-label">Customer reviews</span>
                    <h2 class="section-heading">What our customers say</h2>
                </div>
                <div class="text-[13px] text-[#777]">⭐ <b class="text-[#111]">4.9</b> from 2,847 reviews</div>
            </div>

            <!-- Mobile: horizontal scroll | Desktop: 3-col grid -->
            <div
                class="-mx-6 px-6 md:mx-0 md:px-0 flex gap-4 overflow-x-auto pb-4 no-scrollbar md:grid md:grid-cols-3 md:gap-6 md:overflow-visible">
                <?php
                $reviews = function_exists('get_field') ? get_field('reviews') : null;
                if (!empty($reviews)):
                    foreach ($reviews as $rev): ?>
                        <div
                            class="bg-white rounded-xl p-6 border border-brand-line shrink-0 w-[80vw] md:w-auto flex flex-col shadow-sm">
                            <div class="text-brand-orange text-sm tracking-widest mb-3">
                                <?php echo str_repeat('★', intval($rev['stars'] ?? 5)); ?>
                            </div>
                            <p class="text-sm text-brand-ink2 leading-relaxed mb-5 italic flex-1">"
                                <?php echo esc_html($rev['text']); ?>"
                            </p>
                            <div class="flex items-center gap-2.5 border-t border-brand-line pt-3.5">
                                <div
                                    class="w-9 h-9 rounded-full bg-brand-orange-light flex items-center justify-center text-[13px] font-bold text-brand-orange shrink-0">
                                    <?php echo esc_html($rev['initials'] ?? 'G'); ?>
                                </div>
                                <div>
                                    <b class="text-[13px] block">
                                        <?php echo esc_html($rev['name']); ?>
                                    </b>
                                    <span class="text-[11px] text-brand-ink3">
                                        <?php echo esc_html($rev['location']); ?> · Verified buyer
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                else: // Static fallback reviews — always shown when ACF not installed ?>

                    <div
                        class="bg-white rounded-xl p-6 border border-brand-line shrink-0 w-[80vw] md:w-auto flex flex-col shadow-sm">
                        <div class="text-brand-orange text-sm tracking-widest mb-3">★★★★★</div>
                        <p class="text-sm text-brand-ink2 leading-relaxed mb-5 italic flex-1">"The Ratlami sev tastes
                            exactly like what my dad used to bring from Indore in the 90s. Nothing comes close. Will keep
                            ordering forever."</p>
                        <div class="flex items-center gap-2.5 border-t border-brand-line pt-3.5">
                            <div
                                class="w-9 h-9 rounded-full bg-brand-orange-light flex items-center justify-center text-[13px] font-bold text-brand-orange shrink-0">
                                PK</div>
                            <div>
                                <b class="text-[13px] block">Priya Kulkarni</b>
                                <span class="text-[11px] text-brand-ink3">Mumbai · Verified buyer</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-xl p-6 border border-brand-line shrink-0 w-[80vw] md:w-auto flex flex-col shadow-sm">
                        <div class="text-brand-orange text-sm tracking-widest mb-3">★★★★★</div>
                        <p class="text-sm text-brand-ink2 leading-relaxed mb-5 italic flex-1">"Ordered the Diwali gift box
                            for 14 relatives. Every single one called to say thank you. The packaging is lovely and the
                            namkeen is superb."</p>
                        <div class="flex items-center gap-2.5 border-t border-brand-line pt-3.5">
                            <div
                                class="w-9 h-9 rounded-full bg-brand-orange-light flex items-center justify-center text-[13px] font-bold text-brand-orange shrink-0">
                                AS</div>
                            <div>
                                <b class="text-[13px] block">Arjun Shah</b>
                                <span class="text-[11px] text-brand-ink3">Bengaluru · Verified buyer</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-xl p-6 border border-brand-line shrink-0 w-[80vw] md:w-auto flex flex-col shadow-sm">
                        <div class="text-brand-orange text-sm tracking-widest mb-3">★★★★★</div>
                        <p class="text-sm text-brand-ink2 leading-relaxed mb-5 italic flex-1">"Crunch is unreal — you can
                            tell it's fried fresh. The masala balance is perfect, not too hot, not bland. Delivery was fast
                            too!"</p>
                        <div class="flex items-center gap-2.5 border-t border-brand-line pt-3.5">
                            <div
                                class="w-9 h-9 rounded-full bg-brand-orange-light flex items-center justify-center text-[13px] font-bold text-brand-orange shrink-0">
                                NR</div>
                            <div>
                                <b class="text-[13px] block">Neha Rao</b>
                                <span class="text-[11px] text-brand-ink3">Hyderabad · Verified buyer</span>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();