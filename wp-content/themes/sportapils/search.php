<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sportapils
 */

get_header();
$wp_query->set('posts_per_page', 11);
$wp_query->query($wp_query->query_vars);
$category = get_the_category();
$count = 0;
?>

    <main id="primary" class="site-main">
        <div class="posts relative">
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf( esc_html__( 'Search Results for: %s', 'sportapils' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            </header>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $count++ ?>
                <?php set_query_var( 'count', $count );?>
                <?php if( $count == 1) : ?>
                    <?php get_template_part( '/template-parts/archive/initial' ); ?>
                <?php elseif($count == 2):  ?>
                    <div></div>
                    <div class="hexagon-list hexagon-category relative centered">
                    <?php get_template_part( '/template-parts/archive/loop' ); ?>
                <?php else : ?>
                    <?php get_template_part( '/template-parts/archive/loop' ); ?>
                <?php endif; ?>
            <?php endwhile; ?>
                </div>
                <div class="clearfix"></div>
                <a href="#" class="more-button"><?php _e( 'More Posts', 'sportapils' ); ?></a>
                <div class="nav-links">
                    <?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
                </div><!--nav-links-->
            <?php else : ?>

                <!-- Posts not found Start -->

                <div class="space-page-content-wrap relative">
                    <div class="space-page-content page-template box-100 relative">
                        <h2><?php esc_html_e( 'Posts not found', 'sportapils' ); ?></h2>
                        <p>
                            <?php esc_html_e( 'No posts has been found. Please return to the homepage.', 'sportapils' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Posts not found End -->

            <?php endif; ?>
        </div>
    </main><!-- #main -->

<?php
get_footer();