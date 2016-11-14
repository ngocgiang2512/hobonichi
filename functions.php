<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Twenty Sixteen, use a find and replace
     * to change 'twentysixteen' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    // add_theme_support( 'title-tag' );

    /*
     * Enable support for custom logo.
     *
     *  @since Twenty Sixteen 1.2
     */
    add_theme_support( 'custom-logo', array(
        'height'      => 240,
        'width'       => 240,
        'flex-height' => true,
    ) );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 9999 );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'twentysixteen' ),
        'social'  => __( 'Social Links Menu', 'twentysixteen' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'status',
        'audio',
        'chat',
    ) );

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, icons, and column width.
     */
    add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

    // Indicate widget sidebars can use selective refresh in the Customizer.
    add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'twentysixteen' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
        'id'            => 'sidebar-3',
        'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'id'          => 'hbnc-bottom',
        'name'        => __( 'Sidebar Bottom', 'hobonichi' ),
        'description' => __( 'This sidebar is located above the footer', 'hobonichi' ),
    ) );

    register_sidebar( array(
        'id'          => 'hbnc-footer',
        'name'        => __( 'Footer Right', 'hobonichi' ),
        'description' => __( 'This sidebar is at the right of the footer', 'hobonichi' ),
    ) );

}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';

    /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
        $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
    }

    /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
        $fonts[] = 'Montserrat:400,700';
    }

    /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
        $fonts[] = 'Inconsolata:400';
    }

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( $subsets ),
        ), 'https://fonts.googleapis.com/css' );
    }

    return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

    // Add Genericons, used in the main stylesheet.
    wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

    // Theme stylesheet.
    wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

    // mCustom Scroll Bar
    wp_enqueue_style( 'mCustomScrollBar', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.css', array( 'twentysixteen-style' ), '20162305' );

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160412' );
    wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160412' );
    wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

    // Load the Internet Explorer 7 specific stylesheet.
    wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160412' );
    wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

    // Load the html5 shiv.
    wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
    wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160412', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160412' );
    }

    wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160412', true );
    wp_enqueue_script( 'mCustomScrollBar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), '20162305', true );
    wp_enqueue_script( 'jquery.lazyload', get_template_directory_uri() . '/js/jquery.lazyload.js', array( 'jquery' ), '20162305', true );
    wp_enqueue_script( 'touchswipe', get_template_directory_uri() . '/js/touchswipe.min.js', array( 'jquery' ), '20162305', true );
    wp_enqueue_script( 'query.easing', get_template_directory_uri() . '/js/jquery.easing.1.3.mine.js', array( 'jquery' ), '20161111', true );
    wp_enqueue_script( 'infiniteScroll', get_template_directory_uri() . '/js/jquery.infinitescroll.js', array( 'jquery' ), '20162305', true );
    wp_enqueue_script( 'theme-function-script', get_template_directory_uri() . '/js/theme-function.js', array( 'jquery' ), '1.0.0', true );
    wp_localize_script( 'theme-function-script', 'hobonichiParams', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' )
    ) );

    wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
        'expand'   => __( 'expand child menu', 'twentysixteen' ),
        'collapse' => __( 'collapse child menu', 'twentysixteen' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }

    // Adds a class of group-blog to sites with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of no-sidebar to sites without active sidebar.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
    $color = trim( $color, '#' );

    if ( strlen( $color ) === 3 ) {
        $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
        $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
        $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
    } else if ( strlen( $color ) === 6 ) {
        $r = hexdec( substr( $color, 0, 2 ) );
        $g = hexdec( substr( $color, 2, 2 ) );
        $b = hexdec( substr( $color, 4, 2 ) );
    } else {
        return array();
    }

    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
    $width = $size[0];

    840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

    if ( 'page' === get_post_type() ) {
        840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    } else {
        840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
        600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    }

    return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
    if ( 'post-thumbnail' === $size ) {
        is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
        ! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
    $args['largest'] = 1;
    $args['smallest'] = 1;
    $args['unit'] = 'em';
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function homepage_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'home_title_setting',
        array(
            'title' => 'Home Title and Description',
            'description' => 'Title and Description on Home page',
            'priority' => 35,
        )
    );

    $wp_customize->add_setting(
        'page_title',
        array(
            'default' => '',
        )
    );

    $wp_customize->add_control(
        'page_title',
        array(
            'label' => 'Page Title',
            'section' => 'home_title_setting',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'page_desc',
        array(
            'default' => '',
        )
    );

    $wp_customize->add_control(
        'page_desc',
        array(
            'label' => 'Page Description',
            'section' => 'home_title_setting',
            'type' => 'textarea',
        )
    );
}
add_action( 'customize_register', 'homepage_customizer' );


