<?php
/**
 * The header template
 *
 * @package News_Flat_Modern
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'news-flat-modern' ); ?></a>

    <header class="site-header">
        <div class="header-top">
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo date_i18n( get_option( 'date_format' ) ); ?></span>
                    <div class="header-social">
                        <!-- Add social icons here -->
                    </div>
                </div>
            </div>
        </div>

        <div class="header-main">
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="site-branding">
                        <?php if ( has_custom_logo() ) : ?>
                            <div class="site-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <?php bloginfo( 'name' ); ?>
                                </a>
                            </h1>
                            <p class="site-description" style="display: none;">
                                <?php bloginfo( 'description' ); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'news-flat-modern' ); ?></span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>

                    <nav id="site-navigation" class="main-navigation">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'container'      => false,
                                'fallback_cb'    => 'news_flat_modern_fallback_menu',
                            )
                        );
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const mainNav = document.querySelector('.main-navigation');
        
        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                mainNav.style.display = isExpanded ? 'none' : 'block';
            });
        }
    });
    </script>
