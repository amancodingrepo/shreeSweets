<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 * This layout matches the custom React design and screenshot perfectly.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>

<script>
// Shop page JavaScript for product interactions
document.addEventListener('DOMContentLoaded', function() {
    // Card style toggle (detailed/minimal)
    const cardStyleButtons = document.querySelectorAll('[data-card-style]');
    const productGrid = document.querySelector('.products');

    if (cardStyleButtons.length > 0 && productGrid) {
        cardStyleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const style = this.getAttribute('data-card-style');
                cardStyleButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.className = 'shop-tweaks-button px-2.5 py-1.5 rounded-md text-[12px] font-medium border border-transparent transition-colors text-brand-ink hover:bg-gray-50'; // reset
                });
                this.className = 'shop-tweaks-button active px-2.5 py-1.5 rounded-md text-[12px] font-medium border border-brand-orange bg-brand-orange/5 text-brand-orange transition-colors';

                // Update all product cards
                const cards = productGrid.querySelectorAll('.product-card');
                cards.forEach(card => {
                    if (style === 'minimal') {
                        card.classList.add('minimal');
                    } else {
                        card.classList.remove('minimal');
                    }
                });
            });
        });
    }
});
</script>

<style>
/* Custom style to override WooCommerce default select orderby to match screenshot */
form.woocommerce-ordering select {
    padding: 8px 36px 8px 14px !important;
    font-size: 13px !important;
    color: #555 !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 8px !important;
    outline: none !important;
    appearance: none !important;
    -moz-appearance: none !important;
    -webkit-appearance: none !important;
    background-color: white !important;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 10px center !important;
    background-size: 14px !important;
    cursor: pointer !important;
}
form.woocommerce-ordering select:focus {
    border-color: #F4821F !important;
    box-shadow: 0 0 0 3px rgba(244, 130, 31, 0.1) !important;
}
</style>

