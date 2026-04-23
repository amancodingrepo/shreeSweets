<?php
/**
 * Template Name: Shipping Policy
 * The template for displaying shipping policy page
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 py-12">
        <div class="text-center mb-8">
            <div class="text-[11px] font-bold tracking-[0.15em] uppercase text-brand-orange mb-1.5">Shipping information</div>
            <h1 class="font-serif text-[clamp(30px,4vw,48px)] font-bold text-brand-ink leading-[1.15]">Shipping <em class="italic text-brand-orange">Policy</em></h1>
        </div>

        <div class="prose prose-lg max-w-none">
            <div class="bg-white border border-brand-line rounded-xl p-8">
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-brand-orange/10 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-brand-orange font-bold">📍</span>
                        </div>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-brand-ink mb-2">Local Delivery</h3>
                            <p class="text-brand-ink2">Local delivery within Indore is available via aggregator partners.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-brand-green/10 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-brand-green font-bold">🚛</span>
                        </div>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-brand-ink mb-2">Nationwide Bulk/Wholesale Orders</h3>
                            <p class="text-brand-ink2">Nationwide bulk/wholesale orders are dispatched within 2-3 business days.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-brand-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-blue-500 font-bold">📦</span>
                        </div>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-brand-ink mb-2">Pan-India Standard Delivery</h3>
                            <p class="text-brand-ink2">Standard delivery times for pan-India orders are 5-7 business days.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-brand-ink/10 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-brand-ink font-bold">💰</span>
                        </div>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-brand-ink mb-2">Shipping Charges</h3>
                            <p class="text-brand-ink2">Shipping charges are calculated at checkout based on total weight and destination.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();