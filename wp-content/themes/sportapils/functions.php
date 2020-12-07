<?php
/**
 * sportapils functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sportapils
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
include("widgets/widget-category.php");
include("widgets/widget-category-2.php");
include("widgets/widget-category-3.php");
include ("widgets/widget-popular-sidebar.php");
include ("widgets/widget-ad.php");



if ( ! function_exists( 'sportapils_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sportapils_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on sportapils, use a find and replace
		 * to change 'sportapils' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sportapils', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'sportapils' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'sportapils_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'sportapils_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sportapils_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sportapils_content_width', 640 );
}
add_action( 'after_setup_theme', 'sportapils_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sportapils_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sportapils' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sportapils' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'sportapils_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sportapils_scripts() {
	wp_enqueue_style( 'sportapils-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'sportapils-style', 'rtl', 'replace' );

	wp_enqueue_script( 'sportapils-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'sportapils-infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), _S_VERSION, true );
    wp_enqueue_script( 'sportapils-more', get_template_directory_uri() . '/js/search.js', array('jquery'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sportapils_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Load Infinite Scroll file.
 */
require get_template_directory() . '/inc/infinite-scroll.php';


//init the meta box
add_action( 'after_setup_theme', 'custom_postimage_setup' );
function custom_postimage_setup(){
    add_action( 'add_meta_boxes', 'custom_postimage_meta_box' );
    add_action( 'save_post', 'custom_postimage_meta_box_save' );
}

function custom_postimage_meta_box(){

    //on which post types should the box appear?
    $post_types = array('post','page');
    foreach($post_types as $pt){
        add_meta_box('custom_postimage_meta_box',__( 'Hexagon featured image', 'sportapils'),'custom_postimage_meta_box_func',$pt,'side','low');
    }
}

function custom_postimage_meta_box_func($post){

    //an array with all the images (ba meta key). The same array has to be in custom_postimage_meta_box_save($post_id) as well.
    $meta_keys = array('hexagon_featured_image');

    foreach($meta_keys as $meta_key){
        $image_meta_val=get_post_meta( $post->ID, $meta_key, true);
        ?>
        <p class="custom_postimage_wrapper" id="<?php echo $meta_key; ?>_wrapper" style="margin-bottom:20px;">
            <img src="<?php echo ($image_meta_val!=''?wp_get_attachment_image_src( $image_meta_val)[0]:''); ?>" style="width:100%;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" alt="">
            <a class="addimage button" onclick="custom_postimage_add_image('<?php echo $meta_key; ?>');"><?php _e('add image','yourdomain'); ?></a><br>
            <a class="removeimage" style="color:#a00;cursor:pointer;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" onclick="custom_postimage_remove_image('<?php echo $meta_key; ?>');"><?php _e('remove image','yourdomain'); ?></a>
            <input type="hidden" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo $image_meta_val; ?>" />
        </p>
    <?php } ?>
    <script>
        function custom_postimage_add_image(key){

            var $wrapper = jQuery('#'+key+'_wrapper');

            custom_postimage_uploader = wp.media.frames.file_frame = wp.media({
                title: '<?php _e('select image','sportapils'); ?>',
                button: {
                    text: '<?php _e('select image','sportapils'); ?>'
                },
                multiple: false
            });
            custom_postimage_uploader.on('select', function() {

                var attachment = custom_postimage_uploader.state().get('selection').first().toJSON();
                var img_url = attachment['url'];
                var img_id = attachment['id'];
                $wrapper.find('input#'+key).val(img_id);
                $wrapper.find('img').attr('src',img_url);
                $wrapper.find('img').show();
                $wrapper.find('a.removeimage').show();
            });
            custom_postimage_uploader.on('open', function(){
                var selection = custom_postimage_uploader.state().get('selection');
                var selected = $wrapper.find('input#'+key).val();
                if(selected){
                    selection.add(wp.media.attachment(selected));
                }
            });
            custom_postimage_uploader.open();
            return false;
        }

        function custom_postimage_remove_image(key){
            var $wrapper = jQuery('#'+key+'_wrapper');
            $wrapper.find('input#'+key).val('');
            $wrapper.find('img').hide();
            $wrapper.find('a.removeimage').hide();
            return false;
        }
    </script>
    <?php
    wp_nonce_field( 'custom_postimage_meta_box', 'custom_postimage_meta_box_nonce' );
}

function custom_postimage_meta_box_save($post_id){
    if ( ! current_user_can( 'edit_posts', $post_id ) ){ return 'not permitted'; }
    if (isset( $_POST['custom_postimage_meta_box_nonce'] ) && wp_verify_nonce($_POST['custom_postimage_meta_box_nonce'],'custom_postimage_meta_box' )){

        //same array as in custom_postimage_meta_box_func($post)
        $meta_keys = array('hexagon_featured_image');
        foreach($meta_keys as $meta_key){
            if(isset($_POST[$meta_key]) && intval($_POST[$meta_key])!=''){
                update_post_meta( $post_id, $meta_key, intval($_POST[$meta_key]));
            }else{
                update_post_meta( $post_id, $meta_key, '');
            }
        }
    }
}

