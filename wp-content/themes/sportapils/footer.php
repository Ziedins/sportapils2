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
                    <a href="<?php echo home_url(); ?>" title="Sportapils" class="logo relative"><?php echo file_get_contents(get_template_directory_uri()."/images/logo-label.svg");?>
                    </a>
                </div>
                <div class="socials relative">
                    <a href="<?php echo home_url(); ?>" title="instagram" class="instagram"><?php echo file_get_contents(get_template_directory_uri()."/images/soc_inst.svg");?>
                    </a>
                    <a href="<?php echo home_url(); ?>" title="facebook" class="facebook"><?php echo file_get_contents(get_template_directory_uri()."/images/soc_fb.svg");?>
                    </a>
                    <a href="<?php echo home_url(); ?>" title="twitter" class="twitter"><?php echo file_get_contents(get_template_directory_uri()."/images/soc_tv.svg");?>
                    </a>
                    <a href="<?php echo home_url(); ?>" title="whatsapp" class="whatsapp"><?php echo file_get_contents(get_template_directory_uri()."/images/soc_whatsapp.svg");?>
                    </a>
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
</div>

<?php wp_footer(); ?>

</body>
</html>