class BannerWidget extends WP_Widget {
  function BannerWidget() {
    $widget_ops = array('classname' => 'BannerWidget', 'description' => 'Displays a banner' );
    parent::__construct('BannerWidget', 'Banner', $widget_ops);
  }

  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'imageUrl' => '' ) );
    $imageUrl = $instance['imageUrl'];
    $targetUrl = $instance['targetUrl'];
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('imageUrl'); ?>">Image Source:
                <input class="widefat" id="<?php echo $this->get_field_id('imageUrl'); ?>" name="<?php echo $this->get_field_name('imageUrl'); ?>" type="text" value="<?php echo attribute_escape($imageUrl); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('targetUrl'); ?>">Target URL:
                <input class="widefat" id="<?php echo $this->get_field_id('targetUrl'); ?>" name="<?php echo $this->get_field_name('targetUrl'); ?>" type="text" value="<?php echo attribute_escape($targetUrl); ?>" />
            </label>
        </p>
    <?php
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['imageUrl'] = $new_instance['imageUrl'];
    $instance['targetUrl'] = $new_instance['targetUrl'];
    return $instance;
  }

  function widget($args, $instance) {
    extract($args, EXTR_SKIP);

    $imageUrl = empty($instance['imageUrl']) ? ' ' : apply_filters('widget_imageUrl', $instance['imageUrl']);
    $targetUrl = empty($instance['targetUrl']) ? ' ' : apply_filters('widget_targetUrl', $instance['targetUrl']);

    if (!empty($imageUrl)) {
        echo '<div class="widget-banner">';
        echo '<a href="' . esc_url($targetUrl) . '" target="_blank">';
        echo '<img src="' . $imageUrl . '" alt="" />';
        echo '</a>';
        echo '</div>';
    }
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("BannerWidget");') );

class SocialLink extends WP_Widget {
  function SocialLink() {
    $widget_ops = array('classname' => 'SocialLink', 'description' => 'Displays social links' );
    parent::__construct('SocialLink', 'Social Links', $widget_ops);
  }

  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'imageUrl' => '' ) );
    $facebookUrl = $instance['facebookUrl'];
    $twitterUrl = $instance['twitterUrl'];
    $lineUrl = $instance['lineUrl'];
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('twitterUrl'); ?>">Twitter URL:
                <input class="widefat" id="<?php echo $this->get_field_id('twitterUrl'); ?>" name="<?php echo $this->get_field_name('twitterUrl'); ?>" type="text" value="<?php echo attribute_escape($twitterUrl); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebookUrl'); ?>">Facebook URL:
                <input class="widefat" id="<?php echo $this->get_field_id('facebookUrl'); ?>" name="<?php echo $this->get_field_name('facebookUrl'); ?>" type="text" value="<?php echo attribute_escape($facebookUrl); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('lineUrl'); ?>">Line URL:
                <input class="widefat" id="<?php echo $this->get_field_id('lineUrl'); ?>" name="<?php echo $this->get_field_name('lineUrl'); ?>" type="text" value="<?php echo attribute_escape($lineUrl); ?>" />
            </label>
        </p>
    <?php
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['facebookUrl'] = $new_instance['facebookUrl'];
    $instance['twitterUrl'] = $new_instance['twitterUrl'];
    $instance['lineUrl'] = $new_instance['lineUrl'];
    return $instance;
  }

  function widget($args, $instance) {
    extract($args, EXTR_SKIP);

    $facebookUrl = empty($instance['facebookUrl']) ? '' : apply_filters('widget_facebookUrl', $instance['facebookUrl']);
    $twitterUrl = empty($instance['twitterUrl']) ? '' : apply_filters('widget_twitterUrl', $instance['twitterUrl']);
    $lineUrl = empty($instance['lineUrl']) ? '' : apply_filters('widget_lineUrl', $instance['lineUrl']);

    if (!empty($twitterUrl) || !empty($facebookUrl) || !empty($lineUrl)) {
        echo '<div class="link-wrapper right-links clearfix">';
        if (!empty($twitterUrl) && $twitterUrl !== '') {
            echo '<div class="link-item">';
            echo '<a href="' . esc_url($twitterUrl) . '" target="_blank"><img src="' . get_bloginfo('template_directory') .'/images/icons/icon-twitter.png" alt=""></a>';
            echo '<a href="' . esc_url($twitterUrl) . '" target="_blank">ツイートする</a>';
            echo '</div>';
        };
        if (!empty($facebookUrl) && $facebookUrl !== '') {
            echo '<div class="link-item">';
            echo '<a href="' . esc_url($facebookUrl) . '" target="_blank"><img src="' . get_bloginfo('template_directory') .'/images/icons/icon-facebook.png" alt=""></a>';
            echo '<a href="' . esc_url($facebookUrl) . '" target="_blank">シェアする</a>';
            echo '</div>';
        };
        if (!empty($lineUrl) && $lineUrl !== '') {
            echo '<div class="link-item">';
            echo '<a href="' . esc_url($lineUrl) . '" target="_blank"><img src="' . get_bloginfo('template_directory') .'/images/icons/icon-line.png" alt=""></a>';
            echo '<a href="' . esc_url($lineUrl) . '" target="_blank">LINEで送る</a>';
            echo '</div>';
        }
        echo '</div>';
    }
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("SocialLink");') );

/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    $where = preg_replace(
        "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
        "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    
    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    return "DISTINCT";
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

if ( ! function_exists( 'twentyfourteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function twentyfourteen_paging_nav() {
    global $wp_query, $wp_rewrite;

    // Don't print empty markup if there's only one page.
    if ( $wp_query->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'format'   => $format,
        'total'    => $wp_query->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => __( '&larr; Previous', 'twentyfourteen' ),
        'next_text' => __( 'Next &rarr;', 'twentyfourteen' ),
    ) );

    if ( $links ) :

    ?>
    <nav class="navigation paging-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentyfourteen' ); ?></h1>
        <div class="pagination loop-pagination">
            <?php echo $links; ?>
        </div><!-- .pagination -->
    </nav><!-- .navigation -->
    <?php
    endif;
}
endif;

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function wpdocs_theme_name_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }

    global $page, $paged, $post;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    if ( is_single() ) {
        // $title .= " $sep $site_description";
        $title = "ほぼ日刊イトイ新聞 - " . $post->post_title;
    }

    return $title;
}
add_filter( 'wp_title', 'wpdocs_theme_name_wp_title', 10, 2 );

