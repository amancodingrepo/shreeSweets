<?php
/**
 * Template Name: Refund Policy
 * The template for displaying refund policy page
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="max-w-full mx-auto px-6 md:px-16 lg:px-20 py-12">
        <div class="text-center mb-8">
            <div class="text-[11px] font-bold tracking-[0.15em] uppercase text-brand-orange mb-1.5">Refund information</div>
            <h1 class="font-serif text-[clamp(30px,4vw,48px)] font-bold text-brand-ink leading-[1.15]">Refund <em class="italic text-brand-orange">Policy</em></h1>
        </div>

        <div class="prose prose-lg max-w-none">
            <div class="bg-white border border-brand-line rounded-xl p-8">
                <div class="space-y-6">
                    <div class="p-5 bg-brand-orange/5 border-l-4 border-brand-orange rounded-r-lg">
                        <p class="text-brand-ink2 text-[15px] leading-[1.8]">Due to the perishable nature of sweets and baked goods, we do not accept returns. If your order arrives damaged or contains incorrect items, please contact us within 24 hours of delivery with photographic evidence. Approved refunds will be issued to the original payment method or as store credit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();