<div class="min-h-screen bg-[#f9fafb]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-16">
        <div class="animate-in fade-in duration-500 grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-8 lg:gap-12">

            <!-- Breadcrumbs -->
            <div class="lg:col-span-2 mb-2">
                <nav class="flex text-[12.5px] text-[#888] items-center gap-2" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-brand-orange transition-colors font-medium text-[#555]">Home</a>
                    <span>/</span>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="hover:text-brand-orange transition-colors font-medium text-[#555]">Shop</a>
                    <?php if ( ! is_shop() ) : ?>
                        <span>/</span>
                        <span class="text-[#1A1A1A] font-semibold"><?php woocommerce_page_title(); ?></span>
                    <?php endif; ?>
                </nav>
            </div>

            <!-- Header with Controls -->
            <div class="lg:col-span-2 mb-2">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">
                    <div>
                        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#1A1A1A] mb-1.5 leading-tight"><?php woocommerce_page_title(); ?></h1>
                        <p class="text-[#555] text-[13.5px]">Discover our authentic specialties, freshly made every morning</p>
                    </div>

                    <!-- Card style toggle -->
                    <div class="shop-tweaks bg-white border border-gray-200 px-3 py-1.5 rounded-[10px] flex items-center gap-3 shadow-sm h-[40px]">
                        <span class="font-semibold text-[#555] text-[12.5px] pl-1">View:</span>
                        <div class="flex gap-1 items-center">
                            <button data-card-style="detailed" class="shop-tweaks-button active px-3 py-1 rounded-md text-[12px] font-semibold border border-brand-orange bg-brand-orange/5 text-brand-orange transition-colors shadow-sm">Detailed</button>
                            <button data-card-style="minimal" class="shop-tweaks-button px-3 py-1 rounded-md text-[12px] font-medium border border-transparent transition-colors text-[#555] hover:bg-gray-50">Compact</button>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="text-[#888] text-[13px]">
                            <?php woocommerce_result_count(); ?>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="text-[12.5px] font-medium text-[#555] hidden sm:block">Sort:</span>
                            <?php woocommerce_catalog_ordering(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters Sidebar -->
            <aside class="hidden lg:block">
                <div class="sticky top-28 bg-white rounded-2xl border border-brand-line p-8 shadow-[0_1px_4px_rgba(0,0,0,0.05)]">
                    
                    <!-- Categories Filter -->
                    <div class="mb-10 pb-8 border-b border-brand-line/60">
                        <h4 class="text-[11px] font-bold text-brand-ink mb-6 tracking-[0.15em] uppercase">Browse Categories</h4>
                        <div class="flex flex-col gap-2">
                            <?php
                            $product_categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                            ));
                            foreach ($product_categories as $cat):
                                if ($cat->slug === 'uncategorized') continue; ?>
                                <a href="<?php echo get_term_link($cat); ?>"
                                   class="flex items-center justify-between py-2.5 px-4 rounded-xl text-[13px] font-medium transition-all duration-200 border border-transparent hover:bg-brand-orange-light hover:text-brand-orange hover:border-brand-orange/10 group">
                                    <span><?php echo esc_html($cat->name); ?></span>
                                    <span class="text-[10px] bg-brand-bg2 text-brand-ink3 px-2 py-0.5 rounded-full group-hover:bg-white transition-colors"><?php echo $cat->count; ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="mb-10 pb-8 border-b border-brand-line/60">
                        <h4 class="text-[11px] font-bold text-brand-ink mb-6 tracking-[0.15em] uppercase">Price Range</h4>
                        <div class="px-1">
                            <input type="range" min="99" max="1499" value="699"
                                class="w-full h-1.5 bg-brand-bg2 rounded-lg appearance-none cursor-pointer accent-brand-orange" />
                            <div class="flex justify-between mt-4 text-[11px] font-bold text-brand-ink3">
                                <span>₹99</span>
                                <span class="text-brand-ink">₹699</span>
                                <span>₹1,499</span>
                            </div>
                        </div>
                    </div>

                    <!-- Spice Level Filter -->
                    <div>
                        <h4 class="text-[11px] font-bold text-brand-ink mb-6 tracking-[0.15em] uppercase">Spice Level</h4>
                        <div class="space-y-4">
                            <?php foreach (['Mild', 'Indori Special', 'Hot & Spicy'] as $s): ?>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative flex items-center justify-center">
                                        <input type="checkbox" class="peer appearance-none w-5 h-5 border-[1.5px] border-brand-line rounded-md checked:bg-brand-orange checked:border-brand-orange transition-all cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="absolute opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    </div>
                                    <span class="text-[14px] text-brand-ink2 group-hover:text-brand-orange transition-colors"><?php echo esc_html($s); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
                        <div class="mt-10 pt-8 border-t border-brand-line/60">
                            <?php dynamic_sidebar( 'shop-sidebar' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </aside>

            <!-- Main Content Grid -->
            <div class="md:-mt-[60px] lg:-mt-0">
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

                    // Dynamic WooCommerce Pagination correctly styled
                    $pagination = paginate_links( array(
                        'base'      => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                        'format'    => '',
                        'add_args'  => false,
                        'current'   => max( 1, get_query_var( 'paged' ) ),
                        'total'     => wc_get_loop_prop( 'total_pages' ),
                        'prev_text' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>',
                        'next_text' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>',
                        'type'      => 'array',
                        'end_size'  => 3,
                        'mid_size'  => 3,
                    ) );

                    if ( is_array( $pagination ) ) {
                        echo '<div class="shop-pagination mt-14 flex items-center justify-center gap-2.5">';
                        foreach ( $pagination as $page ) {
                            // Style injection
                            if ( strpos( $page, 'current' ) !== false ) {
                                // Active page
                                $page = str_replace( 'page-numbers current', 'w-10 h-10 flex items-center justify-center rounded-lg border-2 border-brand-orange bg-brand-orange text-white font-bold text-[14px] shadow-sm', $page );
                            } else {
                                // Standard / Next / Prev
                                $page = str_replace( 'page-numbers', 'w-10 h-10 flex items-center justify-center rounded-lg border-2 border-gray-200 text-[#555] font-semibold text-[14px] bg-white transition-colors hover:border-brand-orange hover:text-brand-orange', $page );
                            }
                            echo $page;
                        }
                        echo '</div>';
                    }

                } else {
                    do_action( 'woocommerce_no_products_found' );
                }
                ?>
                
                <!-- Our Complete Range Info -->
                <div class="mt-16 bg-white border border-gray-200 rounded-xl p-8 lg:p-10 shadow-sm animate-in fade-in duration-500">
                    <h3 class="font-serif text-2xl font-bold text-brand-ink mb-6 text-center">Our Complete Range</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="font-bold text-[13px] text-brand-orange uppercase tracking-wider mb-2">Sweets (Mithai)</h4>
                            <p class="text-[13.5px] text-[#555] leading-[1.8]">Kaju Katli, Doodh Katli, Mathura Peda, Kesar Peda, Milk Cake, Malai Doda, Khopra Barfi, Gup Chup, Malai Barfi, Kala Jamun, Kalakand, Bengali Sweets, Dry Fruit Sweets, Mava Patisa, and Gulab Jamun.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-[13px] text-brand-orange uppercase tracking-wider mb-2">Namkeen (Savories)</h4>
                            <p class="text-[13.5px] text-[#555] leading-[1.8]">Indori Poha Mixture Namkeen, Ratlami Sev, Khatta Meetha Mixture, Chakli, Dry Fruit Mixture, and Indori Charkha Mixture.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-[13px] text-brand-orange uppercase tracking-wider mb-2">Bakery & Cookies</h4>
                            <p class="text-[13.5px] text-[#555] leading-[1.8]">Nan Khatai, Ajwain Cookies, Jeera Cookies, Mawa Cookies, Kashmiri Cookies, Choco Chips Cookies, Gems Cookies, Kesar Pista Cookies, Cake Rusk, Aata Toast, Sweet Toast, Khari, and Pastries.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-[13px] text-brand-orange uppercase tracking-wider mb-2">Fast Food & Snacks</h4>
                            <p class="text-[13.5px] text-[#555] leading-[1.8]">Poha, Jalebi, Imarti, Kachori, Khandvi, and Shikanji.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
