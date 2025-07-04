<?php

class widget_category extends WP_Widget {

    /*  Widget #2 Setup  */

    public function __construct() {
        parent::__construct(false, $name = esc_html__('Sportapils category block', 'sportapils' ), array(
            'description' => esc_html__('Widget for displaying a category posts', 'sportapils' )
        ));
    }

    /*  Display Widget #2  */

    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $adImage = ( ! empty( $instance['image_uri'] ) ) ? $instance['image_uri'] : '';
        $categories = isset( $instance['cats_id'] ) ? $instance['cats_id'] : '';
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
        $tag = 'sportapils';
        if ( ! $number ) {
            $number = 6;
        }
        if($adImage) {
            $number = --$number;
            $adUrl = ( ! empty( $instance['ad_url'] ) ) ? $instance['ad_url'] : '';
            $adText = ( ! empty( $instance['ad_text'] ) ) ? $instance['ad_text'] : '';
        }
        get_permalink( get_page_by_path( 'posts' ) );
        $link = (get_category_link( $categories ) && $categories) ? get_category_link( $categories ) : get_permalink( get_page_by_path( 'posts' ) );
        $light = false;
        $numberFormatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        if (get_the_category_by_ID($categories) == 'Light') {
            $light = true;
            $tag = 'sportapils_light';
        }
        global $do_not_duplicate;
        $r1 = new WP_Query( apply_filters( 'widget_posts_args', array(
            'tag' => $tag,
            'post__not_in' => $do_not_duplicate,
            'posts_per_page'      => 1,
            'cat'      => $categories,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );
        $do_not_duplicate = array_merge($do_not_duplicate , wp_list_pluck( $r1->posts, 'ID' ));
        $number = $number - $r1->post_count;
        $r2 = new WP_Query( apply_filters( 'widget_posts_args', array(
            'tag' => $tag,
            'posts_per_page'      => $number,
            'cat'      => $categories,
            'offset'	=> $r1->post_count,
            'no_found_rows'       => true,
            'post__not_in' => $do_not_duplicate,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );
        $do_not_duplicate = array_merge($do_not_duplicate , wp_list_pluck( $r2->posts, 'ID' ));
        $hexagonList = $r2;

        if (($number - $r2->post_count) > 0) {
            $r3 = new WP_Query(apply_filters('widget_posts_args', array(
                'posts_per_page' => $number - $r2->post_count,
                'cat' => $categories,
                'no_found_rows' => true,
                'post__not_in' => $do_not_duplicate,
                'post_status' => 'publish',
                'ignore_sticky_posts' => true
            )));

            $hexagonList = new WP_Query();
            $hexagonList->posts = array_merge( $r2->posts, $r3->posts );
            $hexagonList->post_count = $r2->post_count + $r3->post_count;
            $do_not_duplicate = array_merge($do_not_duplicate , wp_list_pluck( $r3->posts, 'ID' ));
        }
        $n = 1;
        if($adImage) $number = ++$number;

        if ($r1->have_posts()) :
            ?>
            <div class="posts relative <?php if($light) echo "light" ?>">
                <?php while ( $r1->have_posts() ) : $r1->the_post(); ?>
                    <?php
                    $do_not_duplicate[] = get_the_ID();
                    $widget_3_big = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                    $widget_3_big_mobile = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                    if ($widget_3_big) { ?>
                    <div class="featured relative" onclick="location.href='<?php the_permalink(); ?>';">
                        <?php if ( $title ) { ?>
                            <div class="main-title centered">
                                <?php if($light) { ?>
                                    <div class="light-icon"></div><a class="relative" href="<?php echo $link ;?>"><?php echo esc_html($title); ?></a>
                                <?php } else { ?>
                                    <div class="colored-icon"></div><a class="relative" href="<?php echo $link ;?>"><?php echo esc_html($title); ?></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <div class="overlay"></div>
                        <div class="img-wrapper">
                            <img src="<?php echo esc_url($widget_3_big[0]); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                        <div class="content centered">
                            <div class="info">
                                <span class="date"><?php echo get_the_date(); ?></span>
                                <span class="author">@<?php echo get_the_author_meta('display_name');?></span>
                            </div>
                            <div class="title-wrapper">
                                <span class="title"><?php echo get_the_title() ?  esc_html(wp_trim_words( the_title('', '', false), 15, ' ...' )) : the_ID(); ?></span>
                            </div>
                            <div class="button-wrapper">
                                <a class="button colored <?php if($light) echo "pink" ?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php esc_html_e('read post' , 'sportapils' );?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                <?php
                $n++;
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="hexagon-list relative centered <?php if($light) echo "light" ?> <?php echo $numberFormatter->format($number) ;?>">
                    <?php while ( $hexagonList->have_posts() ) : $hexagonList->the_post(); ?>
                        <?php $do_not_duplicate[] = get_the_ID(); ?>
                        <?php $hexagon_image = wp_get_attachment_image_src(get_post_meta( get_the_ID(), 'hexagon_featured_image', true), 'full');
                        if(!$hexagon_image) $hexagon_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        if ($hexagon_image) { ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
                               class="hexagon left <?php if ($n == 5) echo 'grey';?>"
                               style="background-image: url(<?php echo esc_url($hexagon_image[0]); ?>);">
                                <?php if ($n != 5) { ?><div class="overlay"></div><?php } ?>
                                <div class="content">
                                    <div class="info">
                                        <span class="date"><?php echo get_the_date(); ?></span>
                                        <span class="author">@<?php echo get_the_author_meta('display_name');?></span>
                                    </div>
                                    <div class="title-wrapper">
                                        <span class="title"><?php echo get_the_title() ?  esc_html(wp_trim_words( the_title('', '', false), 10, ' ...' )) : the_ID(); ?></span>
                                    </div>
                                    <div class="description-wrapper">
                                        <span class="description">
                                            <?php echo esc_html(wp_trim_words( get_the_excerpt(), 22, ' ...' )); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="hexTop">
                                    <?php if ($n != 5) { ?><div class="overlay"></div><?php } ?>
                                </div>
                                <div class="hexBottom">
                                    <?php if ($n != 5) { ?><div class="overlay"></div><?php } ?>
                                </div>
                                <?php if ($n == 5) { ?>
                                    <div class="hexagon-overlay">
                                        <div class="hexTop">
                                        </div>
                                        <div class="hexBottom">
                                        </div>
                                    </div>
                                <?php } ?>
                            </a>
                        <?php }
                        $n++; ?>
                    <?php endwhile; ?>
                    <?php if($adImage) { ?>
                        <a href="<?php echo $adUrl; ?>""
                           class="hexagon ad left"
                           style="background-image: url(<?php echo esc_url($adImage); ?>);">
                            <div class="overlay"></div>
                            <div class="content">
                                <div class="title-wrapper">
                                    <span class="title"><?php echo wp_trim_words( $adText, 10, ' ...' ); ?></span>
                                </div>
                            </div>
                            <div class="hexTop">
                                <div class="overlay"></div>
                            </div>
                            <div class="hexBottom">
                                <div class="overlay"></div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
                <div class="button-wrapper list">
                    <a class="relative button colored green <?php if($light) echo "white" ?>" href="<?php echo $link ;?>"><?php _e( 'More Posts', 'sportapils'); ?></a>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;
    }

    /*  Update Widget #2  */

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        $instance['cats_id'] = (int) $new_instance['cats_id'];
        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
        $instance['ad_text'] = strip_tags( $new_instance['ad_text'] );
        $instance['ad_url'] = strip_tags( $new_instance['ad_url'] );
        return $instance;
    }

    /*  Widget #2 Settings Form  */

    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
        $cats = get_categories();
        $categories = isset( $instance['cats_id'] ) ? $instance['cats_id'] : '';
        ?>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'sportapils' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of post to show:', 'sportapils' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="2" /></p>


        <p><label for="<?php echo esc_attr($this->get_field_id( 'cats_id' )); ?>"><?php esc_html_e('Select Category:' , 'sportapils' );?></label>
            <select id="<?php echo esc_attr($this->get_field_id( 'cats_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cats_id' )); ?>">
                <option value=""><?php esc_html_e('All' , 'sportapils' );?></option>
                <?php foreach ( $cats as $cat ) {?>
                    <option value="<?php echo esc_attr($cat->term_id); ?>"<?php echo selected( $categories, $cat->term_id, false ) ?>> <?php echo esc_attr( $cat->name ) ?></option>
                <?php }?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php esc_html_e( 'Ad Image:', 'sportapils' ); ?></label><br />
            <input type="text" class="widefat <?= $this->id ?>_url" name="<?= $this->get_field_name( 'image_uri' ); ?>" value="<?= $instance['image_uri']; ?>" style="margin-top:5px;" />
            <img class="<?= $this->id ?>_img" src="<?= (!empty($instance['image_uri'])) ? $instance['image_uri'] : ''; ?>" style="margin:0;padding:0;max-width:100%;display:block"/>
            <input type="button" id="<?= $this->id ?>" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('ad_url'); ?>"><?php esc_html_e( 'Ad Url:', 'sportapils' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('ad_url'); ?>" id="<?php echo $this->get_field_id('ad_url'); ?>" value="<?php echo $instance['ad_url']; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('ad_text'); ?>"><?php esc_html_e( 'Ad Text:', 'sportapils' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('ad_text'); ?>" id="<?php echo $this->get_field_id('ad_text'); ?>" value="<?php echo $instance['ad_text']; ?>" class="widefat" />
        </p>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                function media_upload(button_selector) {
                    var _custom_media = true,
                        _orig_send_attachment = wp.media.editor.send.attachment;
                    $('body').on('click', button_selector, function () {
                        var button_id = $(this).attr('id');
                        wp.media.editor.send.attachment = function (props, attachment) {
                            if (_custom_media) {
                                $('.' + button_id + '_img').attr('src', attachment.url);
                                $('.' + button_id + '_url').val(attachment.url);
                            } else {
                                return _orig_send_attachment.apply($('#' + button_id), [props, attachment]);
                            }
                        };
                        wp.media.editor.open($('#' + button_id));
                        return false;
                    });
                }
                media_upload('.js_custom_upload_media');
            });
        </script>


        <?php

    }
}

add_action( 'widgets_init', 'widget_category_register' );

function widget_category_register() {
    register_widget( 'widget_category' );
}
