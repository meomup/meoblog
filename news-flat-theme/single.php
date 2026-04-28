<?php
/**
 * Single Post Template
 *
 * @package News_Flat_Modern
 */

get_header();
?>

<main class="site-main">
    <div class="container single-post">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <header class="post-header">
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
                    
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    
                    <div class="post-meta">
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
                                comments_popup_link(
                                    sprintf(
                                        wp_kses(
                                            /* translators: %s: post title */
                                            __( 'No Comments<span class="screen-reader-text"> on %s</span>', 'news-flat-modern' ),
                                            array(
                                                'span' => array(
                                                    'class' => array(),
                                                ),
                                            )
                                        ),
                                        get_the_title()
                                    ),
                                    __( '1 Comment', 'news-flat-modern' ),
                                    __( '% Comments', 'news-flat-modern' )
                                );
                            }
                            ?>
                        </span>
                    </div>
                </header>
                
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-featured-image">
                        <?php the_post_thumbnail( 'news-flat-large' ); ?>
                    </div>
                <?php endif; ?>
                
                <div class="post-content">
                    <?php
                    the_content();
                    
                    wp_link_pages( array(
                        'before'      => '<div class="page-links" style="margin: 30px 0;"><span class="page-links-title">' . __( 'Pages:', 'news-flat-modern' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ) );
                    ?>
                </div>
                
                <footer class="post-footer" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid var(--border-color);">
                    <?php
                    // Post tags
                    $tags_list = get_the_tag_list( '', ', ' );
                    if ( $tags_list ) {
                        ?>
                        <div class="post-tags" style="margin-bottom: 20px;">
                            <strong><?php esc_html_e( 'Tags:', 'news-flat-modern' ); ?></strong>
                            <?php echo $tags_list; ?>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <!-- Post Navigation -->
                    <div class="post-navigation" style="display: flex; justify-content: space-between; gap: 20px;">
                        <div class="nav-previous" style="flex: 1;">
                            <?php previous_post_link( '%link', '<span style="font-size: 14px; color: var(--text-light);">' . __( 'Previous:', 'news-flat-modern' ) . '</span><br>%title' ); ?>
                        </div>
                        <div class="nav-next" style="flex: 1; text-align: right;">
                            <?php next_post_link( '%link', '<span style="font-size: 14px; color: var(--text-light);">' . __( 'Next:', 'news-flat-modern' ) . '</span><br>%title' ); ?>
                        </div>
                    </div>
                </footer>
                
                <!-- Author Box -->
                <div class="author-box" style="background: var(--background-light); padding: 30px; border-radius: var(--border-radius); margin-top: 40px; display: flex; gap: 20px; align-items: center;">
                    <div class="author-avatar" style="flex-shrink: 0;">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'avatar' ) ); ?>
                    </div>
                    <div class="author-info">
                        <h3 style="margin-bottom: 10px; font-size: 18px;">
                            <?php esc_html_e( 'About', 'news-flat-modern' ); ?> <?php the_author(); ?>
                        </h3>
                        <p style="color: var(--text-light); margin-bottom: 10px;">
                            <?php echo esc_html( get_the_author_meta( 'description' ) ); ?>
                        </p>
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" style="color: var(--primary-color); font-weight: 600;">
                            <?php esc_html_e( 'View all posts', 'news-flat-modern' ); ?> →
                        </a>
                    </div>
                </div>
                
                <!-- Comments Section -->
                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
                
            </article>
            
        <?php endwhile; endif; ?>
        
    </div>
</main>

<?php
get_footer();
