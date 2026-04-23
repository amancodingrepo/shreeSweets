<?php
/**
 * Template Name: Track Order
 * The template for displaying track order page
 */
get_header();
?>

<script>
function handleTrackOrder(event) {
    event.preventDefault();
    const orderId = document.getElementById('order_id').value;
    const email = document.getElementById('billing_email').value;

    if (!orderId || !email) {
        alert('Please fill in all required fields.');
        return false;
    }

    // Simulate order tracking (in real implementation, this would make an API call)
    alert('Order tracking is not yet implemented. Please contact customer service at 099269 88883 for assistance.');
    return false;
}
</script>

<main id="primary" class="site-main">
    <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 py-12">
        <div class="text-center mb-8">
            <div class="text-[11px] font-bold tracking-[0.15em] uppercase text-brand-orange mb-1.5">Order tracking</div>
            <h1 class="font-serif text-[clamp(30px,4vw,48px)] font-bold text-brand-ink leading-[1.15]">Track Your <em class="italic text-brand-orange">Order</em></h1>
            <p class="text-brand-ink2 mt-4 max-w-2xl mx-auto">
                Enter your Order ID and Billing Email Address or Phone Number below to track the status of your delivery. You will receive an SMS and email notification once your order is dispatched.
            </p>
        </div>

        <div class="bg-white border border-brand-line rounded-xl p-8 max-w-md mx-auto">
            <form class="space-y-4">
                <?php wp_nonce_field( 'track_order_form', 'track_order_nonce' ); ?>
                <div>
                    <label for="order_id" class="block text-sm font-medium text-brand-ink mb-2">Order ID *</label>
                    <input type="text" id="order_id" name="order_id" class="w-full px-4 py-3 border border-brand-line rounded-lg focus:border-brand-orange focus:outline-none" placeholder="Enter your order ID" required>
                </div>

                <div>
                    <label for="billing_email" class="block text-sm font-medium text-brand-ink mb-2">Billing Email or Phone Number *</label>
                    <input type="text" id="billing_email" name="billing_email" class="w-full px-4 py-3 border border-brand-line rounded-lg focus:border-brand-orange focus:outline-none" placeholder="Enter email or phone number" required>
                </div>

                <button type="submit" class="btn-primary w-full justify-center text-center" onclick="handleTrackOrder(event)">
                    Track Order
                </button>
            </form>
        </div>
    </div>
</main>

<?php
get_footer();