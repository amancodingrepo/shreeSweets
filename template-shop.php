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
        height: calc(100vh - 200px);
        min-height: 500px;
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

        #shop-sidebar-inner.mobile-open {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 200;
            border-radius: 0;
            overflow-y: auto;
            padding: 1.5rem;
            margin: 0;
        }
    }

    /* Active filter pill */
    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 600;
        background: #FEF3E8;
        color: #F4821F;
        border: 1px solid #F4821F33;
        cursor: pointer;
        transition: all 0.15s;
    }
    .filter-pill:hover {
        background: #F4821F;
        color: white;
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
        <div class="flex items-center justify-between mb-4">
            <p class="text-[13px] text-[#888]">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
                $filter_args = array(
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
                $max_price_val = isset($_GET['max_price']) ? intval($_GET['max_price']) : 0;
                if ($max_price_val > 0) {
                    $filter_args['meta_query'][] = array(
                        'key'     => '_price',
                        'value'   => $max_price_val,
                        'compare' => '<=',
                        'type'    => 'NUMERIC',
                    );
                }
                $spice_levels = isset($_GET['spice_level']) ? (array) $_GET['spice_level'] : array();
                $spice_levels = array_map('sanitize_text_field', $spice_levels);
                if (!empty($spice_levels)) {
                    $filter_args['tax_query'][] = array(
                        'taxonomy' => 'pa_spice-level',
                        'field'    => 'slug',
                        'terms'    => $spice_levels,
                    );
                }
                $temp_query = new WP_Query($filter_args);
                $total = $temp_query->found_posts;
                $per = (int) get_option('posts_per_page', 12);
                $cur = max(1, get_query_var('paged'));
                $from = ($cur - 1) * $per + 1;
                $to = min($cur * $per, $total);
                if ($total > 0) {
                    echo "Showing <b class='text-[#111]'>{$from}&#8211;{$to}</b> of <b class='text-[#111]'>{$total}</b> products";
                } else {
                    echo "No products found";
                }
                ?>
            </p>
            <div class="flex items-center gap-3">
                <button type="button" id="mobile-filter-toggle" class="lg:hidden flex items-center gap-1.5 py-2 px-4 border border-brand-line rounded-lg text-[12px] font-semibold text-brand-ink hover:border-brand-orange hover:text-brand-orange transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filters
                </button>
                <?php woocommerce_catalog_ordering(); ?>
            </div>
        </div>

        <!-- Active filter pills -->
        <?php if ($max_price_val > 0 || !empty($spice_levels)): ?>
        <div class="flex flex-wrap items-center gap-2 mb-4">
            <span class="text-[11px] font-semibold text-brand-ink3 uppercase tracking-wider">Active filters:</span>
            <?php if ($max_price_val > 0): ?>
                <a href="<?php echo esc_url(remove_query_arg('max_price')); ?>" class="filter-pill">Under &#8377;<?php echo esc_html($max_price_val); ?> &times;</a>
            <?php endif; ?>
            <?php foreach ($spice_levels as $sl): ?>
                <a href="<?php echo esc_url(remove_query_arg(array('spice_level', $sl), add_query_arg('spice_level', array_diff($spice_levels, array($sl))))); ?>" class="filter-pill"><?php echo esc_html(ucfirst(str_replace('-', ' ', $sl))); ?> &times;</a>
            <?php endforeach; ?>
            <a href="<?php echo esc_url(remove_query_arg(array('max_price', 'spice_level'))); ?>" class="text-[11px] font-semibold text-brand-red hover:underline ml-1">Clear all</a>
        </div>
        <?php endif; ?>

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

                <!-- Price Range -->
                <div class="mb-10 pb-8 border-b border-brand-line/60">
                    <h4 class="text-[11px] font-bold text-brand-ink mb-6 tracking-[0.15em] uppercase">Price Range</h4>
                    <div class="px-1">
                        <input type="range" id="price-range" min="99" max="1499" value="<?php echo esc_attr($max_price_val > 0 ? $max_price_val : 1499); ?>" step="50"
                            class="w-full h-1.5 bg-brand-bg2 rounded-lg appearance-none cursor-pointer accent-brand-orange" />
                        <div class="flex justify-between mt-4 text-[11px] font-bold text-brand-ink3">
                            <span>&#8377;99</span>
                            <span id="price-range-label" class="text-brand-ink">Under &#8377;<?php echo esc_html($max_price_val > 0 ? $max_price_val : 1499); ?></span>
                            <span>&#8377;1,499</span>
                        </div>
                    </div>
                </div>

                <!-- Spice Level -->
                <div>
                    <h4 class="text-[11px] font-bold text-brand-ink mb-6 tracking-[0.15em] uppercase">Spice Level</h4>
                    <div class="space-y-4">
                        <?php
                        $spice_options = array('mild' => 'Mild', 'indori-special' => 'Indori Special', 'hot-spicy' => 'Hot & Spicy');
                        foreach ($spice_options as $slug => $label): ?>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative flex items-center justify-center">
                                    <input type="checkbox" name="spice_level[]" value="<?php echo esc_attr($slug); ?>"
                                        <?php echo in_array($slug, $spice_levels) ? 'checked' : ''; ?>
                                        class="spice-checkbox peer appearance-none w-5 h-5 border-[1.5px] border-brand-line
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
                                    <?php echo esc_html($label); ?>
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
                    if ($max_price_val > 0) {
                        $args['meta_query'][] = array(
                            'key'     => '_price',
                            'value'   => $max_price_val,
                            'compare' => '<=',
                            'type'    => 'NUMERIC',
                        );
                    }
                    if (!empty($spice_levels)) {
                        $args['tax_query'][] = array(
                            'taxonomy' => 'pa_spice-level',
                            'field'    => 'slug',
                            'terms'    => $spice_levels,
                        );
                    }
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Price range slider
    var priceRange = document.getElementById('price-range');
    var priceLabel = document.getElementById('price-range-label');
    var priceTimeout;

    if (priceRange) {
        priceRange.addEventListener('input', function() {
            var val = this.value;
            if (priceLabel) {
                priceLabel.textContent = 'Under \u20B9' + val;
            }
            clearTimeout(priceTimeout);
            priceTimeout = setTimeout(function() {
                var url = new URL(window.location.href);
                if (parseInt(val) >= 1499) {
                    url.searchParams.delete('max_price');
                } else {
                    url.searchParams.set('max_price', val);
                }
                url.searchParams.delete('paged');
                window.location.href = url.toString();
            }, 600);
        });
    }

    // Spice level checkboxes
    var spiceCheckboxes = document.querySelectorAll('.spice-checkbox');
    spiceCheckboxes.forEach(function(cb) {
        cb.addEventListener('change', function() {
            var url = new URL(window.location.href);
            url.searchParams.delete('spice_level');
            spiceCheckboxes.forEach(function(box) {
                if (box.checked) {
                    url.searchParams.append('spice_level', box.value);
                }
            });
            url.searchParams.delete('paged');
            window.location.href = url.toString();
        });
    });

    // Mobile filter toggle
    var filterToggle = document.getElementById('mobile-filter-toggle');
    var sidebar = document.getElementById('shop-sidebar-inner');
    if (filterToggle && sidebar) {
        filterToggle.addEventListener('click', function() {
            sidebar.classList.toggle('mobile-open');
            if (sidebar.classList.contains('mobile-open')) {
                // Add close button at top
                var closeBtn = document.createElement('button');
                closeBtn.id = 'mobile-filter-close';
                closeBtn.className = 'flex items-center gap-2 mb-4 text-sm font-semibold text-brand-ink hover:text-brand-orange transition-colors';
                closeBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg> Close Filters';
                closeBtn.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-open');
                    closeBtn.remove();
                });
                sidebar.insertBefore(closeBtn, sidebar.firstChild);
            } else {
                var closeBtn = document.getElementById('mobile-filter-close');
                if (closeBtn) closeBtn.remove();
            }
        });
    }
});
</script>

<?php get_footer(); ?>