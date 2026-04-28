<?php
/**
 * Album Gallery Page Template
 *
 * Template Name: Album Gallery
 *
 * @package News_Flat_Modern
 */

get_header();
?>

<main class="site-main">
    <div class="container album-gallery">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <header style="text-align: center; margin-bottom: 40px;">
                <h1 style="font-size: 36px; color: var(--secondary-color); margin-bottom: 15px;"><?php the_title(); ?></h1>
                <p style="color: var(--text-light); font-size: 18px;"><?php echo get_the_excerpt(); ?></p>
            </header>
        <?php endwhile; endif; ?>

        <!-- Gallery Filter -->
        <div class="gallery-filter">
            <button class="filter-btn active" data-filter="all"><?php esc_html_e( 'All', 'news-flat-modern' ); ?></button>
            <?php
            $categories = get_categories( array(
                'taxonomy' => 'category',
                'hide_empty' => true,
            ) );
            
            if ( ! empty( $categories ) ) {
                foreach ( $categories as $category ) {
                    ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr( $category->slug ); ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </button>
                    <?php
                }
            }
            ?>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid" id="gallery-grid">
            <?php
            // Query posts with featured images
            $gallery_args = array(
                'posts_per_page' => -1,
                'meta_key' => '_thumbnail_id',
                'post_status' => 'publish',
            );
            
            $gallery_query = new WP_Query( $gallery_args );
            
            if ( $gallery_query->have_posts() ) :
                while ( $gallery_query->have_posts() ) : $gallery_query->the_post();
                    $categories = get_the_category();
                    $category_slugs = array();
                    if ( ! empty( $categories ) ) {
                        foreach ( $categories as $cat ) {
                            $category_slugs[] = $cat->slug;
                        }
                    }
                    ?>
                    <div class="gallery-item" 
                         data-categories="<?php echo esc_attr( implode( ' ', $category_slugs ) ); ?>"
                         onclick="openLightbox(this)">
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php 
                            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                            $thumbnail_full = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                            ?>
                            <img src="<?php echo esc_url( $thumbnail_url ); ?>" 
                                 alt="<?php the_title_attribute(); ?>"
                                 data-full="<?php echo esc_url( $thumbnail_full ); ?>">
                        <?php endif; ?>
                        
                        <div class="gallery-overlay">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 10 ); ?></p>
                            <span style="margin-top: 10px; font-size: 12px; opacity: 0.8;">
                                <?php 
                                if ( ! empty( $categories ) ) {
                                    echo esc_html( $categories[0]->name );
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p style="grid-column: 1/-1; text-align: center; padding: 60px; color: var(--text-light);">
                    <?php esc_html_e( 'No gallery items found. Add posts with featured images.', 'news-flat-modern' ); ?>
                </p>
                <?php
            endif;
            ?>
        </div>

    </div>
</main>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
    <div class="lightbox-content">
        <button class="lightbox-close" onclick="closeLightboxBtn()">&times;</button>
        <img id="lightbox-image" src="" alt="">
        <div style="text-align: center; color: white; margin-top: 20px;">
            <h3 id="lightbox-title"></h3>
            <p id="lightbox-description" style="opacity: 0.8;"></p>
        </div>
    </div>
</div>

<script>
// Gallery Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            galleryItems.forEach(item => {
                if (filter === 'all') {
                    item.style.display = 'block';
                } else {
                    const categories = item.getAttribute('data-categories');
                    if (categories && categories.includes(filter)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        });
    });
});

// Lightbox Functions
function openLightbox(element) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDesc = document.getElementById('lightbox-description');
    
    const img = element.querySelector('img');
    const title = element.querySelector('h3');
    const desc = element.querySelector('p');
    
    lightboxImage.src = img.getAttribute('data-full');
    lightboxImage.alt = img.alt;
    lightboxTitle.textContent = title ? title.textContent : '';
    lightboxDesc.textContent = desc ? desc.textContent : '';
    
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(event) {
    if (event.target.id === 'lightbox') {
        closeLightboxBtn();
    }
}

function closeLightboxBtn() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightboxBtn();
    }
});
</script>

<style>
/* Additional styles specific to gallery page */
.gallery-item {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

<?php
get_footer();
