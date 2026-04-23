<?php
/**
 * The main template file
 * 
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access
}

get_header();
?>

<div id="primary" class="content-area max-w-7xl mx-auto px-7 py-12">
    <main id="main" class="site-main">

    <?php
    if ( have_posts() ) :

        if ( is_home() && ! is_front_page() ) :
            ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

        /* Start the Loop */
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('mb-8'); ?>>
                <header class="entry-header mb-4">
                    <?php the_title( '<h2 class="entry-title text-2xl font-bold font-serif">', '</h2>' ); ?>
                </header>
                <div class="entry-content prose max-w-none">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;

        the_posts_navigation();

    else :
        ?>
        <section class="no-results not-found py-20 text-center">
            <h1 class="text-4xl font-bold font-serif mb-4">Nothing Found</h1>
            <p>Ready to try a different search?</p>
            <div class="mt-8 max-w-md mx-auto">
                <?php get_search_form(); ?>
            </div>
        </section>
        <?php
    endif;
    ?>

    </main>
</div>

<?php
get_footer();
