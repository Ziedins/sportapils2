<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sportapils
 */
get_header();
setup_postdata($post);
$category = get_the_category();
?>
<div class="page-wrapper relative centered <?php if($category[0]->slug == 'karikaturas') echo 'no-image'; ?>">
    <div class="decoration">
        <div class="container">
            <?php echo file_get_contents(get_template_directory_uri()."/images/background-top.svg");?>
            <?php echo file_get_contents(get_template_directory_uri()."/images/background-bottom.svg");?>
        </div>
    </div>
    <div class="full-top">
        <header class="entry-header">
            <div class="main-title">
                <div class="black-icon"></div><a class="relative" href="<?php $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><?php echo esc_html($category[0]->cat_name); ?></a>
            </div>

            <?php

            if ( is_singular() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;
            if ( 'post' === get_post_type() ) :
                ?>
                <div class="entry-meta">
                    <div class="post-info-img left relative avatar" style="background-image: url(<?php echo get_avatar_url( get_the_author_meta('email')); ?>);">
                        <div class="hexTop"></div>
                        <div class="hexBottom"></div>
                    </div><!--post-info-img-->
                    <div class="text-wrap left">
                        <?php
                        sportapils_posted_by();
                        sportapils_posted_on();
                        ?>
                    </div>
                </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->
        <?php $hexagon_image = wp_get_attachment_image_src(get_post_meta( get_the_ID(), 'hexagon_featured_image', true), 'full');
        if(!$hexagon_image) $hexagon_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        if ($hexagon_image && $category[0]->slug != 'karikaturas') { ?>
            <div class="single-hexagon main" style="background-image: url(<?php echo esc_url($hexagon_image[0]); ?>);">
                <div class="hexTop"></div>
                <div class="hexBottom"></div>
            </div>
        <?php } ?>
    </div>
    <main id="primary" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', get_post_type() );

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
<?php
get_sidebar();
?>
<div class="full-bottom">
    <?php get_template_part( 'template-parts/related', get_post_type() ); ?>
    <?php
    if ( is_active_sidebar( 'post-full-block' ) ) {
        dynamic_sidebar( 'post-full-block' );
    }
    ?>
</div>
</div>
<?php
get_footer();
