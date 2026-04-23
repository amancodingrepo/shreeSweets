<?php
/**
 * Template Name: Contact
 * The template for displaying contact page
 */
get_header();
?>

<script>
function handleContactSubmit(event) {
    event.preventDefault();
    alert('Thank you for your message! We will get back to you within 24 hours.');
    event.target.closest('form').reset();
    return false;
}
</script>

<main id="primary" class="site-main">
    <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 py-12">
        <div class="text-center mb-12">
            <div class="text-[11px] font-bold tracking-[0.15em] uppercase text-brand-orange mb-1.5">Get in touch</div>
            <h1 class="font-serif text-[clamp(30px,4vw,48px)] font-bold text-brand-ink leading-[1.15]">Contact <em class="italic text-brand-orange">Us</em></h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Information -->
            <div class="space-y-8">
                <div class="bg-white border border-brand-line rounded-xl p-8">
                    <h2 class="font-serif text-2xl font-bold text-brand-ink mb-6">Visit Our Store</h2>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-brand-orange/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-brand-orange">📍</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-brand-ink mb-1">Address</h3>
                                <p class="text-brand-ink2">34, Sector A, Sukhliya Main Road<br>Indore, Madhya Pradesh 452010</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-brand-green/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-brand-green">📞</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-brand-ink mb-1">Phone</h3>
                                <p class="text-brand-ink2">099269 88883</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-brand-blue/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-500">🕒</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-brand-ink mb-1">Operating Hours</h3>
                                <p class="text-brand-ink2">9:30 AM to 8:30 PM (Monday – Saturday)<br><span class="text-brand-red font-medium">Closed on Sundays</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-brand-ink text-white rounded-xl p-8">
                    <h3 class="font-serif text-xl font-bold mb-4">Need Help?</h3>
                    <p class="text-white/80 mb-4">Have questions about our products or need assistance with your order? Our friendly team is here to help!</p>
                    <div class="flex gap-4">
                        <a href="tel:09926988883" class="inline-flex items-center gap-2 py-2 px-4 bg-brand-orange text-white rounded-lg font-medium hover:bg-brand-orange-dark transition-colors">
                            📞 Call Now
                        </a>
                        <a href="https://wa.me/919926988883" class="inline-flex items-center gap-2 py-2 px-4 border border-white/20 text-white rounded-lg font-medium hover:bg-white/10 transition-colors">
                            💬 WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white border border-brand-line rounded-xl p-8">
                <h2 class="font-serif text-2xl font-bold text-brand-ink mb-6">Send us a Message</h2>

                <form class="space-y-6" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="contact_form">
                    <?php wp_nonce_field( 'contact_form', 'contact_nonce' ); ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-brand-ink mb-2">First Name *</label>
                            <input type="text" id="first_name" name="first_name" class="w-full px-4 py-3 border border-brand-line rounded-lg focus:border-brand-orange focus:outline-none" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-brand-ink mb-2">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" class="w-full px-4 py-3 border border-brand-line rounded-lg focus:border-brand-orange focus:outline-none" required>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-brand-ink mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-brand-line rounded-lg focus:border-brand-orange focus:outline-none" required>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-brand-ink mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border border-brand-line rounded-lg focus:border-brand-orange focus:outline-none">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-brand-ink mb-2">Subject *</label>
                        <select id="subject" name="subject" class="w-full px-4 py-3 border border-brand-line rounded-lg focus:border-brand-orange focus:outline-none" required>
                            <option value="">Select a subject</option>
                            <option value="order">Order Inquiry</option>
                            <option value="product">Product Information</option>
                            <option value="delivery">Delivery Question</option>
                            <option value="feedback">Feedback</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-brand-ink mb-2">Message *</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-brand-line rounded-lg focus:border-brand-orange focus:outline-none resize-none" placeholder="Tell us how we can help you..." required></textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center text-center">
                        Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- Map Section -->
        <div class="mt-16 bg-white border border-brand-line rounded-xl overflow-hidden">
            <div class="aspect-[16/9] bg-brand-bg2 flex items-center justify-center">
                <div class="text-center">
                    <div class="text-6xl mb-4">🗺️</div>
                    <p class="text-brand-ink3">Interactive Map Coming Soon</p>
                    <p class="text-brand-ink2 text-sm">34, Sector A, Sukhliya Main Road, Indore, Madhya Pradesh 452010</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();