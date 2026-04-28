<?php
/**
 * Category Archive Template
 *
 * @package News_Flat_Modern
 */

get_header();
?>

<main class="site-main">
    
    <header class="category-header">
        <div class="container">
            <?php
            the_archive_title( '<h1 class="category-title">', '</h1>' );
            the_archive_description( '<p class="category-description">', '</p>' );
            ?>
        </div>
    </header>
    
    <div class="container" style="padding: 40px 20px;">
        
        <!-- Category Filter (if multiple categories) -->
        <?php
        $categories = get_categories( array(
            'hide_empty' => true,
            'parent'     => 0,
        ) );
        
        if ( count( $categories ) > 1 ) :
            ?>
            <div class="gallery-filter" style="margin-bottom: 40px;">
                <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" 
                   class="filter-btn <?php echo is_home() ? 'active' : ''; ?>">
                    <?php esc_html_e( 'All', 'news-flat-modern' ); ?>
                </a>
                <?php foreach ( $categories as $category ) : ?>
                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" 
                       class="filter-btn <?php echo is_category( $category->term_id ) ? 'active' : ''; ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- Posts Grid -->
        <div class="news-grid">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', 'card' );
                endwhile;
                
                // Pagination
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '← Previous', 'news-flat-modern' ),
                    'next_text' => __( 'Next →', 'news-flat-modern' ),
                    'class'     => 'pagination',
                ) );
            else :
                ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 60px;">
                    <h2 style="font-size: 24px; margin-bottom: 15px; color: var(--secondary-color);">
                        <?php esc_html_e( 'No posts found', 'news-flat-modern' ); ?>
                    </h2>
                    <p style="color: var(--text-light);">
                        <?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'news-flat-modern' ); ?>
                    </p>
                </div>
                <?php
            endif;
            ?>
        </div>
        
    </div>
</main>

<?php
get_footer();
