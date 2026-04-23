<?php
/**
 * The header for our theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var topbar = document.getElementById('shree-topbar');
    if (topbar) {
        topbar.style.display = '';
    }
});
function hideTopbar() {
    var topbar = document.getElementById('shree-topbar');
    if (topbar) {
        topbar.style.display = 'none';
    }
}

function openCartDrawer() {
    // For now, redirect to cart page since we don't have a drawer component
    window.location.href = '<?php echo class_exists("WooCommerce") ? esc_url(wc_get_cart_url()) : "#"; ?>';
}
</script>
<!-- Topbar matched to React Header.tsx -->
<div id="shree-topbar" class="hidden md:block bg-brand-orange text-white text-center py-2 px-5 text-xs font-medium tracking-wide relative">
    <span>🎉 Diwali Sale — Use code <b>DIWALI10</b> for 10% off · Free shipping above ₹499</span>
    <button onclick="hideTopbar()" class="absolute right-5 top-1/2 -translate-y-1/2 opacity-70 hover:opacity-100 text-lg leading-none cursor-pointer" aria-label="Close">
        ✕
    </button>
</div>

<header id="masthead" class="bg-white border-b border-brand-line sticky top-0 z-50 shadow-[0_1px_8px_rgba(0,0,0,0.05)]">
    <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 h-[72px] md:h-auto py-0 md:py-5 flex items-center justify-between md:justify-start w-full gap-4 md:gap-8">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 shrink-0">
            <?php
            $logo_url = get_template_directory_uri() . '/assets/images/logo.jpg';
            $logo_path = get_template_directory() . '/assets/images/logo.jpg';
            
            if ( file_exists( $logo_path ) ) : ?>
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="h-12 md:h-[52px] w-auto shrink-0 object-contain">
                <div class="flex flex-col justify-center">
                    <div class="font-serif text-[22px] font-bold text-[#1A1A1A] leading-[1.1]">Shree Sweets</div>
                    <div class="text-[10.5px] tracking-[0.15em] uppercase text-brand-orange font-bold mt-[2px]">INDORE &middot; EST. 1989</div>
                </div>
            <?php else :
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                if ( $custom_logo_id ) :
                    $logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                    if ( $logo ) :
                        echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="h-12 md:h-[52px] w-auto shrink-0 object-contain">';
                    endif;
                else :
                    ?>
                    <!-- Custom Styled Brand Logo Fallback -->
                    <div class="w-12 h-12 bg-brand-orange rounded-full flex items-center justify-center relative flex-shrink-0 after:content-[''] after:absolute after:inset-[2px] after:rounded-full after:border-[1.5px] after:border-white/40">
                        <span class="text-xl text-white pb-0.5" style="font-family: sans-serif;">श्री</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <div class="font-serif text-[22px] font-bold text-[#1A1A1A] leading-[1.1]">Shree Sweets</div>
                        <div class="text-[10.5px] tracking-[0.15em] uppercase text-brand-orange font-bold mt-[2px]">INDORE &middot; EST. 1989</div>
                    </div>
                    <?php
                endif;
            endif;
            ?>
        </a>

        <div class="flex-1 max-w-[560px] mx-auto hidden md:block">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative w-full">
                <input type="hidden" name="post_type" value="product" />
                <input
                  type="text"
                  name="s"
                  placeholder="Search for Ratlami Sev, Namkeen, Gift Packs…"
                  class="w-full py-2.5 pr-12 pl-4 border-[1.5px] border-brand-line rounded-full text-[13px] text-brand-ink bg-[#FAFAFA] transition-colors focus:outline-none focus:border-brand-orange focus:bg-white"
                  value="<?php echo get_search_query(); ?>"
                />
                <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 w-8 h-8 bg-brand-orange rounded-full flex items-center justify-center hover:bg-brand-orange-dark transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                </button>
            </form>
        </div>

        <div class="flex items-center gap-1.5 shrink-0 ml-auto">
            <button onclick="openLocationModal()" class="hidden sm:flex items-center gap-1.5 py-2 px-3.5 border-[1.5px] border-brand-line rounded-full text-xs text-brand-ink2 transition-colors cursor-pointer hover:border-brand-orange mr-1 bg-transparent focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-orange"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Deliver to <b id="header-location-text" class="text-brand-ink font-semibold">Indore</b>
            </button>

            <!-- Search is now exposed natively below on mobile -->

            <!-- Hide Account/Wishlist on mobile (moved to bottom nav) -->
            <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="w-10 h-10 rounded-full items-center justify-center relative transition-colors hover:bg-gray-100 hidden md:flex" title="My Account">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-ink"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </a>

            <a href="<?php echo function_exists('wc_get_cart_url') ? esc_url(wc_get_cart_url()) : '#'; ?>" class="w-10 h-10 rounded-full flex items-center justify-center relative transition-colors hover:bg-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-ink"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
              <span class="absolute top-[2px] right-[2px] min-w-[17px] h-[17px] rounded-full bg-brand-orange text-white text-[10px] font-bold flex items-center justify-center px-1 border-2 border-white">
                  <span class="shree-cart-count-value"><?php echo function_exists('WC') && WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?></span>
              </span>
            </a>
        </div><!-- end icons flex -->
    </div><!-- end header inner -->
</header>

<!-- Navstrip -->
<div class="hidden md:block bg-white border-b border-brand-line">
    <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 flex items-center gap-6 overflow-x-auto no-scrollbar">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_class'     => 'flex items-center gap-6',
            'container'      => false,
            'fallback_cb'    => 'shreesweets_default_menu',
            'link_before'    => '',
            'link_after'     => '',
            'walker'         => new ShreeSweets_Nav_Walker(),
        ) );
        ?>

        <div class="ml-auto text-xs text-brand-ink3 whitespace-nowrap py-3.5 hidden lg:block">
            Free shipping above ₹499 · Same-day in Indore
        </div>
    </div>
</div>
