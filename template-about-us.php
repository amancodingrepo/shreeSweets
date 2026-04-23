<?php
/**
 * Template Name: About Us
 * The template for displaying about us page
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="max-w-6xl mx-auto px-7 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <div class="text-[11px] font-bold tracking-[0.15em] uppercase text-brand-orange mb-1.5">Our story</div>
                <h1 class="font-serif text-[clamp(30px,4vw,48px)] font-bold text-brand-ink leading-[1.15] mb-6">About <em class="italic text-brand-orange">Shree Sweets</em></h1>
                <p class="text-brand-ink2 text-lg leading-relaxed mb-6">
                    Established in 1988, Shree Sweets is a premier pure-vegetarian sweet shop, bakery, and namkeen manufacturer in Sukhliya, Indore. We specialize in authentic Indori flavors, utilizing premium ingredients to prepare traditional Indian sweets, savory snacks, and baked goods for both retail and wholesale customers across the country.
                </p>
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-brand-orange font-serif">35+</div>
                        <div class="text-sm text-brand-ink2">Years of Excellence</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-brand-orange font-serif">1000+</div>
                        <div class="text-sm text-brand-ink2">Happy Customers Daily</div>
                    </div>
                </div>
            </div>

            <div class="aspect-[4/3] bg-gradient-to-br from-brand-orange/10 to-brand-green/10 rounded-xl flex items-center justify-center relative overflow-hidden">
                <div class="text-center">
                    <div class="text-6xl mb-4">🏪</div>
                    <div class="text-brand-ink3 text-sm">Shree Sweets Store</div>
                    <div class="text-brand-ink3 text-xs">Sukhliya, Indore</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white border border-brand-line rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-brand-orange/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🍬</span>
                </div>
                <h3 class="font-serif font-bold text-brand-ink mb-2">Traditional Sweets</h3>
                <p class="text-brand-ink2 text-sm">Authentic Indori mithai made with generations-old recipes</p>
            </div>

            <div class="bg-white border border-brand-line rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-brand-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🥨</span>
                </div>
                <h3 class="font-serif font-bold text-brand-ink mb-2">Premium Namkeen</h3>
                <p class="text-brand-ink2 text-sm">Crispy and flavorful savory snacks prepared fresh daily</p>
            </div>

            <div class="bg-white border border-brand-line rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-brand-red/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🥖</span>
                </div>
                <h3 class="font-serif font-bold text-brand-ink mb-2">Fresh Bakery</h3>
                <p class="text-brand-ink2 text-sm">Delicious baked goods and cookies baked to perfection</p>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();