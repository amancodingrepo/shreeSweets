<?php
/**
 * The Template for displaying product archives, including the main shop page
 * Matches the screenshot with sidebar filters and 3-column product grid
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>

<style>
/* Custom range slider styling */
.price-range-slider {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 6px;
    border-radius: 999px;
    background: linear-gradient(to right, #F4821F 0%, #F4821F 50%, #e5e7eb 50%, #e5e7eb 100%);
    outline: none;
}
.price-range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #F4821F;
    cursor: pointer;
    border: 3px solid white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}
.price-range-slider::-moz-range-thumb {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #F4821F;
    cursor: pointer;
    border: 3px solid white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

/* Sort dropdown styling */
.shop-sort-select {
    padding: 10px 40px 10px 16px !important;
    font-size: 14px !important;
    color: #333 !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 8px !important;
    outline: none !important;
    appearance: none !important;
    -moz-appearance: none !important;
    -webkit-appearance: none !important;
    background-color: white !important;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 12px center !important;
    background-size: 16px !important;
    cursor: pointer !important;
    min-width: 160px;
}
.shop-sort-select:focus {
    border-color: #F4821F !important;
    box-shadow: 0 0 0 3px rgba(244, 130, 31, 0.1) !important;
}

/* Hide default WooCommerce ordering */
form.woocommerce-ordering {
    display: none;
}

/* Product grid 3 columns */
.products {
    display: grid !important;
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 24px !important;
}
@media (max-width: 1024px) {
    .products {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }
}
@media (max-width: 640px) {
    .products {
        grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
    }
}

/* Checkbox styling */
.filter-checkbox {
    appearance: none;
    -webkit-appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #e5e7eb;
    border-radius: 4px;
    cursor: pointer;
    position: relative;
    transition: all 0.15s ease;
    flex-shrink: 0;
}
.filter-checkbox:checked {
    background-color: #F4821F;
    border-color: #F4821F;
}
.filter-checkbox:checked::after {
    content: '';
    position: absolute;
    left: 5px;
    top: 2px;
    width: 5px;
    height: 9px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}
.filter-checkbox:hover {
    border-color: #F4821F;
}
</style>

<div class="min-h-screen bg-white">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-16 py-6 lg:py-10">
        
        <!-- Mobile Filter Toggle -->
        <div class="lg:hidden mb-4">
            <button onclick="document.getElementById('mobile-filters').classList.toggle('hidden')" 
                    class="flex items-center gap-2 py-2.5 px-4 border border-brand-line rounded-lg text-[14px] font-medium text-[#333] hover:border-brand-orange transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Filters
            </button>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-[260px_1fr] gap-8 lg:gap-10">

            <!-- Sidebar Filters -->
            <aside id="mobile-filters" class="hidden lg:block bg-white lg:bg-transparent p-5 lg:p-0 rounded-xl lg:rounded-none border lg:border-0 border-brand-line mb-4 lg:mb-0">
                <div class="sticky top-24">
                    
                    <!-- Category Filter -->
                    <div class="mb-8">
                        <h3 class="text-[15px] font-bold text-[#111] mb-5">Category</h3>
                        <div class="space-y-3">
                            <?php
                            $product_categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                            ));
                            $current_cat = get_queried_object();
                            foreach ($product_categories as $cat):
                                if ($cat->slug === 'uncategorized') continue;
                                $is_current = (is_object($current_cat) && isset($current_cat->term_id) && $current_cat->term_id === $cat->term_id);
                            ?>
                                <label class="flex items-center justify-between cursor-pointer group">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" 
                                               class="filter-checkbox" 
                                               <?php echo $is_current ? 'checked' : ''; ?>
                                               onchange="window.location.href='<?php echo esc_url(get_term_link($cat)); ?>'">
                                        <span class="text-[14px] text-[#333] group-hover:text-brand-orange transition-colors"><?php echo esc_html($cat->name); ?></span>
                                    </div>
                                    <span class="text-[13px] text-[#999]"><?php echo $cat->count; ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-6"></div>

                    <!-- Price Range Filter -->
                    <div class="mb-8">
                        <h3 class="text-[15px] font-bold text-[#111] mb-5">Price range</h3>
                        <div class="px-1">
                            <input type="range" 
                                   min="99" 
                                   max="1499" 
                                   value="699"
                                   class="price-range-slider w-full" 
                                   id="price-range" />
                            <div class="flex justify-between mt-4 text-[13px] text-[#666]">
                                <span>₹99</span>
                                <span class="font-medium text-[#111]">₹699</span>
                                <span>₹1,499</span>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-6"></div>

                    <!-- Spice Level Filter -->
                    <div>
                        <h3 class="text-[15px] font-bold text-[#111] mb-5">Spice level</h3>
                        <div class="space-y-3">
                            <?php 
                            $spice_levels = [
                                ['name' => 'Mild', 'count' => 44],
                                ['name' => 'Medium', 'count' => 39],
                                ['name' => 'Hot', 'count' => 25],
                                ['name' => 'Extra Hot', 'count' => 46],
                            ];
                            foreach ($spice_levels as $index => $spice): 
                            ?>
                                <label class="flex items-center justify-between cursor-pointer group">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" 
                                               class="filter-checkbox"
                                               <?php echo $index === 1 ? 'checked' : ''; ?>>
                                        <span class="text-[14px] text-[#333] group-hover:text-brand-orange transition-colors"><?php echo esc_html($spice['name']); ?></span>
                                    </div>
                                    <span class="text-[13px] text-[#999]"><?php echo $spice['count']; ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <?php dynamic_sidebar( 'shop-sidebar' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </aside>

            <!-- Main Content -->
            <div>
                <!-- Header with count and sort -->
                <div class="flex items-center justify-between mb-6">
                    <div class="text-[14px] text-[#555]">
                        Showing <span class="font-semibold text-[#111]">1-8</span> of <span class="font-semibold text-[#111]"><?php echo wc_get_loop_prop( 'total' ) ?: '24'; ?></span> products
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <span class="text-[14px] text-[#555]">Sort:</span>
                        <select class="shop-sort-select" onchange="if(this.value) window.location.href=this.value;">
                            <option value="">Bestselling</option>
                            <option value="<?php echo esc_url(add_query_arg('orderby', 'popularity')); ?>">Popularity</option>
                            <option value="<?php echo esc_url(add_query_arg('orderby', 'date')); ?>">Latest</option>
                            <option value="<?php echo esc_url(add_query_arg('orderby', 'price')); ?>">Price: Low to High</option>
                            <option value="<?php echo esc_url(add_query_arg('orderby', 'price-desc')); ?>">Price: High to Low</option>
                            <option value="<?php echo esc_url(add_query_arg('orderby', 'rating')); ?>">Rating</option>
                        </select>
                    </div>
                </div>

                <!-- Product Grid -->
                <?php
                if ( woocommerce_product_loop() ) {
                    woocommerce_product_loop_start();

                    if ( wc_get_loop_prop( 'total' ) ) {
                        while ( have_posts() ) {
                            the_post();
                            do_action( 'woocommerce_shop_loop' );
                            wc_get_template_part( 'content', 'product' );
                        }
                    }

                    woocommerce_product_loop_end();

                    // Pagination
                    $total_pages = wc_get_loop_prop( 'total_pages' );
                    if ( $total_pages > 1 ) {
                        echo '<div class="flex items-center justify-center gap-2 mt-12">';
                        
                        $current_page = max( 1, get_query_var( 'paged' ) );
                        
                        // Previous button
                        if ( $current_page > 1 ) {
                            echo '<a href="' . esc_url( get_pagenum_link( $current_page - 1 ) ) . '" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-[#555] hover:border-brand-orange hover:text-brand-orange transition-colors">';
                            echo '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>';
                            echo '</a>';
                        }
                        
                        // Page numbers
                        for ( $i = 1; $i <= $total_pages; $i++ ) {
                            if ( $i === $current_page ) {
                                echo '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-brand-orange text-white font-bold text-[14px]">' . $i . '</span>';
                            } else {
                                echo '<a href="' . esc_url( get_pagenum_link( $i ) ) . '" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-[#555] font-medium text-[14px] hover:border-brand-orange hover:text-brand-orange transition-colors">' . $i . '</a>';
                            }
                        }
                        
                        // Next button
                        if ( $current_page < $total_pages ) {
                            echo '<a href="' . esc_url( get_pagenum_link( $current_page + 1 ) ) . '" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-[#555] hover:border-brand-orange hover:text-brand-orange transition-colors">';
                            echo '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
                            echo '</a>';
                        }
                        
                        echo '</div>';
                    }

                } else {
                    do_action( 'woocommerce_no_products_found' );
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
