<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sportapils
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
<!--    --><?php //if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
<!--        --><?php //$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
<!--        <meta property="og:image" content="--><?php //echo esc_url( $thumb['0'] ); ?><!--" />-->
<!--        <meta name="twitter:image" content="--><?php //echo esc_url( $thumb['0'] ); ?><!--" />-->
<!--    --><?php //} ?>

    <?php 
        $default_image="https://sportapils.com/wp-content/uploads/2021/02/sportapils_logo.png";
        if ( is_front_page() ) {
            echo '<meta property="og:image" content="' . $default_image . '"/>';
        } else {
            if( has_post_thumbnail( $post->ID ) ) { 
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'facebook-thumbnail' );
                echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
            } else{
                echo '<meta property="og:image" content="' . $default_image . '"/>';
            }
        }
    ?> 
    <meta property="fb:app_id" content="3959776510753985" />

    <?php if ( is_single() ) { ?>
        <meta property="og:type" content="article" />
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />
            <meta name="twitter:card" content="summary">
            <meta name="twitter:url" content="<?php the_permalink() ?>">
            <meta name="twitter:title" content="<?php the_title(); ?>">
            <meta name="twitter:description" content="<?php echo strip_tags(get_the_excerpt()); ?>">
        <?php endwhile; endif; ?>
    <?php } else { ?>
        <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <?php } ?>
	<?php wp_head(); ?>
</head>

<body <?php is_single() || is_page() && !is_page('posts') ? body_class('white') : body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sportapils' ); ?></a>

	<header id="masthead" class="site-header">
        <div class="content">
            <div class="site-branding">
                <a href="<?php echo home_url(); ?>" title="sportapils" class="custom-logo-link"><?php echo file_get_contents(get_template_directory_uri()."/images/sp_logo_with_text.svg");?>
                </a>
                <?php
                if ( is_front_page() && is_home() ) :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php
                else :
                    ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php
                endif;
                $sportapils_description = get_bloginfo( 'description', 'display' );
                if ( $sportapils_description || is_customize_preview() ) :
                    ?>
                    <p class="site-description"><?php echo $sportapils_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="menu-wrapper toggle-target">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                        )
                    );
                    ?>
                    <div class="search-box toggle-target">
                        <span class="icon search">
                            <?php echo file_get_contents(get_template_directory_uri()."/images/search.svg"); ?>
                        </span>
                        <span class="text"><?php esc_html_e( 'Search', 'sportapils' ); ?></span>
                        <div class="search-wrap">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                    <div class="account-box toggle-target">
                            <div class="login-button lrm-login lrm-hide-if-logged-in">
                            <span class="icon profile">
                                <?php echo file_get_contents(get_template_directory_uri()."/images/profile.svg"); ?>
                            </span>
                                <span class="text"><?php esc_html_e( 'Log in', 'sportapils' ); ?></span>
                            </div>
                            <a href="<?php echo wp_logout_url('/') ?>" class="login-button lrm-show-if-logged-in">
                               <span class="icon profile">
                                    <?php echo file_get_contents(get_template_directory_uri()."/images/profile.svg"); ?>
                                </span>
                                <span class="text"><?php esc_html_e( 'Log out', 'sportapils' ); ?></span>
                            </a>
                    </div>
                </div>
            </nav><!-- #site-navigation -->
            <div class="clearfix"></div>
        </div>
	</header><!-- #masthead -->