register_sidebar( array(
    'name'          => esc_html__( 'Homepage Full Block', 'sportapils' ),
    'id'            => 'homepage-full-block',
    'description'   => esc_html__( 'For widgets in the homepage full block.', 'sportapils' ),
    'before_widget' => '<div id="%1$s" class="relative %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<div class="relative"><span>',
    'after_title'   => '</span></div>',
) );
register_sidebar( array(
    'name'          => esc_html__( 'Post Full Block', 'sportapils' ),
    'id'            => 'post-full-block',
    'description'   => esc_html__( 'For widgets in the post full block.', 'sportapils' ),
    'before_widget' => '<div id="%1$s" class="relative %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<div class="relative"><span>',
    'after_title'   => '</span></div>',
) );
register_sidebar( array(
    'name'          => esc_html__( 'Footer Block', 'sportapils' ),
    'id'            => 'footer-block',
    'description'   => esc_html__( 'For widgets in the footer.', 'sportapils' ),
    'before_widget' => '<div id="%1$s" class="relative %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<div class="relative"><span>',
    'after_title'   => '</span></div>',
) );
add_action('after_setup_theme', 'remove_admin_bar');
register_nav_menus( array(
    'footer-menu' => esc_html__( 'Footer Menu', 'sportapils' )
) );

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
// define the get_image_tag callback
function get_image_tag_sportapils( $html, $id, $alt, $title, $align, $size ) {
    list( $img_src, $width, $height ) = image_downsize( $id, $size );
    $hwstring                         = image_hwstring( $width, $height );


    $class = 'align' . esc_attr( $align ) . ' size-' . esc_attr( $size ) . ' wp-image-' . $id;

    $class = apply_filters( 'get_image_tag_class', $class, $id, $align, $size );

    $html = '
    <div style="background-image: url('. esc_attr( $img_src ) . ');"  class="single-hexagon ' . $class . '" >
        <div class="hexTop"></div>
        <div class="hexBottom"></div>
    </div>
    ';

   return $html;
};

// add the filter
//add_filter( 'get_image_tag', 'get_image_tag_sportapils', 10, 6 );


// Related Posts
if ( !function_exists( 'spRelatedPosts' ) ) {
function spRelatedPosts() {
    global $post;
    $orig_post = $post;

    $tags = wp_get_post_tags($post->ID);
    if ($tags) {

	$slider_exclude = esc_html(get_option('mvp_feat_posts_tags'));
	$tag_exclude_slider = get_term_by('slug', $slider_exclude, 'post_tag');
	$tag_id_exclude_slider =  $tag_exclude_slider->term_id;

        $tag_ids = [];
        foreach($tags as $individual_tag) {
		$excluded_tags = [$tag_id_exclude_slider];
      		if (in_array($individual_tag->term_id,$excluded_tags)) continue;
 		$tag_ids[] = $individual_tag->term_id;
	}
        $args = [
            'tag__in' => $tag_ids,
	        'order' => 'DESC',
	        'orderby' => 'date',
            'post__not_in' => array($post->ID),
            'posts_per_page'=> 4,
            'ignore_sticky_posts'=> 1
        ];
        $related_query = new WP_Query( $args );
        $n = 1;
        if( $related_query->have_posts() ) { ?>
            <div class="main-title centered">
                <div class="black-icon"></div><span class="relative"><?php echo __('Related posts', 'sportapils'); ?></span>
            </div>
            <div class="hexagon-list single four relative centered">
            <?php while( $related_query->have_posts() ) { $related_query->the_post(); ?>
                <?php $hexagon_image = wp_get_attachment_image_src(get_post_meta( get_the_ID(), 'hexagon_featured_image', true), 'full');
                if(!$hexagon_image) $hexagon_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                if ($hexagon_image) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
                   class="hexagon left <?php if ($n == 5) echo 'grey';?>"
                   style="background-image: url(<?php echo esc_url($hexagon_image[0]); ?>);">
                    <div class="overlay"></div>
                    <div class="content">
                        <div class="info">
                            <span class="date"><?php echo get_the_date(); ?></span>
                            <span class="author">@<?php echo get_the_author_meta('display_name');?></span>
                        </div>
                        <div class="title-wrapper">
                            <span class="title"><?php echo get_the_title() ?  esc_html(wp_trim_words( the_title('', '', false), 7, ' ...' )) : the_ID(); ?></span>
                        </div>
                        <div class="description-wrapper">
                                        <span class="description">
                                            <?php echo esc_html(wp_trim_words( get_the_excerpt(), 30, ' ...' )); ?>
                                        </span>
                        </div>
                    </div>
                    <div class="hexTop">
                        <div class="overlay"></div>
                    </div>
                    <div class="hexBottom">
                        <div class="overlay"></div>
                    </div>
                </a>
                <?php } $n++; ?>
            <?php } ?>
            </div>
        <?php }
    }
    $post = $orig_post;
    wp_reset_query();
}
}

