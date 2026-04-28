<?php
/**
 * News Card Template Part
 *
 * @package News_Flat_Modern
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'news-card' ); ?>>
    <a href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large', array( 'style' => 'width: 100%; height: 220px; object-fit: cover;' ) ); ?>
        <?php else : ?>
            <div style="width: 100%; height: 220px; background: var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-light);">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
            </div>
        <?php endif; ?>
    </a>
    
    <div class="news-card-content">
        <span class="news-card-category">
            <?php 
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" style="color: white;">';
                echo esc_html( $categories[0]->name );
                echo '</a>';
            }
            ?>
        </span>
        
        <h2 class="news-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        
        <p class="news-card-excerpt">
            <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
        </p>
        
        <div class="news-card-meta">
            <span class="posted-on">
                <time datetime="<?php echo get_the_date( 'c' ); ?>">
                    <?php echo get_the_date(); ?>
                </time>
            </span>
            <span class="byline">
                <?php esc_html_e( 'By', 'news-flat-modern' ); ?> 
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                    <?php the_author(); ?>
                </a>
            </span>
            <span class="comments-link">
                <?php
                $comments_count = get_comments_number();
                if ( $comments_count > 0 ) {
                    echo sprintf(
                        /* translators: %s: number of comments */
                        esc_html( _n( '%s Comment', '%s Comments', $comments_count, 'news-flat-modern' ) ),
                        number_format_i18n( $comments_count )
                    );
                }
                ?>
            </span>
        </div>
    </div>
</article>
