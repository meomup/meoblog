<?php
/**
 * The functions file for News Flat Modern theme
 *
 * @package News_Flat_Modern
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Define theme constants
 */
define( 'NEWS_FLAT_MODERN_VERSION', '1.0.0' );
define( 'NEWS_FLAT_MODERN_DIR', get_template_directory() );
define( 'NEWS_FLAT_MODERN_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function news_flat_modern_setup() {
    // Load text domain
    load_theme_textdomain( 'news-flat-modern', NEWS_FLAT_MODERN_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );
    
    // Set post thumbnail sizes
    set_post_thumbnail_size( 350, 220, true ); // Card thumbnail
    add_image_size( 'news-flat-large', 1200, 600, true ); // Featured image
    add_image_size( 'news-flat-medium', 600, 400, true ); // Side featured
    
    // Register navigation menus
    register_nav_menus( array(
        'primary'   => esc_html__( 'Primary Menu', 'news-flat-modern' ),
        'footer'    => esc_html__( 'Footer Menu', 'news-flat-modern' ),
        'mobile'    => esc_html__( 'Mobile Menu', 'news-flat-modern' ),
    ) );

    // Switch default core markup to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add theme support for selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for custom background
    add_theme_support( 'custom-background', array(
        'default-color' => 'f8f9fa',
    ) );

    // Add support for editor styles
    add_theme_support( 'editor-styles' );

    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Add support for custom header
    add_theme_support( 'custom-header', array(
        'default-image'      => '',
        'default-text-color' => '2c3e50',
        'width'              => 1920,
        'height'             => 400,
        'flex-height'        => true,
        'flex-width'         => true,
    ) );
}
add_action( 'after_setup_theme', 'news_flat_modern_setup' );

/**
 * Set the content width in pixels
 */
function news_flat_modern_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'news_flat_modern_content_width', 1200 );
}
add_action( 'after_setup_theme', 'news_flat_modern_content_width', 0 );

/**
 * Register widget areas
 */
function news_flat_modern_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'news-flat-modern' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'news-flat-modern' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 1', 'news-flat-modern' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Appears in the footer section 1.', 'news-flat-modern' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 2', 'news-flat-modern' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Appears in the footer section 2.', 'news-flat-modern' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'news_flat_modern_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function news_flat_modern_scripts() {
    // Main stylesheet
    wp_enqueue_style( 'news-flat-modern-style', get_stylesheet_uri(), array(), NEWS_FLAT_MODERN_VERSION );

    // Google Fonts
    wp_enqueue_style( 'news-flat-modern-fonts', 
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap',
        array(),
        null
    );

    // Theme JavaScript
    wp_enqueue_script( 'news-flat-modern-navigation', 
        NEWS_FLAT_MODERN_URI . '/js/navigation.js', 
        array(), 
        NEWS_FLAT_MODERN_VERSION, 
        true 
    );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'news_flat_modern_scripts' );

/**
 * Fallback menu callback
 */
function news_flat_modern_fallback_menu() {
    ?>
    <ul id="primary-menu">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'news-flat-modern' ); ?></a></li>
        <?php
        $categories = get_categories( array(
            'number' => 8,
            'orderby' => 'count',
            'order' => 'DESC',
        ) );
        
        if ( ! empty( $categories ) ) {
            foreach ( $categories as $category ) {
                ?>
                <li>
                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <?php
}

/**
 * Custom excerpt length
 */
function news_flat_modern_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'news_flat_modern_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
function news_flat_modern_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'news_flat_modern_excerpt_more' );

/**
 * Add custom body classes
 */
function news_flat_modern_body_classes( $classes ) {
    // Add class if sidebar is active
    if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
        $classes[] = 'has-sidebar';
    }

    // Add class for different page layouts
    if ( is_front_page() ) {
        $classes[] = 'front-page';
    }

    return $classes;
}
add_filter( 'body_class', 'news_flat_modern_body_classes' );

/**
 * Customizer additions
 */
function news_flat_modern_customize_register( $wp_customize ) {
    // Add custom colors section
    $wp_customize->add_section( 'news_flat_colors', array(
        'title'    => __( 'Theme Colors', 'news-flat-modern' ),
        'priority' => 30,
    ) );

    // Primary Color
    $wp_customize->add_setting( 'news_flat_primary_color', array(
        'default'           => '#3498db',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'news_flat_primary_color', array(
        'label'    => __( 'Primary Color', 'news-flat-modern' ),
        'section'  => 'news_flat_colors',
        'settings' => 'news_flat_primary_color',
    ) ) );

    // Secondary Color
    $wp_customize->add_setting( 'news_flat_secondary_color', array(
        'default'           => '#2c3e50',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'news_flat_secondary_color', array(
        'label'    => __( 'Secondary Color', 'news-flat-modern' ),
        'section'  => 'news_flat_colors',
        'settings' => 'news_flat_secondary_color',
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'news_flat_accent_color', array(
        'default'           => '#e74c3c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'news_flat_accent_color', array(
        'label'    => __( 'Accent Color', 'news-flat-modern' ),
        'section'  => 'news_flat_colors',
        'settings' => 'news_flat_accent_color',
    ) ) );
}
add_action( 'customize_register', 'news_flat_modern_customize_register' );

/**
 * Output custom CSS from Customizer settings
 */
function news_flat_modern_customizer_css() {
    $primary_color   = get_theme_mod( 'news_flat_primary_color', '#3498db' );
    $secondary_color = get_theme_mod( 'news_flat_secondary_color', '#2c3e50' );
    $accent_color    = get_theme_mod( 'news_flat_accent_color', '#e74c3c' );
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr( $primary_color ); ?>;
            --secondary-color: <?php echo esc_attr( $secondary_color ); ?>;
            --accent-color: <?php echo esc_attr( $accent_color ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'news_flat_modern_customizer_css' );

/**
 * Pagination
 */
function news_flat_modern_pagination() {
    the_posts_pagination( array(
        'mid_size'  => 2,
        'prev_text' => __( 'Previous', 'news-flat-modern' ),
        'next_text' => __( 'Next', 'news-flat-modern' ),
        'class'     => 'pagination',
    ) );
}
