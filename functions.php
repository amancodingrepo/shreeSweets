<?php
/**
 * Shree Sweets functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function shreesweets_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// WooCommerce Support
	add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 800,
        'gallery_thumbnail_image_width' => 400,
        'single_image_width'    => 1200,
    ) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Selectively remove WooCommerce styles (keep functional styles, remove layout)
	add_filter( 'woocommerce_enqueue_styles', 'shreesweets_dequeue_woocommerce_styles' );

	// Register Navigation Menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'shreesweets' ),
		'footer'  => esc_html__( 'Footer Menu', 'shreesweets' ),
	) );

	// Add custom logo support
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 300,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Add favicon/site icon support
	add_theme_support( 'site-icon' );

	/*
	 * HOW TO USE CUSTOM LOGO AND FAVICON:
	 *
	 * 1. LOGO: Go to WordPress Admin > Appearance > Customize > Site Identity > Logo
	 *    - Upload your logo image (recommended: 300x100px, PNG/SVG format)
	 *    - The logo will automatically replace the default "श्री" text logo
	 *
	 * 2. FAVICON: Go to WordPress Admin > Appearance > Customize > Site Identity > Site Icon
	 *    - Upload a square image (recommended: 32x32px, 192x192px, ICO/PNG format)
	 *    - This will appear in browser tabs and bookmarks
	 *
	 * 3. NAVIGATION MENU: Go to WordPress Admin > Appearance > Menus
	 *    - Create a new menu and assign it to "Primary Menu" location
	 *    - Add menu items for Home, Shop, About, Contact, etc.
	 *    - The menu will automatically use the custom nav-link styling
	 */

    // Register Widgets
    register_sidebar( array(
        'name'          => esc_html__( 'Shop Sidebar', 'shreesweets' ),
        'id'            => 'shop-sidebar',
        'description'   => esc_html__( 'Add widgets here to appear on your shop page.', 'shreesweets' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8 pb-8 border-b border-brand-line">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="text-xs font-bold text-brand-ink mb-4 tracking-wide uppercase">',
        'after_title'   => '</h4>',
    ) );

	// Add theme support for HTML5 markup.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );
}
add_action( 'after_setup_theme', 'shreesweets_setup' );

// Force WooCommerce store LIVE — disable "Coming Soon" mode programmatically
add_action( 'init', function() {
    if ( get_option( 'woocommerce_coming_soon' ) === 'yes' ) {
        update_option( 'woocommerce_coming_soon', 'no' );
    }
} );


/**
 * Enqueue scripts and styles with automated versioning (filemtime)
 */
/**
 * Enqueue scripts and styles with automated versioning
 */
function shreesweets_enqueue_assets() {
    // 1. Google Fonts
    wp_enqueue_style( 'shreesweets-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,600&display=swap', array(), null );

    // 2. Compiled Tailwind CSS
    $css_path = get_template_directory() . '/assets/dist/app.css';
    $css_uri = get_template_directory_uri() . '/assets/dist/app.css';

    if ( file_exists( $css_path ) ) {
        wp_enqueue_style( 'shree-style', $css_uri, array(), filemtime( $css_path ) );
        wp_enqueue_style( 'shreesweets-main', get_stylesheet_uri(), array('shree-style', 'shreesweets-fonts'), wp_get_theme()->get( 'Version' ) );
    } else {
        wp_enqueue_style( 'fallback', get_stylesheet_uri(), array('shreesweets-fonts'), wp_get_theme()->get( 'Version' ) );
    }

    // 4. Global Theme JS
    $js_path = get_template_directory() . '/assets/js/theme.js';
    $js_uri = get_template_directory_uri() . '/assets/js/theme.js';
    $js_ver = file_exists( $js_path ) ? filemtime( $js_path ) : wp_get_theme()->get( 'Version' );
    
    wp_enqueue_script( 'shreesweets-theme-js', $js_uri, array('jquery'), $js_ver, true );

    // 5. WooCommerce Fragments
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_script( 'wc-cart-fragments' );
        wp_enqueue_script( 'wc-add-to-cart' );
    }

    // 6. Comment Reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'shreesweets_enqueue_assets' );

/**
 * Defer non-critical JavaScript
 */
