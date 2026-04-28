/**
 * Navigation JS for News Flat Modern Theme
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-navigation');
    
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            
            if (isExpanded) {
                mainNav.style.display = 'none';
            } else {
                mainNav.style.display = 'block';
            }
        });
    }

    // Dropdown Menu Accessibility
    const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');
    
    menuItemsWithChildren.forEach(function(item) {
        const link = item.querySelector('a');
        const submenu = item.querySelector('.sub-menu');
        
        if (link && submenu) {
            // Add aria attributes
            link.setAttribute('aria-haspopup', 'true');
            link.setAttribute('aria-expanded', 'false');
            
            // Toggle submenu on click for mobile
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    this.setAttribute('aria-expanded', !isExpanded);
                    
                    if (isExpanded) {
                        submenu.style.display = 'none';
                    } else {
                        submenu.style.display = 'flex';
                    }
                }
            });
        }
    });

    // Sticky Header Effect
    const header = document.querySelector('.site-header');
    
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
            }
        });
    }

    // Smooth Scroll for Anchor Links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                const target = document.querySelector(href);
                
                window.scrollTo({
                    top: target.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// Gallery Filter Functionality (for gallery pages)
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initGalleryFilter);
} else {
    initGalleryFilter();
}

function initGalleryFilter() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    if (filterBtns.length > 0 && galleryItems.length > 0) {
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
                        item.style.animation = 'fadeIn 0.5s ease';
                    } else {
                        const categories = item.getAttribute('data-categories');
                        if (categories && categories.includes(filter)) {
                            item.style.display = 'block';
                            item.style.animation = 'fadeIn 0.5s ease';
                        } else {
                            item.style.display = 'none';
                        }
                    }
                });
            });
        });
    }
}
