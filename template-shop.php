<?php
/**
 * Template Name: Shop Page
 * The template for displaying shop page (Converted from Shop.tsx)
 */
get_header();
?>



<div class="min-h-screen bg-[#fafafa]">
    <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 py-10 md:py-16 pb-24">

        <!-- Breadcrumbs -->
        <nav class="flex text-[12px] text-[#888] mb-10" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"
                class="hover:text-brand-orange transition-colors">Home</a>
            <span class="mx-2">/</span>
            <span class="text-[#111] font-medium"><?php post_type_archive_title(); ?></span>
        </nav>

        <!-- Page Header -->
        <div class="mb-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-8">
                <div class="max-w-[700px]">
                    <span class="section-label">Authentic Indori</span>
                    <h1 class="section-heading mt-3"><?php post_type_archive_title(); ?></h1>
                    <p class="text-[15px] text-[#777] mt-3 leading-relaxed">Discover our authentic Indori specialties,
                        freshly made every morning with traditional recipes and the finest ingredients.</p>
                </div>


            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-12 items-start">

            <!-- Sidebar -->
            <aside id="shop-sidebar-container" class="hidden lg:block">
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
                                <span class="text-brand-ink">Under ₹699</span>
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

            <!-- Main Content -->
            <div class="min-w-0">
                <div id="product-grid" class="animate-in fade-in slide-in-from-bottom-4 duration-700">
                    <?php
                    if (woocommerce_product_loop()) {
                        woocommerce_product_loop_start();
                        while (have_posts()) {
                            the_post();
                            wc_get_template_part('content', 'product');
                        }
                        woocommerce_product_loop_end();
                    } else {
                        woocommerce_no_products_found();
                    }
                    ?>
                </div>

                <!-- Pagination -->
                <?php if ($wp_query->max_num_pages > 1): ?>
                    <div class="flex items-center justify-center gap-2 mt-20 pt-10 border-t border-[#eee]">
                        <button
                            class="w-11 h-11 flex items-center justify-center rounded-xl border border-[#eee] bg-white text-[#777] hover:border-brand-orange hover:text-brand-orange transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            class="w-11 h-11 flex items-center justify-center rounded-xl bg-brand-orange text-white font-bold text-[14px] shadow-lg shadow-brand-orange/20">1</button>
                        <button
                            class="w-11 h-11 flex items-center justify-center rounded-xl border border-[#eee] bg-white text-[#555] font-bold text-[14px] hover:border-brand-orange hover:text-brand-orange transition-all">2</button>
                        <button
                            class="w-11 h-11 flex items-center justify-center rounded-xl border border-[#eee] bg-white text-[#777] hover:border-brand-orange hover:text-brand-orange transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



<?php
get_footer();