function shreesweets_defer_scripts( $tag, $handle ) {
    $safe_to_defer = array(
        'shreesweets-theme-js'
    );

    if ( in_array( $handle, $safe_to_defer ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}

// Balance Cart Fragments for speed
add_action('wp_enqueue_scripts', function() {
    if (is_front_page() && function_exists('WC') && WC()->cart && WC()->cart->is_empty()) {
        wp_dequeue_script('wc-cart-fragments');
    }
}, 99);

// Protect against double checkouts (Razorpay duplicate order prevention)
add_action('woocommerce_after_checkout_validation', function($data, $errors) {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) return;
    
    $key = 'checkout_lock_' . WC()->cart->get_cart_hash();
    if (get_transient($key)) {
        $errors->add('error', 'Processing order, please wait...');
    } else {
        set_transient($key, true, 15);
    }
}, 10, 2);
add_filter( 'script_loader_tag', 'shreesweets_defer_scripts', 10, 2 );

// Ensure cart fragments work properly
function shreesweets_cart_fragments( $fragments ) {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
        return $fragments;
    }

    ob_start();
    ?>
    <span class="shree-cart-count-value">
        <?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
    </span>
    <?php
    $fragments['.shree-cart-count-value'] = ob_get_clean();
    return $fragments;
}

// Selectively dequeue WooCommerce styles (keep functional, remove layout)
function shreesweets_dequeue_woocommerce_styles( $styles ) {
    // Remove layout-related styles that conflict with our theme
    unset( $styles['woocommerce-layout'] );
    unset( $styles['woocommerce-smallscreen'] );

    // Keep functional styles like general WooCommerce styles
    return $styles;
}

// Add cart fragments filter
add_filter( 'woocommerce_add_to_cart_fragments', 'shreesweets_cart_fragments' );

// Change number of products per row to 3
add_filter('loop_shop_columns', 'shreesweets_loop_columns', 999);
if (!function_exists('shreesweets_loop_columns')) {
    function shreesweets_loop_columns() {
        return 3;
    }
}



/**
 * Performance Hardening: Disable WordPress emojis and Embeds
 */
function shreesweets_disable_cruft() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    wp_deregister_script( 'wp-embed' );
    remove_action( 'wp_head', 'wc_generator_tag' );
}
add_action( 'init', 'shreesweets_disable_cruft' );


// Initialize Tailwind config
function shreesweets_tailwind_config() {
    ?>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-orange': '#F4821F',
                        'brand-orange-dark': '#D96B10',
                        'brand-orange-light': '#FEF3E8',
                        'brand-red': '#C0392B',
                        'brand-green': '#27AE60',
                        'brand-ink': '#1A1A1A',
                        'brand-ink2': '#555555',
                        'brand-ink3': '#888888',
                        'brand-bg': '#FFFFFF',
                        'brand-bg2': '#FAF7F2',
                        'brand-bg3': '#F2EBE0',
                        'brand-line': '#EBE6DF',
                    },
                    spacing: {
                        '1.25': '0.3125rem',
                        '4.5': '1.125rem',
                    },
                    fontFamily: {
                        'serif': ['"Playfair Display"', 'serif'],
                        'sans': ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <?php
}
add_action( 'wp_head', 'shreesweets_tailwind_config', 1 );

// Custom navigation walker for styling
class ShreeSweets_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

        $output .= '<a href="' . $item->url . '" class="nav-link ' . $class_names . '">' . $item->title . '</a>';
    }
}

// Fallback menu when no menu is assigned
function shreesweets_default_menu() {
    $menu_items = array(
        'Home' => home_url( '/' ),
        'Shop' => home_url( '/shop/' ),
        'Track Order' => shreesweets_get_page_url( 'track-order' ),
        'About Us' => shreesweets_get_page_url( 'about-us' ),
        'Contact' => shreesweets_get_page_url( 'contact' ),
    );

    foreach ( $menu_items as $title => $url ) {
        echo '<a href="' . esc_url( $url ) . '" class="nav-link">' . esc_html( $title ) . '</a>';
    }
}

// Safely get a page URL by slug, avoiding get_permalink(null) bug
function shreesweets_get_page_url( $slug ) {
    $page = get_page_by_path( $slug );
    return $page ? get_permalink( $page->ID ) : '#';
}

