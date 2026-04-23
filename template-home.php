<?php
/**
 * Template Name: Custom Homepage
 * The template for displaying the front page (Converted from Home.tsx)
 */
get_header();
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var currentSlide = 0;
    var totalSlides = 3;
    var slidesContainer = document.getElementById('hero-slides');
    var dotsContainer = document.getElementById('hero-dots');
    
    function updateSlide() {
        if (slidesContainer) {
            slidesContainer.style.transform = 'translateX(-' + (currentSlide * 100) + '%)';
        }
        if (dotsContainer) {
            var dots = dotsContainer.querySelectorAll('.hero-dot');
            dots.forEach(function(dot, idx) {
                if (idx === currentSlide) {
                    dot.classList.add('w-[22px]', 'bg-brand-orange');
                    dot.classList.remove('w-2', 'hover:bg-brand-ink/40');
                } else {
                    dot.classList.remove('w-[22px]', 'bg-brand-orange');
                    dot.classList.add('w-2', 'hover:bg-brand-ink/40');
                }
            });
        }
    }
    
    window.heroGoToSlide = function(idx) {
        currentSlide = idx;
        updateSlide();
    };
    
    window.heroMoveSlide = function(dir) {
        currentSlide = (currentSlide + dir + totalSlides) % totalSlides;
        updateSlide();
    };
    
    setInterval(function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlide();
    }, 4500);
});
</script>

