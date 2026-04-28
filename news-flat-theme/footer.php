<?php
/**
 * The footer template
 *
 * @package News_Flat_Modern
 */
?>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-widget">
                    <h3><?php esc_html_e( 'About Us', 'news-flat-modern' ); ?></h3>
                    <p style="color: rgba(255, 255, 255, 0.8); line-height: 1.8;">
                        <?php esc_html_e( 'We are a modern news platform delivering the latest updates and stories from around the world. Stay informed with our comprehensive coverage.', 'news-flat-modern' ); ?>
                    </p>
                </div>

                <div class="footer-widget">
                    <h3><?php esc_html_e( 'Categories', 'news-flat-modern' ); ?></h3>
                    <ul>
                        <?php
                        $categories = get_categories( array(
                            'number' => 5,
                            'orderby' => 'count',
                            'order' => 'DESC',
                        ) );
                        
                        if ( ! empty( $categories ) ) {
                            foreach ( $categories as $category ) {
                                ?>
                                <li>
                                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
                                        <?php echo esc_html( $category->name ); ?>
                                        <span style="float: right; opacity: 0.6;">(<?php echo $category->count; ?>)</span>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>

                <div class="footer-widget">
                    <h3><?php esc_html_e( 'Quick Links', 'news-flat-modern' ); ?></h3>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About', 'news-flat-modern' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'news-flat-modern' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'news-flat-modern' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/terms' ) ); ?>"><?php esc_html_e( 'Terms of Service', 'news-flat-modern' ); ?></a></li>
                    </ul>
                </div>

                <div class="footer-widget">
                    <h3><?php esc_html_e( 'Newsletter', 'news-flat-modern' ); ?></h3>
                    <p style="color: rgba(255, 255, 255, 0.8); margin-bottom: 15px;">
                        <?php esc_html_e( 'Subscribe to our newsletter for daily updates.', 'news-flat-modern' ); ?>
                    </p>
                    <form style="display: flex; gap: 10px;">
                        <input type="email" placeholder="<?php esc_attr_e( 'Your email', 'news-flat-modern' ); ?>" 
                               style="flex: 1; padding: 10px; border: none; border-radius: 4px; outline: none;">
                        <button type="submit" style="background: var(--primary-color); color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                            <?php esc_html_e( 'Subscribe', 'news-flat-modern' ); ?>
                        </button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>
                    &copy; <?php echo date( 'Y' ); ?> 
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: rgba(255, 255, 255, 0.8);">
                        <?php bloginfo( 'name' ); ?>
                    </a>. 
                    <?php esc_html_e( 'All rights reserved.', 'news-flat-modern' ); ?>
                </p>
                <p style="margin-top: 10px;">
                    <?php esc_html_e( 'Powered by WordPress', 'news-flat-modern' ); ?>
                </p>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
