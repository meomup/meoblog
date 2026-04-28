<?php
/**
 * The main template file
 *
 * @package News_Flat_Modern
 */

get_header();
?>

<main class="site-main">
    <div class="container home-content">
        
        <?php if ( is_front_page() ) : ?>
            
            <!-- Featured Section -->
            <section class="featured-section">
                <?php
                // Get featured post (latest post with featured image)
                $featured_args = array(
                    'posts_per_page' => 1,
                    'meta_key' => '_thumbnail_id',
                );
                $featured_query = new WP_Query( $featured_args );
                
                if ( $featured_query->have_posts() ) :
                    while ( $featured_query->have_posts() ) : $featured_query->the_post();
                        ?>
                        <article class="featured-main">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="featured-overlay">
                                <span class="news-card-category">
                                    <?php 
                                    $categories = get_the_category();
                                    if ( ! empty( $categories ) ) {
                                        echo esc_html( $categories[0]->name );
                                    }
                                    ?>
                                </span>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                
                <!-- Side Featured Items -->
                <div class="featured-side">
                    <?php
                    $side_featured_args = array(
                        'posts_per_page' => 2,
                        'offset' => 1,
                        'meta_key' => '_thumbnail_id',
                    );
                    $side_featured_query = new WP_Query( $side_featured_args );
                    
                    if ( $side_featured_query->have_posts() ) :
                        while ( $side_featured_query->have_posts() ) : $side_featured_query->the_post();
                            ?>
                            <article class="featured-item">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'medium' ); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="featured-item-content">
                                    <span class="news-card-category">
                                        <?php 
                                        $categories = get_the_category();
                                        if ( ! empty( $categories ) ) {
                                            echo esc_html( $categories[0]->name );
                                        }
                                        ?>
                                    </span>
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </section>
            
            <!-- Latest News Grid -->
            <section class="news-grid-section">
                <h2 style="margin-bottom: 30px; font-size: 28px; color: var(--secondary-color);">Latest News</h2>
                <div class="news-grid">
                    <?php
                    $args = array(
                        'posts_per_page' => 6,
                        'offset' => 3,
                        'post_status' => 'publish',
                    );
                    $latest_news = new WP_Query( $args );
                    
                    if ( $latest_news->have_posts() ) :
                        while ( $latest_news->have_posts() ) : $latest_news->the_post();
                            get_template_part( 'template-parts/content', 'card' );
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <p>No posts found.</p>
                        <?php
                    endif;
                    ?>
                </div>
            </section>
            
        <?php else : ?>
            
            <!-- Archive/Blog Page -->
            <div class="news-grid">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', 'card' );
                    endwhile;
                    
                    the_posts_pagination();
                else :
                    ?>
                    <p>No posts found.</p>
                    <?php
                endif;
                ?>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php
get_footer();
