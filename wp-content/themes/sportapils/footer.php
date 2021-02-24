<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sportapils
 */
$number = 30
?>

    <footer class="site-footer">
        <div class="footer-inner-wrap">
            <div class="left-wrap">
                <div class="site-info">
                    <a href="<?php echo home_url(); ?>" title="Sportapils" class="logo relative"><?php echo file_get_contents(get_template_directory_uri()."/images/sp_logo_with_text.svg");?>
                    </a>
                </div>
                <div class="socials relative">



                    <?php if(get_option('instagram_url')) { ?>
                        <a href="<?php echo get_option('instagram_url'); ?>" title="instagram" class="instagram"><?php echo file_get_contents(get_template_directory_uri()."/images/soc_inst.svg");?>
                        </a>
                    <?php } ?>
                    <?php if(get_option('facebook_url')) { ?>
                        <a href="<?php echo get_option('facebook_url'); ?>" title="facebook" class="facebook"><?php echo file_get_contents(get_template_directory_uri()."/images/soc_fb.svg");?>
                        </a>
                    <?php } ?>
                    <?php if(get_option('twitter_url')) { ?>
                        <a href="<?php echo get_option('twitter_url'); ?>" title="twitter" class="twitter"><?php echo file_get_contents(get_template_directory_uri()."/images/soc_tv.svg");?>
                        </a>
                    <?php } ?>
                    <?php if(get_option('whatsapp_url')) { ?>
                        <a href="<?php echo get_option('whatsapp_url'); ?>" title="whatsapp" class="whatsapp"><?php echo file_get_contents(get_template_directory_uri()."/images/soc_whatsapp.svg");?>
                        </a>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <a class="email" href="mailto:info@sportapils.com"><?php esc_html_e( 'info', 'sportapils' ); ?><span class="green">@</span><?php esc_html_e( 'sportapils.com', 'sportapils' ); ?></a>
                </div>
            </div>
            <div class="menu">
                <?php
                if (has_nav_menu('footer-menu')) {
                    wp_nav_menu( array( 'container' => 'ul', 'menu_class' => 'space-footer-menu', 'theme_location' => 'footer-menu', 'depth' => 1, 'fallback_cb' => '__return_empty_string' ) );
                }
                ?>
            </div>
            <div class="tags">
                <?php wp_tag_cloud(array('smallest' => 12, 'largest' => 12, 'unit' => 'px', 'number' => esc_html($number), 'orderby' => 'count', 'order' => 'DESC' )); ?>
            </div>
            <div class="footer-widgets">
                <?php
                if ( is_active_sidebar( 'footer-block' ) ) {
                    dynamic_sidebar( 'footer-block' );
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </footer>
<?php if(get_option('cookie_policy')) { ?>
  <div id="cookie-policy" class="hidden">
    <div class="container">
      <div class="text">
        <?php echo get_option('cookie_policy'); ?>
      </div>
      <div class="button-container">
        <button type="button" id="cookieAgree">Apstiprinu</button>
      </div>
    </div>
  </div>
<?php } ?>
</div>
<div class="overlay-trans">
</div><!--fly-fade-->
<?php wp_footer(); ?>

</body>
</html>
