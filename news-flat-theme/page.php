<?php
/**
 * Page Template
 *
 * @package News_Flat_Modern
 */

get_header();
?>

<main class="site-main">
    <div class="container" style="padding: 40px 20px;">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <header class="page-header" style="margin-bottom: 30px; text-align: center;">
                    <h1 class="page-title" style="font-size: 36px; color: var(--secondary-color); margin-bottom: 15px;">
                        <?php the_title(); ?>
                    </h1>
                </header>
                
                <?php if ( has_post_thumbnail() && ! is_front_page() ) : ?>
                    <div class="page-featured-image" style="margin-bottom: 30px; border-radius: var(--border-radius); overflow: hidden;">
                        <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 400px; object-fit: cover;' ) ); ?>
                    </div>
                <?php endif; ?>
                
                <div class="page-content" style="background: var(--background-white); padding: 40px; border-radius: var(--border-radius); box-shadow: var(--shadow-light); max-width: 900px; margin: 0 auto; font-size: 18px; line-height: 1.8;">
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
                
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
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
