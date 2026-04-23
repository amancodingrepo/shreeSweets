<?php
/**
 * Template Name: Shop Page
 * The template for displaying shop page (Converted from Shop.tsx)
 */
get_header();
?>

<style>
    /* ── PRODUCT GRID OVERRIDE ── */
    body ul.products,
    body ul.products.columns-3,
    body ul.products.columns-4,
    body.woocommerce ul.products,
    body.woocommerce-page ul.products {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1rem !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
        float: none !important;
        width: 100% !important;
        clear: both !important;
    }

    body ul.products li.product,
    body ul.products li.product-category {
        width: 100% !important;
        float: none !important;
        margin: 0 !important;
        padding: 0 !important;
        clear: none !important;
    }

    @media (min-width: 900px) {

        body ul.products,
        body.woocommerce ul.products,
        body.woocommerce-page ul.products {
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 1.25rem !important;
        }
    }

    /* ── GHOST REMOVAL ── */
    /* Kill any direct child that isn't an <li> (scripts, styles, inputs, etc.) */
    ul.products>*:not(li) {
        display: none !important;
    }

    /* Fallback for older browsers or specific ghost types */
    ul.products li.product:empty {
        display: none !important;
    }

    /* ── TWO-PANEL LAYOUT ── */
    #shop-layout {
        display: flex;
        gap: 2.5rem;
        height: calc(100vh - 260px);
        min-height: 600px;
        overflow: hidden;
    }

    #shop-sidebar-inner {
        width: 280px;
        flex-shrink: 0;
        height: 100%;
        overflow-y: auto;
        padding-right: 10px;
        /* Space for scrollbar */
    }

    #shop-main-panel {
        flex: 1;
        height: 100%;
        overflow-y: auto;
        min-width: 0;
        padding-right: 10px;
        /* Space for scrollbar */
    }

    /* Custom scrollbars */
    #shop-sidebar-inner::-webkit-scrollbar,
    #shop-main-panel::-webkit-scrollbar {
        width: 3px;
    }

    #shop-sidebar-inner::-webkit-scrollbar-thumb,
    #shop-main-panel::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 9999px;
    }

    #shop-sidebar-inner::-webkit-scrollbar-track,
    #shop-main-panel::-webkit-scrollbar-track {
        background: transparent;
    }

    @media (max-width: 1024px) {
        #shop-layout {
            height: auto;
            overflow: visible;
            display: block;
        }

        #shop-main-panel {
            height: auto;
            overflow: visible;
        }

        #shop-sidebar-inner {
            display: none;
        }
    }

    /* ── PAGINATION STYLING ── */
    .shop-pagination-list {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .shop-pagination-list li a,
    .shop-pagination-list li span {
        width: 2.75rem;
        height: 2.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.75rem;
        border: 1px solid #eee;
        background: white;
        color: #555;
        font-weight: bold;
        font-size: 14px;
        transition: all 0.2s;
        text-decoration: none;
    }

    .shop-pagination-list li span.current {
        background: #F4821F;
        color: white;
        border-color: #F4821F;
        box-shadow: 0 4px 12px rgba(244, 130, 31, 0.2);
    }

    .shop-pagination-list li a:hover {
        border-color: #F4821F;
        color: #F4821F;
    }
</style>

<div class="min-h-screen bg-[#fafafa]">
    <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 py-10 md:pt-16 md:pb-6">

        <!-- Breadcrumbs & Header -->
        <div class="mb-8">
            <nav class="flex text-[12px] text-[#888] mb-6" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                    class="hover:text-brand-orange transition-colors">Home</a>
                <span class="mx-2">/</span>
                <span class="text-[#111] font-medium">Shop</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div class="max-w-[700px]">
                    <span class="section-label">Authentic Indori</span>
                    <h1 class="section-heading mt-2">Shop</h1>
                    <p class="text-[15px] text-[#777] mt-3 leading-relaxed">
                        Discover our authentic Indori specialties, freshly made every morning with
                        traditional recipes and the finest ingredients.
                    </p>
                </div>
            </div>
        </div>

        <!-- Sort bar — OUTSIDE scroll panels so it never gets clipped -->
        <div class="flex items-center justify-between mb-6">
            <p class="text-[13px] text-[#888]">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => array('exclude-from-catalog', 'exclude-from-search'),
                            'operator' => 'NOT IN',
                        ),
                    ),
                );
                $temp_query = new WP_Query($args);
                $total = $temp_query->found_posts;
                $per = (int) get_option('posts_per_page', 12);
                $cur = max(1, get_query_var('paged'));
                $from = ($cur - 1) * $per + 1;
                $to = min($cur * $per, $total);
                if ($total > 0) {
                    echo "Showing <b class='text-[#111]'>{$from}&#8211;{$to}</b> of <b class='text-[#111]'>{$total}</b> products";
                }
                ?>
            </p>
            <?php woocommerce_catalog_ordering(); ?>
        </div>

        <!-- TWO-PANEL LAYOUT -->
        <div id="shop-layout">

            <!-- SIDEBAR -->
            <div id="shop-sidebar-inner"
                class="bg-white rounded-2xl border border-brand-line p-8 shadow-[0_1px_4px_rgba(0,0,0,0.05)]">

                <!-- Categories -->
                <div class="mb-10 pb-8 border-b border-brand-line/60">
                    <h4 class="text-[11px] font-bold text-brand-ink mb-6 tracking-[0.15em] uppercase">Browse Categories
                    </h4>
                    <div class="flex flex-col gap-2">
                        <?php
                        $cats = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => true));
                        if (!empty($cats) && !is_wp_error($cats)):
                            foreach ($cats as $cat):
                                if ($cat->slug === 'uncategorized')
                                    continue; ?>
                                <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                                    class="flex items-center justify-between py-2.5 px-4 rounded-xl text-[13px] font-medium
                                          transition-all duration-200 border border-transparent
                                          hover:bg-brand-orange-light hover:text-brand-orange hover:border-brand-orange/10 group">
                                    <span><?php echo esc_html($cat->name); ?></span>
                                    <span
                                        class="text-[10px] bg-brand-bg2 text-brand-ink3 px-2 py-0.5 rounded-full group-hover:bg-white transition-colors">
                                        <?php echo esc_html($cat->count); ?>
                                    </span>
                                </a>
                            <?php endforeach;
                        endif; ?>
                    </div>
                </div>

                <!-- Price Range (Static UI) -->
                <div class="mb-10 pb-8 border-b border-brand-line/60">
                    <h4 class="text-[11px] font-bold text-brand-ink mb-6 tracking-[0.15em] uppercase">Price Range</h4>
                    <div class="px-1">
                        <input type="range" min="99" max="1499" value="699"
                            class="w-full h-1.5 bg-brand-bg2 rounded-lg appearance-none cursor-pointer accent-brand-orange" />
                        <div class="flex justify-between mt-4 text-[11px] font-bold text-brand-ink3">
                            <span>&#8377;99</span>
                            <span class="text-brand-ink">Under &#8377;699</span>
                            <span>&#8377;1,499</span>
                        </div>
                    </div>
                </div>

                <!-- Spice Level (Static UI) -->
                <div>
                    <h4 class="text-[11px] font-bold text-brand-ink mb-6 tracking-[0.15em] uppercase">Spice Level</h4>
                    <div class="space-y-4">
                        <?php foreach (['Mild', 'Indori Special', 'Hot & Spicy'] as $s): ?>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative flex items-center justify-center">
                                    <input type="checkbox" class="peer appearance-none w-5 h-5 border-[1.5px] border-brand-line
                                                  rounded-md checked:bg-brand-orange checked:border-brand-orange
                                                  transition-all cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                        fill="none" stroke="white" stroke-width="4" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="absolute opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                </div>
                                <span class="text-[14px] text-brand-ink2 group-hover:text-brand-orange transition-colors">
                                    <?php echo esc_html($s); ?>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (is_active_sidebar('shop-sidebar')): ?>
                    <div class="mt-10 pt-8 border-t border-brand-line/60">
                        <?php dynamic_sidebar('shop-sidebar'); ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- MAIN PRODUCT PANEL -->
            <div id="shop-main-panel">
                <ul class="products custom-product-grid">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
                    $args = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => get_option('posts_per_page', 12),
                        'paged' => $paged,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'name',
                                'terms'    => array('exclude-from-catalog', 'exclude-from-search'),
                                'operator' => 'NOT IN',
                            ),
                        ),
                    );
                    $products_query = new WP_Query($args);

                    if ($products_query->have_posts()):
                        while ($products_query->have_posts()):
                            $products_query->the_post();
                            global $product;
                            $product = wc_get_product( get_the_ID() );
                            wc_get_template_part('content', 'product');
                        endwhile;
                    else:
                        woocommerce_no_products_found();
                    endif;
                    wp_reset_postdata();
                    ?>
                </ul>

                <!-- Pagination -->
                <?php
                $maxpages = $products_query->max_num_pages ?? 1;
                $paged = max(1, get_query_var('paged'));
                if ($maxpages > 1): ?>
                    <div class="flex items-center justify-center gap-2 mt-16 pt-10 pb-10 border-t border-[#eee]">
                        <ul class="shop-pagination-list">
                            <?php if ($paged > 1): ?>
                                <li>
                                    <a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </a>
                                </li>
                            <?php endif;

                            for ($i = 1; $i <= $maxpages; $i++):
                                if ($i == $paged): ?>
                                    <li><span class="current"><?php echo $i; ?></span></li>
                                <?php else: ?>
                                    <li><a href="<?php echo esc_url(get_pagenum_link($i)); ?>"><?php echo $i; ?></a></li>
                                <?php endif;
                            endfor;

                            if ($paged < $maxpages): ?>
                                <li>
                                    <a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>