<main id="primary" class="site-main">



    <!-- Hero Banner with Slider -->
    <div class="relative bg-brand-bg2 overflow-hidden min-h-[280px] md:min-h-[380px] animate-slide-in-up" style="animation-delay: 0.2s; animation-fill-mode: both;">
        <div id="hero-slides" class="flex transition-transform duration-500 ease-in-out h-full">
        <?php 
        $has_slides = function_exists('have_rows') && have_rows('hero_slides');
        if($has_slides): 
            while(have_rows('hero_slides')) : the_row();
                $bg_gradient = (function_exists('get_sub_field') && get_sub_field('bg_gradient')) ?: 'from-[#FEF3E8] to-[#F4821F] via-[#FEF3E8] via-45%';
                $badge_color = (function_exists('get_sub_field') && get_sub_field('badge_color')) ?: 'bg-brand-orange';
                $title = function_exists('get_sub_field') ? get_sub_field('title') : '';
                $copy = function_exists('get_sub_field') ? get_sub_field('copy') : '';
                $btn_text = (function_exists('get_sub_field') && get_sub_field('primary_btn')) ?: 'Shop Now ›';
                $btn_link = (function_exists('get_sub_field') && get_sub_field('primary_link')) ?: '#';
                $image = function_exists('get_sub_field') ? get_sub_field('image') : '';
                $discount = function_exists('get_sub_field') ? get_sub_field('discount') : '';
        ?>
            <!-- Dynamic Slide -->
            <div class="min-w-full relative h-full min-h-[280px] md:min-h-[380px] flex items-center overflow-hidden shrink-0 py-8 md:py-12">
                <div class="absolute inset-0 bg-gradient-to-r <?php echo esc_attr($bg_gradient); ?>"></div>
                <div class="relative z-10 max-w-full mx-auto px-5 md:px-10 w-full flex items-center justify-between">
                    <div>
                        <?php if(get_sub_field('badge')): ?>
                        <div class="inline-block text-white text-[10px] font-bold tracking-[0.12em] uppercase py-1.5 px-3 rounded mb-3.5 <?php echo esc_attr($badge_color); ?>">
                            <?php the_sub_field('badge'); ?>
                        </div>
                        <?php endif; ?>
                        
                        <h1 class="font-serif text-[clamp(36px,4.5vw,58px)] font-bold leading-[1.1] text-brand-ink mb-3 max-w-[440px]">
                            <?php echo wp_kses_post($title); ?>
                        </h1>
                        <p class="text-sm text-brand-ink2 leading-relaxed max-w-[380px] mb-6">
                            <?php echo esc_html($copy); ?>
                        </p>
                        <div class="flex gap-3 flex-wrap">
                            <a href="<?php echo esc_url($btn_link); ?>" class="btn-primary text-sm"><?php echo esc_html($btn_text); ?></a>
                        </div>
                    </div>
                    <div class="relative w-[340px] shrink-0 flex items-center justify-center hidden md:flex">
                        <div class="w-[300px] h-[300px] rounded-full flex items-center justify-center relative shadow-lg bg-white/25">
                            <?php if($image): ?>
                                <img src="<?php echo esc_url($image); ?>" alt="Hero Image" class="w-full h-full object-contain absolute z-10 drop-shadow-2xl" loading="eager" fetchpriority="high">
                            <?php else: ?>
                                <div class="absolute inset-0 rounded-full flex items-center justify-center flex-col gap-2 p-5 text-center">
                                    <span class="text-[10px] tracking-widest uppercase text-white/70">No Image Uploaded</span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if($discount): ?>
                            <div class="absolute -top-2.5 -right-2.5 w-[88px] h-[88px] rounded-full bg-brand-red text-white flex flex-col items-center justify-center text-center -rotate-[8deg] shadow-[0_2px_12px_rgba(0,0,0,0.07)] z-20">
                                <b class="text-[26px] font-bold leading-none"><?php echo esc_html($discount); ?></b>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
            endwhile;
        else: // Fallback Static Content 
        ?>
            <!-- Slide 1 -->
            <div class="min-w-full relative h-full min-h-[280px] md:min-h-[380px] flex items-center overflow-hidden shrink-0 py-8 md:py-12">
                <div class="absolute inset-0 bg-gradient-to-r from-[#FEF3E8] to-[#F4821F] via-[#FEF3E8] via-45%"></div>
                <div class="relative z-10 max-w-full mx-auto px-5 md:px-10 w-full flex items-center justify-between">
                    <div>
                        <div class="inline-block text-white text-[10px] font-bold tracking-[0.12em] uppercase py-1.5 px-3 rounded mb-3.5 bg-brand-orange">
                            Diwali Special · Limited Edition
                        </div>
                        <h1 class="font-serif text-[clamp(32px,4vw,52px)] font-bold leading-[1.2] text-[#111] mb-3 max-w-[500px]">
                            Authentic Ratlami Sev
                            <span class="block text-[clamp(20px,2.5vw,32px)] font-semibold text-[#555] mt-1">from the heart of Indore</span>
                        </h1>
                        <p class="text-[16px] text-[#555] leading-relaxed max-w-[420px] mb-7">
                            Hand-crafted in small batches every morning. No preservatives. Packed fresh, delivered to your door.
                        </p>
                        <div class="flex gap-3 flex-wrap">
                    <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="btn-primary text-sm">Shop Now ›</a>
                    <a href="<?php echo esc_url( home_url( '/product/ratlami-sev/' ) ); ?>" class="btn-secondary text-sm ml-3">View Product</a>
                        </div>
                    </div>
                    <div class="relative w-[340px] shrink-0 flex items-center justify-center hidden md:flex">
                        <div class="w-[300px] h-[300px] rounded-full flex items-center justify-center relative shadow-lg bg-white/25">
                            <div class="absolute inset-0 rounded-full flex items-center justify-center flex-col gap-2 p-5 text-center">
                                <span class="text-[10px] tracking-widest uppercase text-white/70">hero-sev-bowl.png 600×600</span>
                            </div>
                            <div class="absolute -top-2.5 -right-2.5 w-[88px] h-[88px] rounded-full bg-brand-red text-white flex flex-col items-center justify-center text-center -rotate-[8deg] shadow-[0_2px_12px_rgba(0,0,0,0.07)]">
                                <b class="text-[26px] font-bold leading-none">40%</b>
                                <span class="text-[9px] font-semibold tracking-[0.1em] uppercase mt-0.5">OFF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="min-w-full relative h-full min-h-[280px] md:min-h-[380px] flex items-center overflow-hidden shrink-0 py-8 md:py-12">
                <div class="absolute inset-0 bg-gradient-to-r from-[#F2EBE0] to-[#C0392B] via-[#F2EBE0] via-45%"></div>
                <div class="relative z-10 max-w-full mx-auto px-5 md:px-10 w-full flex items-center justify-between">
                    <div>
                        <div class="inline-block text-white text-[10px] font-bold tracking-[0.12em] uppercase py-1.5 px-3 rounded mb-3.5 bg-brand-red">
                            Festive Gift Packs · Now Available
                        </div>
                        <h1 class="font-serif text-[clamp(32px,4vw,52px)] font-bold leading-[1.2] text-[#111] mb-3 max-w-[500px]">
                            Festive Gift Packs
                            <span class="block text-[clamp(20px,2.5vw,32px)] font-semibold text-[#555] mt-1">for every occasion</span>
                        </h1>
                        <p class="text-[16px] text-[#555] leading-relaxed max-w-[420px] mb-7">
                            Curated gift boxes with 6 varieties of namkeen and sweets. Perfect for family and friends.
                        </p>
                        <div class="flex gap-3 flex-wrap">
                            <a href="<?php echo esc_url( home_url( '/shop/?category=Gift+Packs' ) ); ?>" class="inline-flex items-center gap-2 py-2.5 px-5 bg-brand-red text-white rounded-full text-xs font-semibold transition-all hover:bg-[#a93226] hover:-translate-y-[1px]">Shop Gift Packs ›</a>
                        </div>
                    </div>
                    <div class="relative w-[340px] shrink-0 flex items-center justify-center hidden md:flex">
                        <div class="w-[300px] h-[300px] rounded-full flex items-center justify-center relative shadow-lg bg-white/20">
                            <div class="absolute inset-0 rounded-full flex items-center justify-center flex-col gap-2 p-5 text-center">
                                <span class="text-[10px] tracking-widest uppercase text-white/70">hero-giftbox.png 600×600</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="min-w-full relative h-full min-h-[280px] md:min-h-[380px] flex items-center overflow-hidden shrink-0 py-8 md:py-12">
                <div class="absolute inset-0 bg-gradient-to-r from-[#F8F3EC] to-[#27AE60] via-[#F8F3EC] via-45%"></div>
                <div class="relative z-10 max-w-full mx-auto px-5 md:px-10 w-full flex items-center justify-between">
                    <div>
                        <div class="inline-block text-white text-[10px] font-bold tracking-[0.12em] uppercase py-1.5 px-3 rounded mb-3.5 bg-brand-green">
                            New Arrival · Poha Chiwda
                        </div>
                        <h1 class="font-serif text-[clamp(32px,4vw,52px)] font-bold leading-[1.2] text-[#111] mb-3 max-w-[500px]">
                            Fresh Poha Chiwda
                            <span class="block text-[clamp(20px,2.5vw,32px)] font-semibold text-[#555] mt-1">Made with extra cashews</span>
                        </h1>
                        <p class="text-[16px] text-[#555] leading-relaxed max-w-[420px] mb-7">
                            The fan-favourite gets a cashew upgrade. Try the new recipe and tell us what you think.
                        </p>
                        <div class="flex gap-3 flex-wrap">
                            <a href="<?php echo esc_url( home_url( '/product/poha-chiwda/' ) ); ?>" class="inline-flex items-center gap-2 py-2.5 px-5 bg-brand-green text-white rounded-full text-xs font-semibold transition-all hover:bg-[#219a55] hover:-translate-y-[1px]">Try Now ›</a>
                        </div>
                    </div>
                    <div class="relative w-[340px] shrink-0 flex items-center justify-center hidden md:flex">
                        <div class="w-[300px] h-[300px] rounded-full flex items-center justify-center relative shadow-lg bg-white/15">
                            <div class="absolute inset-0 rounded-full flex items-center justify-center flex-col gap-2 p-5 text-center">
                                <span class="text-[10px] tracking-widest uppercase text-white/70">hero-chiwda.png 600×600</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>

        <!-- Slider Dots -->
        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-30" id="hero-dots">
            <button onclick="heroGoToSlide(0)" class="hero-dot h-2 rounded-full bg-brand-orange w-[22px] transition-all duration-300"></button>
            <button onclick="heroGoToSlide(1)" class="hero-dot h-2 rounded-full bg-brand-ink/20 w-2 hover:bg-brand-ink/40 transition-all duration-300"></button>
            <button onclick="heroGoToSlide(2)" class="hero-dot h-2 rounded-full bg-brand-ink/20 w-2 hover:bg-brand-ink/40 transition-all duration-300"></button>
        </div>

        <!-- Slider Arrows — visible on all screens -->
        <div class="absolute top-1/2 -translate-y-1/2 w-full flex justify-between px-2 md:px-4 z-30 pointer-events-none">
            <button onclick="heroMoveSlide(-1)" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/90 flex items-center justify-center pointer-events-auto hover:scale-105 hover:bg-white shadow-[0_2px_12px_rgba(0,0,0,0.12)] transition-all">
                <span style="font-size:16px;font-weight:bold;line-height:1;">‹</span>
            </button>
            <button onclick="heroMoveSlide(1)" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/90 flex items-center justify-center pointer-events-auto hover:scale-105 hover:bg-white shadow-[0_2px_12px_rgba(0,0,0,0.12)] transition-all">
                <span style="font-size:16px;font-weight:bold;line-height:1;">›</span>
            </button>
        </div>
    </div>

      <!-- Delivery Strip -->
      <div class="bg-brand-ink text-white animate-slide-in-up" style="animation-delay: 0.4s; animation-fill-mode: both;">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 py-5 md:py-4 grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-brand-orange/20 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#F4821F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                </div>
                <div>
                    <b class="text-[12px] block font-semibold leading-tight">Free shipping</b>
                    <span class="text-[10.5px] text-white/55 leading-tight">Orders above ₹499</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-brand-orange/20 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#F4821F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <b class="text-[12px] block font-semibold leading-tight">Same-day delivery</b>
                    <span class="text-[10.5px] text-white/55 leading-tight">Order before 2 PM</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-brand-orange/20 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#F4821F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
                </div>
                <div>
                    <b class="text-[12px] block font-semibold leading-tight">FSSAI certified</b>
                    <span class="text-[10.5px] text-white/55 leading-tight">Lic. 10012345678901</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-brand-orange/20 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#F4821F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
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
                <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="text-[13px] font-medium text-[#555] hover:text-brand-orange transition-colors">View all &rarr;</a>
            </div>

            <?php
            if ( class_exists( 'WooCommerce' ) ) :
                $terms = get_terms( array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                ) );

                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                    <div class="flex w-full justify-between gap-6 sm:gap-8 md:gap-10 lg:gap-16 overflow-x-auto pb-6 no-scrollbar flex-nowrap items-start snap-x">
                        <?php
                        $gradients = ['from-[#FDEBD0] to-[#F0A05A]', 'from-[#F9EBEA] to-[#C0786A]', 'from-[#EBF5FB] to-[#6AAED6]', 'from-[#E9F7EF] to-[#6AAD8A]', 'from-[#FDF9E3] to-[#D4A860]', 'from-[#F5EEF8] to-[#A070B0]'];
                        $i = 0;
                        foreach ( $terms as $term ) :
                            if ( $term->slug === 'uncategorized' ) continue;
                            $link = get_term_link( $term );
                            $gradient = $gradients[$i % count($gradients)];
                            $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
                            $image = wp_get_attachment_url( $thumbnail_id );
                            ?>
                            <a href="<?php echo esc_url( $link ); ?>" class="flex flex-col items-center gap-4 cursor-pointer shrink-0 snap-start group min-w-[100px] md:min-w-[140px]">
                                <div class="w-[100px] h-[100px] md:w-[130px] md:h-[130px] rounded-full bg-brand-bg2 border-[4px] border-white shadow-sm overflow-hidden flex items-center justify-center relative transition-all duration-500 group-hover:border-brand-orange group-hover:scale-110 group-hover:shadow-xl bg-gradient-to-br <?php echo esc_attr($gradient); ?>">
                                    <?php if ( $image ) : ?>
                                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" class="w-full h-full object-cover">
                                    <?php else : ?>
                                        <span class="text-[12px] md:text-[14px] tracking-[0.1em] font-bold uppercase text-white drop-shadow-md text-center p-2"><?php echo esc_html( substr($term->name, 0, 1) ); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="text-center">
                                    <div class="text-[12px] font-semibold text-[#111]"><?php echo esc_html( $term->name ); ?></div>
                                    <div class="text-[10px] text-[#888]"><?php echo esc_html( $term->count ); ?> items</div>
                                </div>
                            </a>
                            <?php $i++;
                        endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="p-10 border-2 border-dashed border-brand-line rounded-xl text-center text-brand-ink3">
                        <p>No categories found. Please add product categories in WooCommerce.</p>
                    </div>
                <?php endif;
            endif;
            ?>
        </div>
    </section>

    <!-- Bestsellers Section -->
    <section class="home-section" style="padding-top: 0;">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20">
            <div class="flex items-end justify-between mb-7 md:mb-10 gap-4">
                    <div>
                        <span class="section-label">Most loved this week</span>
                        <h2 class="section-heading">
                            <?php echo esc_html((function_exists('get_field') && get_field('best_heading')) ? get_field('best_heading') : 'Bestsellers'); ?>
                        </h2>
                    </div>
                <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="inline-flex items-center gap-1 text-[13px] font-semibold text-brand-orange border border-brand-orange rounded-full px-5 py-2 hover:bg-brand-orange hover:text-white transition-all">All <?php echo function_exists('wp_count_posts') ? wp_count_posts('product')->publish : '89'; ?> products &rarr;</a>
            </div>

            <?php
            if ( class_exists( 'WooCommerce' ) ) {
                $bestsellers = wc_get_products( array('limit' => 4, 'orderby' => 'meta_value_num', 'meta_key' => 'total_sales', 'status' => 'publish') );

                if ( ! empty( $bestsellers ) ) {
                    echo '<div class="grid grid-cols-2 md:grid-cols-4 gap-6">';
                    foreach ( $bestsellers as $product_obj ) {
                        $post_object = get_post( $product_obj->get_id() );
                        setup_postdata( $GLOBALS['post'] =& $post_object );
                        wc_get_template_part( 'content', 'product' );
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
    <section class="mt-8 md:mt-[52px]">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
                <?php 
                $has_promos = function_exists('have_rows') && have_rows('promo_banners');
                if($has_promos):
                    while(have_rows('promo_banners')): the_row();
                ?>
                <div class="rounded-xl p-8 py-8 px-9 flex items-center justify-between gap-5 relative overflow-hidden bg-gradient-to-br from-[#FEF3E8] to-[#FDEBD0] min-h-[160px]">
                    <div class="relative z-10">
                        <div class="text-[10.5px] font-bold tracking-[0.12em] uppercase text-brand-orange mb-2"><?php the_sub_field('subtitle'); ?></div>
                        <h3 class="font-serif text-2xl font-bold text-brand-ink mb-2.5 leading-[1.2]"><?php the_sub_field('title'); ?></h3>
                    </div>
                    <?php if(get_sub_field('image')): ?>
                        <div class="absolute inset-0 z-0">
                            <img src="<?php the_sub_field('image'); ?>" class="w-full h-full object-cover object-right opacity-90" alt="Promo Background">
                        </div>
                    <?php endif; ?>
                </div>
                <?php 
                    endwhile;
                else: 
                ?>
                <div class="rounded-xl p-8 py-8 px-9 flex items-center justify-between gap-5 relative overflow-hidden bg-gradient-to-br from-[#FEF3E8] to-[#FDEBD0] min-h-[160px]">
                    <div>
                        <div class="text-[10.5px] font-bold tracking-[0.12em] uppercase text-brand-orange mb-2">Diwali Special</div>
                        <h3 class="font-serif text-2xl font-bold text-brand-ink mb-2.5 leading-[1.2]">Gift Packs starting at ₹499</h3>
                        <a href="<?php echo esc_url( home_url( '/shop/?category=Gift+Packs' ) ); ?>" class="btn-primary text-xs">Shop Gift Packs →</a>
                    </div>
                    <div class="w-[130px] h-[130px] rounded-full flex items-center justify-center shrink-0 bg-gradient-to-br from-[#FDEBD0] to-brand-orange">
                        <div class="text-[9px] tracking-wider uppercase text-white/70 text-center">giftbox.png<br/>260×260</div>
                    </div>
                </div>

                <div class="rounded-xl p-8 py-8 px-9 flex items-center justify-between gap-5 relative overflow-hidden bg-gradient-to-br from-[#F2EBE0] to-[#E8DDD0] min-h-[160px]">
                    <div>
                        <div class="text-[10.5px] font-bold tracking-[0.12em] uppercase text-brand-red mb-2">Limited Time</div>
                        <h3 class="font-serif text-2xl font-bold text-brand-ink mb-2.5 leading-[1.2]">Buy 2 get 1 free on all Sev</h3>
                        <a href="<?php echo esc_url( home_url( '/shop/?category=Indori+Sev' ) ); ?>" class="inline-flex items-center gap-1.5 py-2 px-4 bg-brand-red text-white rounded-lg text-xs font-semibold hover:bg-[#a93226] transition-colors">Shop Sev →</a>
                    </div>
                    <div class="w-[130px] h-[130px] rounded-full flex items-center justify-center shrink-0 bg-gradient-to-br from-[#F9EBEA] to-brand-red">
                         <div class="text-[9px] tracking-wider uppercase text-white/70 text-center">sev-pack.png<br/>260×260</div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="home-section" style="padding-top: 0;">
        <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20">
            <div class="flex items-end justify-between mb-7 md:mb-10 gap-4">
                    <div>
                        <span class="section-label">Just added</span>
                        <h2 class="section-heading">
                            <?php echo esc_html((function_exists('get_field') && get_field('new_heading')) ? get_field('new_heading') : 'New arrivals'); ?>
                        </h2>
                    </div>
                <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="text-[13px] font-medium text-[#555] hover:text-brand-orange transition-colors">View all &rarr;</a>
            </div>

            <?php
            if ( class_exists( 'WooCommerce' ) ) {
                $new_arrivals = wc_get_products( array('limit' => 4, 'orderby' => 'date', 'order' => 'DESC', 'status' => 'publish') );

                if ( ! empty( $new_arrivals ) ) {
                    echo '<div class="grid grid-cols-2 md:grid-cols-4 gap-6">';
                    foreach ( $new_arrivals as $product_obj ) {
                        $post_object = get_post( $product_obj->get_id() );
                        setup_postdata( $GLOBALS['post'] =& $post_object );
                        wc_get_template_part( 'content', 'product' );
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
    <?php $story = function_exists('get_field') ? get_field('our_story') : null; ?>
    <section class="home-section bg-brand-ink text-white">
        <div class="max-w-[1400px] mx-auto px-5 md:px-10 grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            
            <div>
                <span class="section-label !text-brand-orange" style="color:#F4821F;font-size:11px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;">Our Story</span>
                <h2 class="font-serif font-bold leading-[1.1] text-white mt-4 mb-6" style="font-size:clamp(36px,4vw,58px);">
                    <?php echo wp_kses_post($story['title'] ?? 'From Sarafa Bazaar to<br><em class="text-brand-orange" style="color:#F4821F;font-style:italic;">your doorstep.</em>'); ?>
                </h2>
                <p style="font-size:15px;line-height:1.8;color:rgba(255,255,255,0.55);margin-bottom:2rem;max-width:500px;">
                    <?php echo esc_html($story['copy'] ?? 'In 1989, Ramesh Bhai started frying sev in a tiny shop on Sarafa Bazaar, Indore. He ground besan fresh every morning, roasted masalas in-house, and tested every batch himself. Three generations later, the recipes are the same — only the packaging has changed.'); ?>
                </p>
                <a href="<?php echo esc_url( home_url('/about-us/') ); ?>" style="color:#F4821F;font-weight:600;font-size:14px;text-decoration:none;">
                    Read our story →
                </a>

                <hr style="border:none;border-top:1px solid rgba(255,255,255,0.1);margin:2.5rem 0;">

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem 4rem;">
                    <?php if(!empty($story['stats'])): ?>
                        <?php foreach($story['stats'] as $stat): ?>
                        <div>
                            <b style="font-size:48px;font-weight:800;color:#F4821F;display:block;line-height:1;margin-bottom:6px;"><?php echo esc_html($stat['value']); ?></b>
                            <span style="font-size:10px;color:rgba(255,255,255,0.35);letter-spacing:0.2em;text-transform:uppercase;font-weight:700;"><?php echo esc_html($stat['label']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div>
                            <b style="font-size:48px;font-weight:800;color:#F4821F;display:block;line-height:1;margin-bottom:6px;">37</b>
                            <span style="font-size:10px;color:rgba(255,255,255,0.35);letter-spacing:0.2em;text-transform:uppercase;font-weight:700;">Years of tradition</span>
                        </div>
                        <div>
                            <b style="font-size:48px;font-weight:800;color:#F4821F;display:block;line-height:1;margin-bottom:6px;">12k+</b>
                            <span style="font-size:10px;color:rgba(255,255,255,0.35);letter-spacing:0.2em;text-transform:uppercase;font-weight:700;">Families served</span>
                        </div>
                        <div>
                            <b style="font-size:48px;font-weight:800;color:#F4821F;display:block;line-height:1;margin-bottom:6px;">148kg</b>
                            <span style="font-size:10px;color:rgba(255,255,255,0.35);letter-spacing:0.2em;text-transform:uppercase;font-weight:700;">Fried every morning</span>
                        </div>
                        <div>
                            <b style="font-size:48px;font-weight:800;color:#F4821F;display:block;line-height:1;margin-bottom:6px;">4.9★</b>
                            <span style="font-size:10px;color:rgba(255,255,255,0.35);letter-spacing:0.2em;text-transform:uppercase;font-weight:700;">Average rating</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Image -->
            <div style="border-radius:24px;overflow:hidden;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);min-height:480px;display:flex;align-items:center;justify-content:center;position:relative;">
                <?php 
                $image_url = !empty($story['image']) ? $story['image'] : get_template_directory_uri() . '/assets/images/kitchen.png';
                ?>
                <img src="<?php echo esc_url($image_url); ?>" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;" alt="Our Kitchen">
                <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(26,26,26,0.6) 0%, transparent 60%);pointer-events:none;"></div>
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
            <div class="flex gap-4 overflow-x-auto pb-4 no-scrollbar md:grid md:grid-cols-3 md:gap-6 md:overflow-visible">
                <?php 
                $reviews = function_exists('get_field') ? get_field('reviews') : null;
                if( !empty($reviews) ):
                    foreach($reviews as $rev): ?>
                <div class="bg-white rounded-xl p-6 border border-brand-line shrink-0 w-[80vw] md:w-auto flex flex-col shadow-sm">
                    <div class="text-brand-orange text-sm tracking-widest mb-3"><?php echo str_repeat('★', intval($rev['stars'] ?? 5)); ?></div>
                    <p class="text-sm text-brand-ink2 leading-relaxed mb-5 italic flex-1">"<?php echo esc_html($rev['text']); ?>"</p>
                    <div class="flex items-center gap-2.5 border-t border-brand-line pt-3.5">
                        <div class="w-9 h-9 rounded-full bg-brand-orange-light flex items-center justify-center text-[13px] font-bold text-brand-orange shrink-0"><?php echo esc_html($rev['initials'] ?? 'G'); ?></div>
                        <div>
                            <b class="text-[13px] block"><?php echo esc_html($rev['name']); ?></b>
                            <span class="text-[11px] text-brand-ink3"><?php echo esc_html($rev['location']); ?> · Verified buyer</span>
                        </div>
                    </div>
                </div>
                <?php endforeach;
                else: // Static fallback reviews — always shown when ACF not installed ?>

                <div class="bg-white rounded-xl p-6 border border-brand-line shrink-0 w-[80vw] md:w-auto flex flex-col shadow-sm">
                    <div class="text-brand-orange text-sm tracking-widest mb-3">★★★★★</div>
                    <p class="text-sm text-brand-ink2 leading-relaxed mb-5 italic flex-1">"The Ratlami sev tastes exactly like what my dad used to bring from Indore in the 90s. Nothing comes close. Will keep ordering forever."</p>
                    <div class="flex items-center gap-2.5 border-t border-brand-line pt-3.5">
                        <div class="w-9 h-9 rounded-full bg-brand-orange-light flex items-center justify-center text-[13px] font-bold text-brand-orange shrink-0">PK</div>
                        <div>
                            <b class="text-[13px] block">Priya Kulkarni</b>
                            <span class="text-[11px] text-brand-ink3">Mumbai · Verified buyer</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-brand-line shrink-0 w-[80vw] md:w-auto flex flex-col shadow-sm">
                    <div class="text-brand-orange text-sm tracking-widest mb-3">★★★★★</div>
                    <p class="text-sm text-brand-ink2 leading-relaxed mb-5 italic flex-1">"Ordered the Diwali gift box for 14 relatives. Every single one called to say thank you. The packaging is lovely and the namkeen is superb."</p>
                    <div class="flex items-center gap-2.5 border-t border-brand-line pt-3.5">
                        <div class="w-9 h-9 rounded-full bg-brand-orange-light flex items-center justify-center text-[13px] font-bold text-brand-orange shrink-0">AS</div>
                        <div>
                            <b class="text-[13px] block">Arjun Shah</b>
                            <span class="text-[11px] text-brand-ink3">Bengaluru · Verified buyer</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-brand-line shrink-0 w-[80vw] md:w-auto flex flex-col shadow-sm">
                    <div class="text-brand-orange text-sm tracking-widest mb-3">★★★★★</div>
                    <p class="text-sm text-brand-ink2 leading-relaxed mb-5 italic flex-1">"Crunch is unreal — you can tell it's fried fresh. The masala balance is perfect, not too hot, not bland. Delivery was fast too!"</p>
                    <div class="flex items-center gap-2.5 border-t border-brand-line pt-3.5">
                        <div class="w-9 h-9 rounded-full bg-brand-orange-light flex items-center justify-center text-[13px] font-bold text-brand-orange shrink-0">NR</div>
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