// Create default menu on theme activation
function shreesweets_create_default_menu() {
    // Check if menu already exists
    $menu_name = 'Primary Navigation';
    $menu_exists = wp_get_nav_menu_object( $menu_name );

    if ( !$menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );

        // Add menu items
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' => 'Home',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish',
        ));

        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' => 'Shop',
            'menu-item-url' => home_url( '/shop/' ),
            'menu-item-status' => 'publish',
        ));

        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' => 'Track Order',
            'menu-item-url' => shreesweets_get_page_url( 'track-order' ),
            'menu-item-status' => 'publish',
        ));

        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' => 'About Us',
            'menu-item-url' => shreesweets_get_page_url( 'about-us' ),
            'menu-item-status' => 'publish',
        ));

        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' => 'Contact',
            'menu-item-url' => shreesweets_get_page_url( 'contact' ),
            'menu-item-status' => 'publish',
        ));

        // Assign menu to location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
}
add_action( 'after_switch_theme', 'shreesweets_create_default_menu' );

// Handle contact form submission
function shreesweets_handle_contact_form() {
    if ( ! isset( $_POST['contact_nonce'] ) || ! wp_verify_nonce( $_POST['contact_nonce'], 'contact_form' ) ) {
        wp_die( 'Security check failed' );
    }

    // Sanitize and process form data
    $first_name = sanitize_text_field( $_POST['first_name'] );
    $last_name = sanitize_text_field( $_POST['last_name'] );
    $email = sanitize_email( $_POST['email'] );
    $phone = sanitize_text_field( $_POST['phone'] );
    $subject = sanitize_text_field( $_POST['subject'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    // Basic validation
    if ( empty( $first_name ) || empty( $last_name ) || empty( $email ) || empty( $message ) ) {
        wp_die( 'All required fields must be filled.' );
    }

    // Send email
    $to = get_option( 'admin_email' );
    $email_subject = 'Contact Form: ' . $subject;
    $email_body = "Name: $first_name $last_name\nEmail: $email\nPhone: $phone\nSubject: $subject\n\nMessage:\n$message";

    wp_mail( $to, $email_subject, $email_body );

    // Redirect or response
    wp_redirect( add_query_arg( 'contact', 'success', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_nopriv_contact_form', 'shreesweets_handle_contact_form' );
add_action( 'admin_post_contact_form', 'shreesweets_handle_contact_form' );

// Create default info pages on theme activation
function shreesweets_create_default_pages() {
    $pages = array(
        'about-us' => array(
            'title' => 'About Us',
            'content' => 'About Shree Sweets content',
            'template' => 'template-about-us.php'
        ),
        'contact' => array(
            'title' => 'Contact',
            'content' => 'Contact information',
            'template' => 'template-contact.php'
        ),
        'track-order' => array(
            'title' => 'Track Order',
            'content' => 'Track your order',
            'template' => 'template-track-order.php'
        ),
        'shipping-policy' => array(
            'title' => 'Shipping Policy',
            'content' => 'Shipping information',
            'template' => 'template-shipping-policy.php'
        ),
        'refund-policy' => array(
            'title' => 'Refund Policy',
            'content' => 'Refund terms',
            'template' => 'template-refund-policy.php'
        ),
        'terms-conditions' => array(
            'title' => 'Terms & Conditions',
            'content' => 'Legal terms',
            'template' => 'template-terms-conditions.php'
        ),
        'privacy-policy' => array(
            'title' => 'Privacy Policy',
            'content' => 'Privacy information',
            'template' => 'template-privacy-policy.php'
        )
    );

    foreach ($pages as $slug => $page_data) {
        $page_exists = get_page_by_path($slug);
        if (!$page_exists) {
            $page_id = wp_insert_post(array(
                'post_title' => $page_data['title'],
                'post_name' => $slug,
                'post_content' => $page_data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
            ));

            if ($page_id) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
        }
    }
}
add_action( 'after_switch_theme', 'shreesweets_create_default_pages' );

// Shopify-style backend fields generator using ACF
if( function_exists('acf_add_local_field_group') ):
acf_add_local_field_group(array(
	'key' => 'group_homepage_master',
	'title' => 'Homepage Sections',
	'fields' => array(
		array(
			'key' => 'field_hero_slides',
			'label' => 'Hero Slides',
			'name' => 'hero_slides',
			'type' => 'repeater',
			'layout' => 'block',
			'button_label' => 'Add Slide',
			'sub_fields' => array(
				array('key' => 'hero_badge', 'label' => 'Top Badge', 'name' => 'badge', 'type' => 'text'),
                array('key' => 'hero_badge_color', 'label' => 'Badge Color Class', 'name' => 'badge_color', 'type' => 'text', 'default_value' => 'bg-brand-orange'),
				array('key' => 'hero_title', 'label' => 'Main Heading', 'name' => 'title', 'type' => 'textarea', 'new_lines' => 'br'),
				array('key' => 'hero_copy', 'label' => 'Subtext', 'name' => 'copy', 'type' => 'textarea'),
				array('key' => 'hero_p_btn', 'label' => 'Primary Button Text', 'name' => 'primary_btn', 'type' => 'text', 'default_value' => 'Shop Now >'),
				array('key' => 'hero_p_link', 'label' => 'Primary Button Link', 'name' => 'primary_link', 'type' => 'url'),
				array('key' => 'hero_image', 'label' => 'Image (Bowl)', 'name' => 'image', 'type' => 'image', 'return_format' => 'url'),
				array('key' => 'hero_discount', 'label' => 'Discount Badge', 'name' => 'discount', 'type' => 'text'),
                array('key' => 'hero_bg_gradient', 'label' => 'Background Gradient Logic', 'name' => 'bg_gradient', 'type' => 'text', 'default_value' => 'from-[#FEF3E8] to-[#F4821F] via-[#FEF3E8] via-45%'),
			),
		),
        array(
			'key' => 'field_deals_category',
			'label' => 'Deals Category ID (Slug)',
			'name' => 'deals_category_target',
			'type' => 'text',
            'default_value' => 'deals'
		),
        // 3. CATEGORY SECTION
        array(
            'key' => 'field_cat_heading',
            'label' => 'Category Section Heading',
            'name' => 'cat_heading',
            'type' => 'text',
            'default_value' => 'Shop by craving'
        ),
        // 4. BESTSELLERS SECTION
        array(
            'key' => 'field_best_heading',
            'label' => 'Bestsellers Heading',
            'name' => 'best_heading',
            'type' => 'text',
            'default_value' => 'Our bestsellers'
        ),
        // 4.5 NEW ARRIVALS
        array(
            'key' => 'field_new_heading',
            'label' => 'New Arrivals Heading',
            'name' => 'new_heading',
            'type' => 'text',
            'default_value' => 'New arrivals'
        ),
        // 5. OUR STORY
        array(
            'key' => 'field_story_group',
            'label' => 'Our Story',
            'name' => 'our_story',
            'type' => 'group',
            'sub_fields' => array(
                array('key' => 'story_title', 'label' => 'Title', 'name' => 'title', 'type' => 'textarea', 'new_lines' => 'br'),
                array('key' => 'story_copy', 'label' => 'Content', 'name' => 'copy', 'type' => 'textarea'),
                array('key' => 'story_stats', 'label' => 'Stats', 'name' => 'stats', 'type' => 'repeater', 'sub_fields' => array(
                    array('key' => 'stat_val', 'label' => 'Value', 'name' => 'value', 'type' => 'text'),
                    array('key' => 'stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'),
                )),
                array('key' => 'story_image', 'label' => 'Main Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url'),
            )
        ),
        // 6. REVIEWS
        array(
            'key' => 'field_reviews_repeater',
            'label' => 'Customer Reviews',
            'name' => 'reviews',
            'type' => 'repeater',
            'sub_fields' => array(
                array('key' => 'rev_stars', 'label' => 'Stars (1-5)', 'name' => 'stars', 'type' => 'number', 'min' => 1, 'max' => 5, 'default_value' => 5),
                array('key' => 'rev_text', 'label' => 'Review Text', 'name' => 'text', 'type' => 'textarea'),
                array('key' => 'rev_name', 'label' => 'Author Name', 'name' => 'name', 'type' => 'text'),
                array('key' => 'rev_loc', 'label' => 'Location', 'name' => 'location', 'type' => 'text'),
                array('key' => 'rev_initials', 'label' => 'Initials (Avatar)', 'name' => 'initials', 'type' => 'text'),
            )
        )
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'template-home.php',
			),
		),
	),
));
endif;

// Remove WooCommerce view switcher
add_filter( 'woocommerce_catalog_orderby', function( $orderby ) {
    unset( $orderby['menu_order'] );
    return $orderby;
}, 10 );

// Remove product view toggle if it exists
add_action( 'wp_footer', function() {
    echo '<style>.woocommerce-view-toggle, .products-view-toggle { display: none !important; }</style>';
});
