<?php
/**
 * Template Name: Info Page
 * Fallback template for displaying info pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access
}

get_header();

// Get current page slug to determine which content to show
$current_slug = get_post_field('post_name', get_post());

// Check if a specific template exists for this page
$specific_template = get_template_directory() . '/template-' . $current_slug . '.php';
if (file_exists($specific_template)) {
    // If a specific template exists, use it instead
    include($specific_template);
    get_footer();
    exit;
}

$content_map = [
    'about-us' => [
        'title' => 'About Shree Sweets',
        'content' => '<p>Established in 1988, Shree Sweets is a premier pure-vegetarian sweet shop, bakery, and namkeen manufacturer in Sukhliya, Indore. We specialize in authentic Indori flavors, utilizing premium ingredients to prepare traditional Indian sweets, savory snacks, and baked goods for both retail and wholesale customers across the country.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-brand-orange font-serif">35+</div>
                <div class="text-sm text-brand-ink2">Years of Excellence</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-brand-orange font-serif">1000+</div>
                <div class="text-sm text-brand-ink2">Happy Customers Daily</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-brand-orange font-serif">50+</div>
                <div class="text-sm text-brand-ink2">Premium Products</div>
            </div>
        </div>'
    ],
    'contact' => [
        'title' => 'Contact Us',
        'content' => '<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-white border border-brand-line rounded-lg p-6">
                    <h3 class="font-serif text-xl font-bold text-brand-ink mb-4">Visit Our Store</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-brand-orange/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-brand-orange text-sm">📍</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-brand-ink mb-1">Address</h4>
                                <p class="text-brand-ink2 text-sm">34, Sector A, Sukhliya Main Road<br>Indore, Madhya Pradesh 452010</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-brand-green/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-brand-green text-sm">📞</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-brand-ink mb-1">Phone</h4>
                                <p class="text-brand-ink2 text-sm">099269 88883</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-brand-blue/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-500 text-sm">🕒</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-brand-ink mb-1">Operating Hours</h4>
                                <p class="text-brand-ink2 text-sm">9:30 AM to 8:30 PM (Monday – Saturday)<br><span class="text-red-600 font-medium">Closed on Sundays</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-brand-line rounded-lg p-6">
                <h3 class="font-serif text-xl font-bold text-brand-ink mb-4">Send us a Message</h3>
                <form class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-brand-ink mb-2">First Name *</label>
                            <input type="text" class="form-input" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-brand-ink mb-2">Last Name *</label>
                            <input type="text" class="form-input" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-ink mb-2">Email Address *</label>
                        <input type="email" class="form-input" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-ink mb-2">Phone Number</label>
                        <input type="tel" class="form-input">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-ink mb-2">Subject *</label>
                        <select class="form-input" required>
                            <option value="">Select a subject</option>
                            <option value="order">Order Inquiry</option>
                            <option value="product">Product Information</option>
                            <option value="feedback">Feedback</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-ink mb-2">Message *</label>
                        <textarea rows="4" class="form-input" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send Message</button>
                </form>
            </div>
        </div>'
    ],
    'track-order' => [
        'title' => 'Track Your Order',
        'content' => '<div class="max-w-md mx-auto">
            <div class="bg-white border border-brand-line rounded-lg p-6">
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-brand-ink mb-2">Order ID *</label>
                        <input type="text" class="form-input" placeholder="Enter your order ID" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-ink mb-2">Billing Email or Phone Number *</label>
                        <input type="text" class="form-input" placeholder="Enter email or phone number" required>
                    </div>
                    <button type="submit" class="btn-primary w-full">Track Order</button>
                </form>
            </div>
            <div class="mt-6 text-center text-sm text-brand-ink3">
                <p>You will receive an SMS and email notification once your order is dispatched.</p>
            </div>
        </div>'
    ],
    'shipping-policy' => [
        'title' => 'Shipping Policy',
        'content' => '<div class="space-y-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <span class="text-2xl">🚚</span>
                    <div>
                        <h4 class="font-semibold text-brand-ink mb-1">Local Delivery</h4>
                        <p class="text-brand-ink2 text-sm">Local delivery within Indore is available via aggregator partners.</p>
                    </div>
                </div>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <span class="text-2xl">📦</span>
                    <div>
                        <h4 class="font-semibold text-brand-ink mb-1">Nationwide Bulk Orders</h4>
                        <p class="text-brand-ink2 text-sm">Nationwide bulk/wholesale orders are dispatched within 2-3 business days.</p>
                    </div>
                </div>
            </div>
            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <span class="text-2xl">⚡</span>
                    <div>
                        <h4 class="font-semibold text-brand-ink mb-1">Pan-India Standard Delivery</h4>
                        <p class="text-brand-ink2 text-sm">Standard delivery times for pan-India orders are 5-7 business days.</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <span class="text-2xl">💰</span>
                    <div>
                        <h4 class="font-semibold text-brand-ink mb-1">Shipping Charges</h4>
                        <p class="text-brand-ink2 text-sm">Shipping charges are calculated at checkout based on total weight and destination.</p>
                    </div>
                </div>
            </div>
        </div>'
    ],
    'refund-policy' => [
        'title' => 'Refund Policy',
        'content' => '<div class="space-y-6">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start gap-2">
                    <span class="text-red-500 text-lg">⚠️</span>
                    <div>
                        <h4 class="font-semibold text-brand-ink mb-1">Important Notice</h4>
                        <p class="text-brand-ink2 text-sm">Due to the perishable nature of sweets and baked goods, we do not accept returns.</p>
                    </div>
                </div>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <span class="text-2xl">🔄</span>
                    <div>
                        <h4 class="font-semibold text-brand-ink mb-1">Exception Cases</h4>
                        <p class="text-brand-ink2 text-sm mb-2">If your order arrives damaged or contains incorrect items, please contact us within 24 hours of delivery with photographic evidence.</p>
                        <div class="bg-white border border-green-200 rounded p-2">
                            <p class="text-brand-ink2 text-sm font-medium">Approved refunds will be issued to the original payment method or as store credit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>'
    ],
    'terms-conditions' => [
        'title' => 'Terms & Conditions',
        'content' => '<div class="space-y-6">
            <div>
                <h3 class="font-serif text-lg font-bold text-brand-ink mb-3">Acceptance of Terms</h3>
                <p class="text-brand-ink2">By accessing our platform, you agree to be bound by these terms. These terms apply to all visitors, users, and others who access or use our service.</p>
            </div>
            <div>
                <h3 class="font-serif text-lg font-bold text-brand-ink mb-3">Pricing and Changes</h3>
                <p class="text-brand-ink2">Prices are subject to change without prior notice. We reserve the right to modify pricing at any time. The price displayed at the time of purchase will be the final price.</p>
            </div>
            <div>
                <h3 class="font-serif text-lg font-bold text-brand-ink mb-3">Order Acceptance</h3>
                <p class="text-brand-ink2">We reserve the right to refuse service or cancel orders at our discretion. This may occur due to product availability, payment issues, or other operational reasons.</p>
            </div>
            <div>
                <h3 class="font-serif text-lg font-bold text-brand-ink mb-3">Intellectual Property</h3>
                <p class="text-brand-ink2">All content, menus, and branding on this website are the property of Shree Sweets. You may not reproduce, distribute, or create derivative works without explicit permission.</p>
            </div>
        </div>'
    ],
    'privacy-policy' => [
        'title' => 'Privacy Policy',
        'content' => '<div class="space-y-6">
            <div>
                <h3 class="font-serif text-lg font-bold text-brand-ink mb-3">Information We Collect</h3>
                <p class="text-brand-ink2">We collect personal information (such as your name, phone number, and delivery address) strictly for processing and delivering your orders.</p>
            </div>
            <div>
                <h3 class="font-serif text-lg font-bold text-brand-ink mb-3">How We Use Your Information</h3>
                <p class="text-brand-ink2">Your personal information is used solely for order processing, delivery coordination, and customer service. We maintain strict confidentiality and security measures.</p>
            </div>
            <div>
                <h3 class="font-serif text-lg font-bold text-brand-ink mb-3">Information Sharing</h3>
                <p class="text-brand-ink2">We do not sell or rent your personal data to third parties. Information is only shared with essential delivery and payment processing partners to fulfill your requests.</p>
            </div>
            <div>
                <h3 class="font-serif text-lg font-bold text-brand-ink mb-3">Your Rights</h3>
                <p class="text-brand-ink2">You have the right to access, update, or delete your personal information. Please contact us if you wish to exercise these rights.</p>
            </div>
        </div>'
    ]
];

$page_data = $content_map[$current_slug] ?? null;
?>

<main id="primary" class="animate-in fade-in duration-500 max-w-4xl mx-auto px-7 py-12 pb-20 min-h-[60vh]">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <div class="text-xs text-brand-ink3 mb-8">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-brand-orange transition-colors">Home</a> /
            <span class="text-brand-ink"><?php echo $page_data ? $page_data['title'] : get_the_title(); ?></span>
        </div>

        <h1 class="font-serif text-3xl md:text-4xl font-bold mb-8 text-brand-ink"><?php echo $page_data ? $page_data['title'] : get_the_title(); ?></h1>

        <div class="prose prose-sm md:prose-base prose-neutral max-w-none text-brand-ink2 leading-[1.8]">
            <?php
            if ($page_data && $page_data['content']) {
                echo $page_data['content'];
            } else {
                the_content();
            }
            ?>
        </div>

        <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