// Pagination
if ( !function_exists( 'pagination' ) ) {
    function pagination($pages = '', $range = 4)
    {
        $showitems = ($range * 2)+1;

        global $paged;
        if(empty($paged)) $paged = 1;

        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            var_dump($pages);die;
            if(!$pages)
            {
                $pages = 1;
            }
        }

        if(1 != $pages)
        {
            echo "<div class=\"pagination\"><span>".__( 'Page', 'sportapils' )." ".$paged." ".__( 'of', 'sportapils' )." ".$pages."</span>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; ".__( 'First', 'sportapils' )."</a>";
            if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; ".__( 'Previous', 'sportapils' )."</a>";

            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
                }
            }

            if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__( 'Next', 'sportapils' )." &rsaquo;</a>";
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__( 'Last', 'sportapils' )." &raquo;</a>";
            echo "</div>\n";
        }
    }
}

//Comments
if ( !function_exists( 'sp_comment' ) ) {
    function sp_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="comment-wrapper" id="comment-<?php comment_ID(); ?>">
            <div class="comment-inner">
                <div class="commentmeta">
                    <?php printf( __( '%s ', 'sportapils'), sprintf( '<cite class="fn">@%s</cite>', get_comment_author_link() ) ); ?>
                    <span class="date"><?php echo get_comment_date(); ?></span>
                    <?php edit_comment_link( __( 'Edit', 'sportapils'), '(' , ')'); ?>
                </div>
                <div class="text">
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <p class="waiting_approval"><?php esc_html_e( 'Your comment is awaiting moderation.', 'sportapils' ); ?></p>
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div><!-- .text  -->
                <div class="clear"></div>
            </div><!-- comment-inner  -->
        </div><!-- comment-wrapper  -->
        <?php
    }
}

add_filter( 'comment_form_fields', 'order_comment_form_fields' );
add_filter('comment_form_field_comment', 'comment_form_edit');
function comment_form_edit($field) {
    $field = sprintf(
        '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"
                            placeholder="'
        . __( 'Komentārs *', 'sportapils') .'"></textarea></p>'
    );
    return $field;
}
function order_comment_form_fields( $fields ) {
//    var_dump($fields);die;
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}


function theme_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Theme Panel</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields("section");
            do_settings_sections("theme-options");
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function add_theme_menu_item()
{
    add_menu_page("Sportapils Panel", "Sportapils Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");

function display_twitter_element()
{
    ?>
        <input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_facebook_element()
{
    ?>
    <input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>"/>
    <?php
}
function display_instagram_element()
{
    ?>
    <input type="text" name="instagram_url" id="instagram_url" value="<?php echo get_option('instagram_url'); ?>" />
    <?php
}

function display_whatsapp_element()
{
    ?>
    <input type="text" name="whatsapp_url" id="whatsapp_url" value="<?php echo get_option('whatsapp_url'); ?>" />
    <?php
}

function display_theme_panel_fields()
{
    add_settings_section("section", "All Settings", null, "theme-options");

    add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "section");
    add_settings_field("instagram_url", "Instagram Profile Url", "display_instagram_element", "theme-options", "section");
    add_settings_field("whatsapp_url", "Whatsapp Profile Url", "display_whatsapp_element", "theme-options", "section");


    register_setting("section", "twitter_url");
    register_setting("section", "facebook_url");
    register_setting("section", "instagram_url");
    register_setting("section", "whatsapp_url");
}

add_action("admin_init", "display_theme_panel_fields");

add_filter('tiny_mce_before_init','configure_tinymce');

/**
 * Customize TinyMCE's configuration
 *
 * @param   array
 * @return  array
 */
function configure_tinymce($in) {
    $in['paste_preprocess'] = "function(plugin, args){
    // Strip all HTML tags except those we have whitelisted
    var whitelist = 'p,b,strong,i,em,h2,h3,h4,h5,h6,ul,li,ol,a,href';
    var stripped = jQuery('<div>' + args.content + '</div>');
    var els = stripped.find('*').not(whitelist);
    for (var i = els.length - 1; i >= 0; i--) {
      var e = els[i];
      jQuery(e).replaceWith(e.innerHTML);
    }
    // Strip all class and id attributes
    stripped.find('*').removeAttr('id').removeAttr('class').removeAttr('style');
    // Return the clean HTML
    args.content = stripped.html();
  }";
    return $in;
}