<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sportapils
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <div class="main-title centered">
            <div class="black-icon"></div><a class="relative" href="<?php $category = get_the_category(); $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><?php echo esc_html($category[0]->cat_name); ?></a><span class="count relative">(<?php echo $category[0]->count; ?>)</span>
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
    if ($hexagon_image) { ?>
        <div class="single-hexagon" style="background-image: url(<?php echo esc_url($hexagon_image[0]); ?>);">
    <!--    --><?php //echo wp_get_attachment_image(get_post_meta( get_the_ID(), 'hexagon_featured_image', true),'full'); ?>
    <!--	--><?php //sportapils_post_thumbnail(); ?>
            <div class="hexTop"></div>
            <div class="hexBottom"></div>
        </div>
    <?php } ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'sportapils' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sportapils' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php sportapils_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