/*
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 */
function rd_duplicate_post_as_draft(){
    global $wpdb;
    if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
        wp_die('No post to duplicate has been supplied!');
    }

    /*
     * get the original post id
     */
    $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
    /*
     * and all the original post data then
     */
    $post = get_post( $post_id );

    /*
     * if you don't want current user to be the new post author,
     * then change next couple of lines to this: $new_post_author = $post->post_author;
     */
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;

    /*
     * if post data exists, create the post duplicate
     */
    if (isset( $post ) && $post != null) {

        /*
         * new post data array
         */
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $new_post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => 'draft',
            'post_title'     => $post->post_title,
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
        );

        /*
         * insert the post by wp_insert_post() function
         */
        $new_post_id = wp_insert_post( $args );

        /*
         * get all current post terms ad set them to the new post draft
         */
        $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }

        /*
         * duplicate all post meta just in two SQL queries
         */
        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
        if (count($post_meta_infos)!=0) {
            $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
            foreach ($post_meta_infos as $meta_info) {
                $meta_key = $meta_info->meta_key;
                $meta_value = addslashes($meta_info->meta_value);
                $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            $sql_query.= implode(" UNION ALL ", $sql_query_sel);
            $wpdb->query($sql_query);
        }


        /*
         * finally, redirect to the edit post screen for the new draft
         */
        wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
        exit;
    } else {
        wp_die('Post creation failed, could not find original post: ' . $post_id);
    }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );

/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
    }
    return $actions;
}

add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );

add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );

function load_search_results() {
    $query = $_POST['query'];

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        's' => $query
    );
    $search = new WP_Query( $args );
    
    ob_start(); ?>

    <div class="post-list">

    <?php if ( $search->have_posts() ) : ?>

        <div class="row">

            <h2 class="page-title">Search Result for <?php echo $query; ?></h2>

            <div class="row">

                <?php while ( $search->have_posts() ) : $search->the_post(); ?>

                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <?php get_template_part( 'template-parts/content', 'search' ); ?>
                    </div>
                    <div class="clear1"></div>

                <?php endwhile;                            
                    wp_reset_postdata(); 
                ?>

            </div>

        </div>
        <!-- ./row -->

    <?php else :
        // If no content, include the "No posts found" template.
        get_template_part( 'template-parts/content', 'none' );

    endif; ?>

    </div>
    <!-- ./ post-list -->
  
    <?php $content = ob_get_clean();
  
    echo $content;

    die();
      
}

?>